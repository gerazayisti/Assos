<?php

namespace App\Http\Controllers;

use App\Models\Tontine;
use App\Models\User;
use App\Models\Membre;
use App\Models\Contribution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class TontineController extends Controller
{
    public function index()
    {
        $tontines = Tontine::with('participants')->get();
        return view('tontines.tontines', compact('tontines'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'type' => 'required|in:petite,grande',
            'amount_per_person' => 'required|numeric|min:0',
            'total_participants' => 'required|integer|min:2',
            'start_date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $tontine = Tontine::create([
            'name' => $request->name,
            'type' => $request->type,
            'amount_per_person' => $request->amount_per_person,
            'total_participants' => $request->total_participants,
            'start_date' => $request->start_date,
            'status' => 'en_cours',
        ]);

        return redirect()->route('tontines.index')->with('success', 'Tontine créée avec succès');
    }

    public function show(Tontine $tontine)
    {
        // Charger les relations
        $tontine->load(['participants', 'contributions.membre']);
        
        // Récupérer les IDs des participants actuels
        $participantIds = $tontine->participants->pluck('id_membre');
        
        // Récupérer tous les membres avec débogage
        $allMembers = Membre::all();
        
        // Logs détaillés pour le débogage
        \Log::info('Tontine ID: ' . $tontine->id);
        \Log::info('Participants IDs: ' . $participantIds->implode(', '));
        \Log::info('Total Members: ' . $allMembers->count());
        
        // Logs détaillés sur tous les membres
        foreach ($allMembers as $membre) {
            \Log::info('Membre: ' . $membre->id_membre . ' - ' . $membre->nom . ' ' . $membre->prenom);
        }
        
        // Récupérer les membres disponibles (pas déjà dans la tontine)
        $availableMembers = Membre::whereNotIn('id_membre', $participantIds)->get();

        \Log::info('Available Members Count: ' . $availableMembers->count());
        
        // Logs détaillés sur les membres disponibles
        foreach ($availableMembers as $membre) {
            \Log::info('Available Membre: ' . $membre->id_membre . ' - ' . $membre->nom . ' ' . $membre->prenom);
        }
        
        // Préparer les données pour le graphique des contributions
        $contributions = $tontine->contributions->sortBy('date');
        $contributionDates = $contributions->pluck('date')->map(function($date) {
            return \Carbon\Carbon::parse($date)->format('d/m/Y');
        });
        $contributionAmounts = $contributions->pluck('amount');
        
        return view('tontines.details', compact(
            'tontine', 
            'availableMembers', 
            'contributionDates', 
            'contributionAmounts'
        ));
    }

    public function update(Request $request, Tontine $tontine)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'type' => 'sometimes|in:petite,grande',
            'amount_per_person' => 'sometimes|numeric|min:0',
            'total_participants' => 'sometimes|integer|min:2',
            'start_date' => 'sometimes|date',
            'status' => 'sometimes|in:en_cours,terminee,annulee',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $tontine->update($request->validated());

        return redirect()->route('tontines.index')->with('success', 'Tontine mise à jour avec succès');
    }

    public function destroy(Tontine $tontine)
    {
        $tontine->delete();
        return redirect()->route('tontines.index')->with('success', 'Tontine supprimée avec succès');
    }

    public function addParticipant(Request $request, Tontine $tontine)
    {
        $validator = Validator::make($request->all(), [
            'membre_id' => [
                'required', 
                'exists:membres,id_membre',
                Rule::unique('tontine_participants', 'membre_id')->where(function ($query) use ($tontine) {
                    return $query->where('tontine_id', $tontine->id);
                })
            ]
        ], [
            'membre_id.unique' => 'Ce membre est déjà participant de cette tontine.'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($tontine->current_participants >= $tontine->total_participants) {
            return redirect()->back()->with('error', 'La tontine a atteint son nombre maximum de participants');
        }

        try {
            DB::transaction(function () use ($tontine, $request) {
                $membre = Membre::where('id_membre', $request->membre_id)->firstOrFail();

                // Vérifier si le membre existe déjà comme participant
                $existingParticipant = DB::table('tontine_participants')
                    ->where('tontine_id', $tontine->id)
                    ->where('membre_id', $membre->id_membre)
                    ->first();

                if ($existingParticipant) {
                    throw new \Exception('Ce membre est déjà un participant de cette tontine.');
                }

                // Attacher le membre à la tontine
                DB::table('tontine_participants')->insert([
                    'tontine_id' => $tontine->id,
                    'membre_id' => $membre->id_membre,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

                // Incrémenter le nombre de participants
                $tontine->increment('current_participants');
            });

            return redirect()->route('tontines.show', $tontine)
                ->with('success', 'Participant ajouté avec succès');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Impossible d\'ajouter le participant : ' . $e->getMessage());
        }
    }

    public function removeParticipant(Tontine $tontine, User $user)
    {
        try {
            DB::transaction(function () use ($tontine, $user) {
                $tontine->participants()->detach($user);
                $tontine->decrement('current_participants');
            });

            return redirect()->route('tontines.show', $tontine)
                ->with('success', 'Participant retiré avec succès');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Impossible de retirer le participant : ' . $e->getMessage());
        }
    }

    public function addContribution(Request $request, Tontine $tontine)
    {
        // Valider les données de contribution
        $validator = Validator::make($request->all(), [
            'membre_id' => 'required|exists:membres,id_membre',
            'amount' => 'required|numeric|min:0',
            'contribution_date' => 'required|date',
            'description' => 'nullable|string'
        ]);

        // Gérer les erreurs de validation
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Vérifier si le membre existe
        $membre = Membre::where('id_membre', $request->membre_id)->firstOrFail();

        // Vérifier si le membre participe à la tontine
        $isParticipant = DB::table('tontine_participants')
            ->where('tontine_id', $tontine->id)
            ->where('membre_id', $membre->id_membre)
            ->exists();

        if (!$isParticipant) {
            return redirect()->back()->with('error', 'Ce membre ne participe pas à cette tontine.');
        }

        try {
            // Créer la contribution
            $contribution = new Contribution();
            $contribution->tontine_id = $tontine->id;
            $contribution->membre_id = $membre->id_membre;
            $contribution->amount = $request->amount;
            $contribution->contribution_date = $request->contribution_date;
            $contribution->description = $request->description ?? null;
            $contribution->save();

            // Mettre à jour les totaux de la tontine si nécessaire
            $tontine->updateContributionProgress();

            return redirect()->route('tontines.show', $tontine)
                ->with('success', 'Contribution ajoutée avec succès');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Impossible d\'ajouter la contribution : ' . $e->getMessage());
        }
    }
}
