@extends('layouts.app')

@section('title', 'Gestion des Tontines')

@section('content')
    <div class="container-fluid">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Gestion des Tontines</h2>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTontineModal">
                <i class="fas fa-plus me-2"></i>Nouvelle Tontine
            </button>
        </div>

        <!-- Tontines Overview -->
        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Total des Tontines</h5>
                        <h2 class="display-6">{{ $tontines->count() }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Montant Total</h5>
                        <h2 class="display-6">{{ number_format($tontines->sum('amount_per_person') * $tontines->sum('total_participants'), 0, ',', ' ') }} FCFA</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Participants Totaux</h5>
                        <h2 class="display-6">{{ $tontines->sum('current_participants') }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Active Tontines Table -->
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title mb-4">Tontines en cours</h5>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Type</th>
                                <th>Montant</th>
                                <th>Participants</th>
                                <th>Date début</th>
                                <th>État</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tontines as $tontine)
                            <tr>
                                <td>{{ $tontine->name }}</td>
                                <td>{{ ucfirst($tontine->type) }}</td>
                                <td>{{ number_format($tontine->amount_per_person, 0, ',', ' ') }} FCFA</td>
                                <td>{{ $tontine->current_participants }}/{{ $tontine->total_participants }}</td>
                                <td>{{ \Carbon\Carbon::parse($tontine->start_date)->format('d/m/Y') }}</td>
                                <td>
                                    @switch($tontine->status)
                                        @case('en_cours')
                                            <span class="badge bg-success">En cours</span>
                                            @break
                                        @case('terminee')
                                            <span class="badge bg-secondary">Terminée</span>
                                            @break
                                        @case('annulee')
                                            <span class="badge bg-danger">Annulée</span>
                                            @break
                                    @endswitch
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('tontines.show', $tontine) }}" class="btn btn-sm btn-info" title="Voir détails">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <button class="btn btn-sm btn-warning" title="Éditer" data-bs-toggle="modal" data-bs-target="#editTontineModal{{ $tontine->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ route('tontines.destroy', $tontine) }}" method="POST" class="d-inline" onsubmit="return confirm('Voulez-vous vraiment supprimer cette tontine ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Supprimer">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modaux de tontines -->
    @include('tontines.modals.create')
    @include('tontines.modals.edit')
@endsection
