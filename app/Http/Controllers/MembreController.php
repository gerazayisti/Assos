<?php

namespace App\Http\Controllers;

use App\Models\Membre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MembreController extends Controller
{
    public function index()
    {
        $membres = Membre::orderBy('nom')->paginate(10);
        return view('membres.index', compact('membres'));
    }

    public function create()
    {
        return view('membres.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:100',
            'prenom' => 'required|string|max:100',
            'date_naissance' => 'nullable|date',
            'lieu_naissance' => 'nullable|string|max:100',
            'sexe' => 'required|in:M,F',
            'telephone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'adresse' => 'nullable|string',
            'profession' => 'nullable|string|max:100',
            'statut' => 'required|in:actif,inactif,suspendu',
            'role' => 'required|in:membre,admin,tresorier,secretaire,president',
            'mot_de_passe' => 'required|min:6'
        ]);

        $validated['numero_membre'] = 'M' . date('Y') . str_pad(Membre::count() + 1, 4, '0', STR_PAD_LEFT);
        $validated['mot_de_passe'] = Hash::make($validated['mot_de_passe']);

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $filename = Str::slug($validated['nom'] . '-' . $validated['prenom']) . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('public/membres', $filename);
            $validated['photo_path'] = 'membres/' . $filename;
        }

        Membre::create($validated);

        return redirect()->route('membres.index')->with('success', 'Membre ajouté avec succès');
    }

    public function show(Membre $membre)
    {
        return view('membres.show', compact('membre'));
    }

    public function edit(Membre $membre)
    {
        return view('membres.form', compact('membre'));
    }

    public function update(Request $request, Membre $membre)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:100',
            'prenom' => 'required|string|max:100',
            'date_naissance' => 'nullable|date',
            'lieu_naissance' => 'nullable|string|max:100',
            'sexe' => 'required|in:M,F',
            'telephone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'adresse' => 'nullable|string',
            'profession' => 'nullable|string|max:100',
            'statut' => 'required|in:actif,inactif,suspendu',
            'role' => 'required|in:membre,admin,tresorier,secretaire,president'
        ]);

        if ($request->filled('mot_de_passe')) {
            $validated['mot_de_passe'] = Hash::make($request->mot_de_passe);
        }

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $filename = Str::slug($validated['nom'] . '-' . $validated['prenom']) . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('public/membres', $filename);
            $validated['photo_path'] = 'membres/' . $filename;
        }

        $membre->update($validated);

        return redirect()->route('membres.index')->with('success', 'Membre mis à jour avec succès');
    }

    public function destroy(Membre $membre)
    {
        $membre->delete();
        return redirect()->route('membres.index')->with('success', 'Membre supprimé avec succès');
    }
}
