@extends('layouts.app')

@section('title', 'Détails de la Tontine - {{ $tontine->name }}')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <!-- Informations de base de la tontine -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">{{ $tontine->name }}</h4>
                    <div>
                        <span class="badge {{ $tontine->status == 'en_cours' ? 'bg-success' : ($tontine->status == 'terminee' ? 'bg-secondary' : 'bg-danger') }}">
                            {{ $tontine->status == 'en_cours' ? 'En cours' : ($tontine->status == 'terminee' ? 'Terminée' : 'Annulée') }}
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Informations Générales</h6>
                            <p><strong>Type:</strong> {{ ucfirst($tontine->type) }}</p>
                            <p><strong>Date de début:</strong> {{ \Carbon\Carbon::parse($tontine->start_date)->format('d/m/Y') }}</p>
                            <p><strong>Description:</strong> {{ $tontine->description ?? 'Aucune description' }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6>Détails Financiers</h6>
                            <p><strong>Montant par personne:</strong> {{ number_format($tontine->amount_per_person, 0, ',', ' ') }} FCFA</p>
                            <p><strong>Participants:</strong> {{ $tontine->current_participants }}/{{ $tontine->total_participants }}</p>
                            <p><strong>Montant total potentiel:</strong> {{ number_format($tontine->amount_per_person * $tontine->total_participants, 0, ',', ' ') }} FCFA</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Liste des participants -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Participants</h5>
                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addParticipantModal">
                        <i class="fas fa-plus me-2"></i>Ajouter un participant
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Date d'ajout</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tontine->participants as $participant)
                                <tr>
                                    <td>{{ $participant->nom }} {{ $participant->prenom }}</td>
                                    <td>{{ $participant->email }}</td>
                                    <td>{{ \Carbon\Carbon::parse($participant->pivot->created_at)->format('d/m/Y') }}</td>
                                    <td>
                                        <form action="{{ route('tontines.remove-participant', [$tontine, $participant]) }}" method="POST" class="d-inline" onsubmit="return confirm('Voulez-vous vraiment retirer ce participant ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Retirer">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">Aucun participant pour le moment</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Contributions -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Contributions</h5>
                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addContributionModal">
                        <i class="fas fa-plus me-2"></i>Ajouter une contribution
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Participant</th>
                                    <th>Montant</th>
                                    <th>Date</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tontine->contributions as $contribution)
                                <tr>
                                    <td>{{ $contribution->membre->nom }} {{ $contribution->membre->prenom }}</td>
                                    <td>{{ number_format($contribution->amount, 0, ',', ' ') }} FCFA</td>
                                    <td>{{ \Carbon\Carbon::parse($contribution->contribution_date)->format('d/m/Y') }}</td>
                                    <td>
                                        @if($contribution->description)
                                            <span class="text-muted small" title="{{ $contribution->description }}">
                                                <i class="bi bi-info-circle"></i>
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">Aucune contribution enregistrée</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistiques et graphiques -->
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Statistiques</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 mb-3">
                            <small class="text-muted">Taux de participation</small>
                            <h5>{{ round(($tontine->current_participants / $tontine->total_participants) * 100, 2) }}%</h5>
                        </div>
                        <div class="col-6 mb-3">
                            <small class="text-muted">Total collecté</small>
                            <h5>{{ number_format($tontine->contributions->sum('amount'), 0, ',', ' ') }} FCFA</h5>
                        </div>
                        <div class="col-6 mb-3">
                            <small class="text-muted">Nombre de contributions</small>
                            <h5>{{ $tontine->contributions->count() }}</h5>
                        </div>
                        <div class="col-6 mb-3">
                            <small class="text-muted">Contributions payées</small>
                            <h5>{{ $tontine->contributions->where('status', 'payé')->count() }}</h5>
                        </div>
                        <div class="col-6 mb-3">
                            <small class="text-muted">Contributions en attente</small>
                            <h5>{{ $tontine->contributions->where('status', 'en_attente')->count() }}</h5>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Graphique de progression -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Progression des Contributions</h5>
                </div>
                <div class="card-body">
                    <canvas id="contributionsChart" height="250"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Modaux de tontine -->
    @include('tontines.modals.add_participant')
    @include('tontines.modals.add_contribution')

</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('contributionsChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($contributionDates),
            datasets: [{
                label: 'Contributions',
                data: @json($contributionAmounts),
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value.toLocaleString() + ' FCFA';
                        }
                    }
                }
            }
        }
    });
});
</script>
@endpush
