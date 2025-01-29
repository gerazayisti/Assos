<?php

namespace App\Http\Controllers;

use App\Models\Epargne;
use App\Models\Membre;
use Illuminate\Http\Request;
use App\Exports\EpargnesExport;
use Maatwebsite\Excel\Facades\Excel;

class EpargnesController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Display a listing of epargnes.
     */
    public function index()
    {
        $epargnesAnnuelles = Epargne::where('type', 'Régulière')->get();
        $epargnesScolaires = Epargne::where('type', 'Projet')->get();

        $data = [
            'epargnes' => Epargne::with('membre')->latest()->paginate(10),
            'membres' => Membre::all(),
            
            // Statistiques Épargne Annuelle
            'epargneAnnuelle' => [
                'total' => $epargnesAnnuelles->sum('montant'),
                'membres' => $epargnesAnnuelles->unique('membre_id')->count(),
                'moyenne' => $epargnesAnnuelles->count() > 0 ? $epargnesAnnuelles->avg('montant') : 0,
                'progression' => $this->calculateProgression($epargnesAnnuelles),
            ],
            
            // Statistiques Épargne Scolaire
            'epargneScolaire' => [
                'total' => $epargnesScolaires->sum('montant'),
                'membres' => $epargnesScolaires->unique('membre_id')->count(),
                'moyenne' => $epargnesScolaires->count() > 0 ? $epargnesScolaires->avg('montant') : 0,
                'progression' => $this->calculateProgression($epargnesScolaires),
            ],
            
            // Statistiques Globales
            'statsGlobales' => [
                'totalEpargnes' => Epargne::sum('montant'),
                'epargnesActives' => Epargne::where('statut', 'actif')->count(),
                'tauxParticipation' => $this->calculateTauxParticipation(),
                'moyenneEpargnes' => Epargne::avg('montant'),
                'maxEpargne' => Epargne::max('montant'),
                'minEpargne' => Epargne::min('montant'),
                'epargnesEnAttente' => Epargne::where('statut', 'en_attente')->count(),
                'objectifAtteint' => $this->calculateObjectifAtteint(),
            ],
        ];

        return view('epargnes.index', $data);
    }

    /**
     * Store a newly created epargne.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'membre_id' => 'required|exists:membres,id_membre',
            'type' => 'required|in:Régulière,Projet,Retraite',
            'montant' => 'required|numeric|min:0',
            'date' => 'required|date',
            'objectif' => 'nullable|numeric|min:0',
            'description' => 'nullable|string|max:1000'
        ]);

        // Ajout du statut par défaut si non spécifié
        $validated['statut'] = $validated['statut'] ?? 'actif';

        try {
            $epargne = Epargne::create($validated);
            return redirect()->route('epargnes.index')
                ->with('success', 'Épargne créée avec succès');
        } catch (\Exception $e) {
            return redirect()->route('epargnes.index')
                ->with('error', 'Erreur lors de la création de l\'épargne: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified epargne details.
     */
    public function details(Epargne $epargne)
    {
        $epargne->load('membre');
        return response()->json($epargne);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Epargne $epargne)
    {
        $epargne->load('membre');
        return response()->json($epargne);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Epargne $epargne)
    {
        $validated = $request->validate([
            'membre_id' => 'required|exists:membres,id_membre',
            'type' => 'required|in:Régulière,Projet,Retraite',
            'montant' => 'required|numeric|min:0',
            'date' => 'required|date',
            'statut' => 'required|in:actif,en_attente,termine',
            'objectif' => 'nullable|numeric|min:0',
            'description' => 'nullable|string|max:1000'
        ]);

        try {
            $epargne->update($validated);
            return redirect()->route('epargnes.index')
                ->with('success', 'Épargne modifiée avec succès');
        } catch (\Exception $e) {
            return redirect()->route('epargnes.index')
                ->with('error', 'Erreur lors de la modification de l\'épargne: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Epargne $epargne)
    {
        try {
            $epargne->delete();
            return redirect()->route('epargnes.index')
                ->with('success', 'Épargne supprimée avec succès');
        } catch (\Exception $e) {
            return redirect()->route('epargnes.index')
                ->with('error', 'Erreur lors de la suppression de l\'épargne: ' . $e->getMessage());
        }
    }

    /**
     * Export epargnes statistics to Excel.
     */
    public function exportStats()
    {
        return Excel::download(new EpargnesExport, 'statistiques-epargnes.xlsx');
    }

    /**
     * Export specific epargne details to Excel.
     */
    public function exportDetails(Epargne $epargne)
    {
        // Implementation for exporting specific epargne details
    }

    /**
     * Calculate the percentage of achieved savings goals.
     */
    private function calculateObjectifAtteint()
    {
        $totalObjectif = Epargne::sum('objectif');
        if ($totalObjectif === 0) return 0;

        $totalEpargne = Epargne::sum('montant');
        return round(($totalEpargne / $totalObjectif) * 100);
    }

    /**
     * Calculer la progression des épargnes
     */
    private function calculateProgression($epargnes)
    {
        $totalObjectif = $epargnes->sum('objectif');
        if ($totalObjectif === 0) return 0;

        $totalEpargne = $epargnes->sum('montant');
        return round(($totalEpargne / $totalObjectif) * 100);
    }

    /**
     * Calculer le taux de participation
     */
    private function calculateTauxParticipation()
    {
        $totalMembres = Membre::count();
        if ($totalMembres === 0) return 0;

        $membresActifs = Epargne::distinct('membre_id')->count('membre_id');
        return round(($membresActifs / $totalMembres) * 100);
    }
}
