@extends('layouts.app')

@section('title', isset($membre) ? 'Modifier le membre' : 'Nouveau membre')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">{{ isset($membre) ? 'Modifier le membre' : 'Nouveau membre' }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ isset($membre) ? route('membres.update', $membre) : route('membres.store') }}" 
                  method="POST" 
                  enctype="multipart/form-data">
                @csrf
                @if(isset($membre))
                    @method('PUT')
                @endif

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom *</label>
                            <input type="text" class="form-control @error('nom') is-invalid @enderror" 
                                   id="nom" name="nom" required 
                                   value="{{ old('nom', $membre->nom ?? '') }}">
                            @error('nom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="prenom" class="form-label">Prénom *</label>
                            <input type="text" class="form-control @error('prenom') is-invalid @enderror" 
                                   id="prenom" name="prenom" required 
                                   value="{{ old('prenom', $membre->prenom ?? '') }}">
                            @error('prenom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="date_naissance" class="form-label">Date de naissance</label>
                            <input type="date" class="form-control @error('date_naissance') is-invalid @enderror" 
                                   id="date_naissance" name="date_naissance" 
                                   value="{{ old('date_naissance', isset($membre) ? $membre->date_naissance->format('Y-m-d') : '') }}">
                            @error('date_naissance')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="lieu_naissance" class="form-label">Lieu de naissance</label>
                            <input type="text" class="form-control @error('lieu_naissance') is-invalid @enderror" 
                                   id="lieu_naissance" name="lieu_naissance" 
                                   value="{{ old('lieu_naissance', $membre->lieu_naissance ?? '') }}">
                            @error('lieu_naissance')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="sexe" class="form-label">Sexe *</label>
                            <select class="form-select @error('sexe') is-invalid @enderror" 
                                    id="sexe" name="sexe" required>
                                <option value="">Sélectionner</option>
                                <option value="M" {{ old('sexe', $membre->sexe ?? '') == 'M' ? 'selected' : '' }}>Masculin</option>
                                <option value="F" {{ old('sexe', $membre->sexe ?? '') == 'F' ? 'selected' : '' }}>Féminin</option>
                            </select>
                            @error('sexe')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="telephone" class="form-label">Téléphone</label>
                            <input type="tel" class="form-control @error('telephone') is-invalid @enderror" 
                                   id="telephone" name="telephone" 
                                   value="{{ old('telephone', $membre->telephone ?? '') }}">
                            @error('telephone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" 
                                   value="{{ old('email', $membre->email ?? '') }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="adresse" class="form-label">Adresse</label>
                            <textarea class="form-control @error('adresse') is-invalid @enderror" 
                                      id="adresse" name="adresse" rows="3">{{ old('adresse', $membre->adresse ?? '') }}</textarea>
                            @error('adresse')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="profession" class="form-label">Profession</label>
                            <input type="text" class="form-control @error('profession') is-invalid @enderror" 
                                   id="profession" name="profession" 
                                   value="{{ old('profession', $membre->profession ?? '') }}">
                            @error('profession')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="statut" class="form-label">Statut *</label>
                            <select class="form-select @error('statut') is-invalid @enderror" 
                                    id="statut" name="statut" required>
                                <option value="actif" {{ old('statut', $membre->statut ?? '') == 'actif' ? 'selected' : '' }}>Actif</option>
                                <option value="inactif" {{ old('statut', $membre->statut ?? '') == 'inactif' ? 'selected' : '' }}>Inactif</option>
                                <option value="suspendu" {{ old('statut', $membre->statut ?? '') == 'suspendu' ? 'selected' : '' }}>Suspendu</option>
                            </select>
                            @error('statut')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">Rôle *</label>
                            <select class="form-select @error('role') is-invalid @enderror" 
                                    id="role" name="role" required>
                                <option value="membre" {{ old('role', $membre->role ?? '') == 'membre' ? 'selected' : '' }}>Membre</option>
                                <option value="admin" {{ old('role', $membre->role ?? '') == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="tresorier" {{ old('role', $membre->role ?? '') == 'tresorier' ? 'selected' : '' }}>Trésorier</option>
                                <option value="secretaire" {{ old('role', $membre->role ?? '') == 'secretaire' ? 'selected' : '' }}>Secrétaire</option>
                                <option value="president" {{ old('role', $membre->role ?? '') == 'president' ? 'selected' : '' }}>Président</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        @if(!isset($membre))
                        <div class="mb-3">
                            <label for="mot_de_passe" class="form-label">Mot de passe *</label>
                            <input type="password" class="form-control @error('mot_de_passe') is-invalid @enderror" 
                                   id="mot_de_passe" name="mot_de_passe" required>
                            @error('mot_de_passe')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        @endif

                        <div class="mb-3">
                            <label for="photo" class="form-label">Photo</label>
                            <input type="file" class="form-control @error('photo') is-invalid @enderror" 
                                   id="photo" name="photo" accept="image/*">
                            @error('photo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        {{ isset($membre) ? 'Mettre à jour' : 'Enregistrer' }}
                    </button>
                    <a href="{{ route('membres.index') }}" class="btn btn-secondary">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
