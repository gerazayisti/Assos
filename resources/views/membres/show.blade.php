@extends('layouts.app')

@section('title', 'Détails du membre')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title">Détails du membre</h3>
                <div>
                    <a href="{{ route('membres.edit', $membre) }}" class="btn btn-warning">
                        <i class="fas fa-edit me-2"></i>Modifier
                    </a>
                    <a href="{{ route('membres.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Retour
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center mb-4">
                    @if($membre->photo_path)
                        <img src="{{ asset('storage/' . $membre->photo_path) }}" 
                             alt="Photo de {{ $membre->nom }}" 
                             class="img-thumbnail rounded-circle" 
                             style="width: 200px; height: 200px; object-fit: cover;">
                    @else
                        <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center" 
                             style="width: 200px; height: 200px;">
                            <i class="fas fa-user fa-5x text-secondary"></i>
                        </div>
                    @endif
                    <h4 class="mt-3">{{ $membre->nom }} {{ $membre->prenom }}</h4>
                    <p class="text-muted">{{ ucfirst($membre->role) }}</p>
                </div>
                
                <div class="col-md-8">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <h5 class="border-bottom pb-2">Informations personnelles</h5>
                            <dl class="row">
                                <dt class="col-sm-4">N° Membre</dt>
                                <dd class="col-sm-8">{{ $membre->numero_membre }}</dd>

                                <dt class="col-sm-4">Date de naissance</dt>
                                <dd class="col-sm-8">{{ $membre->date_naissance ? $membre->date_naissance->format('d/m/Y') : 'Non renseigné' }}</dd>

                                <dt class="col-sm-4">Lieu de naissance</dt>
                                <dd class="col-sm-8">{{ $membre->lieu_naissance ?: 'Non renseigné' }}</dd>

                                <dt class="col-sm-4">Sexe</dt>
                                <dd class="col-sm-8">{{ $membre->sexe == 'M' ? 'Masculin' : 'Féminin' }}</dd>

                                <dt class="col-sm-4">Profession</dt>
                                <dd class="col-sm-8">{{ $membre->profession ?: 'Non renseigné' }}</dd>
                            </dl>
                        </div>

                        <div class="col-md-6">
                            <h5 class="border-bottom pb-2">Coordonnées</h5>
                            <dl class="row">
                                <dt class="col-sm-4">Téléphone</dt>
                                <dd class="col-sm-8">{{ $membre->telephone ?: 'Non renseigné' }}</dd>

                                <dt class="col-sm-4">Email</dt>
                                <dd class="col-sm-8">{{ $membre->email ?: 'Non renseigné' }}</dd>

                                <dt class="col-sm-4">Adresse</dt>
                                <dd class="col-sm-8">{{ $membre->adresse ?: 'Non renseigné' }}</dd>
                            </dl>
                        </div>

                        <div class="col-12">
                            <h5 class="border-bottom pb-2">Informations d'adhésion</h5>
                            <dl class="row">
                                <dt class="col-sm-2">Date d'adhésion</dt>
                                <dd class="col-sm-4">{{ $membre->date_adhesion->format('d/m/Y') }}</dd>

                                <dt class="col-sm-2">Statut</dt>
                                <dd class="col-sm-4">
                                    <span class="badge bg-{{ $membre->statut == 'actif' ? 'success' : ($membre->statut == 'inactif' ? 'danger' : 'warning') }}">
                                        {{ ucfirst($membre->statut) }}
                                    </span>
                                </dd>

                                <dt class="col-sm-2">Rôle</dt>
                                <dd class="col-sm-4">{{ ucfirst($membre->role) }}</dd>

                                <dt class="col-sm-2">Dernière connexion</dt>
                                <dd class="col-sm-4">
                                    {{ $membre->derniere_connexion ? $membre->derniere_connexion->format('d/m/Y H:i') : 'Jamais connecté' }}
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
