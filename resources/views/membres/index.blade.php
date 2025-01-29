@extends('layouts.app')

@section('title', 'Liste des Membres')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Gestion des Membres</h2>
        <a href="{{ route('membres.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Nouveau Membre
        </a>
    </div>

    <!-- Search and Filter Section -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('membres.index') }}" method="GET" class="row g-3">
                <div class="col-md-3">
                    <input type="text" name="search" class="form-control" placeholder="Rechercher un membre..." value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <select name="statut" class="form-select">
                        <option value="">Statut</option>
                        <option value="actif" {{ request('statut') == 'actif' ? 'selected' : '' }}>Actif</option>
                        <option value="inactif" {{ request('statut') == 'inactif' ? 'selected' : '' }}>Inactif</option>
                        <option value="suspendu" {{ request('statut') == 'suspendu' ? 'selected' : '' }}>Suspendu</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="role" class="form-select">
                        <option value="">Rôle dans l'association</option>
                        <option value="president" {{ request('role') == 'president' ? 'selected' : '' }}>Président</option>
                        <option value="secretaire" {{ request('role') == 'secretaire' ? 'selected' : '' }}>Secrétaire</option>
                        <option value="tresorier" {{ request('role') == 'tresorier' ? 'selected' : '' }}>Trésorier</option>
                        <option value="membre" {{ request('role') == 'membre' ? 'selected' : '' }}>Membre</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-secondary w-100">Filtrer</button>
                </div>
            </form>
        </div>  
    </div>

    <!-- Members List -->
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>N° Membre</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Téléphone</th>
                            <th>Email</th>
                            <th>Statut</th>
                            <th>Rôle</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($membres as $membre)
                        <tr>
                            <td>{{ $membre->numero_membre }}</td>
                            <td>{{ $membre->nom }}</td>
                            <td>{{ $membre->prenom }}</td>
                            <td>{{ $membre->telephone }}</td>
                            <td>{{ $membre->email }}</td>
                            <td>
                                <span class="badge bg-{{ $membre->statut == 'actif' ? 'success' : ($membre->statut == 'inactif' ? 'danger' : 'warning') }}">
                                    {{ ucfirst($membre->statut) }}
                                </span>
                            </td>
                            <td>{{ ucfirst($membre->role) }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('membres.show', $membre) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('membres.edit', $membre) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('membres.destroy', $membre) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce membre ?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">Aucun membre trouvé</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end mt-3">
                {{ $membres->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
