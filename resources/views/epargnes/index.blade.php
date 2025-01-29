@extends('layouts.app')

@section('title', 'Gestion des Épargnes')

@section('content')
<!-- Header Section -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Gestion des Épargnes</h2>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEpargneModal">
        <i class="fas fa-plus me-2"></i>Nouvelle épargne
    </button>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Statistics Cards -->
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Épargne Annuelle</h5>
                <div class="mt-3">
                    <p class="mb-2">Total épargné: <strong>{{ number_format($epargneAnnuelle['total'], 0, ',', ' ') }} FCFA</strong></p>
                    <p class="mb-2">Membres épargnants: <strong>{{ $epargneAnnuelle['membres'] }}</strong></p>
                    <p class="mb-2">Moyenne par membre: <strong>{{ number_format($epargneAnnuelle['moyenne'], 0, ',', ' ') }} FCFA</strong></p>
                    <div class="progress mt-3">
                        <div class="progress-bar bg-success" role="progressbar" style="width: {{ $epargneAnnuelle['progression'] }}%">{{ $epargneAnnuelle['progression'] }}%</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Épargne Scolaire</h5>
                <div class="mt-3">
                    <p class="mb-2">Total épargné: <strong>{{ number_format($epargneScolaire['total'], 0, ',', ' ') }} FCFA</strong></p>
                    <p class="mb-2">Membres épargnants: <strong>{{ $epargneScolaire['membres'] }}</strong></p>
                    <p class="mb-2">Moyenne par membre: <strong>{{ number_format($epargneScolaire['moyenne'], 0, ',', ' ') }} FCFA</strong></p>
                    <div class="progress mt-3">
                        <div class="progress-bar bg-info" role="progressbar" style="width: {{ $epargneScolaire['progression'] }}%">{{ $epargneScolaire['progression'] }}%</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Statistiques Globales</h5>
                <div class="mt-3">
                    <p class="mb-2">Total des épargnes: <strong>{{ number_format($statsGlobales['totalEpargnes'], 0, ',', ' ') }} FCFA</strong></p>
                    <p class="mb-2">Épargnes actives: <strong>{{ $statsGlobales['epargnesActives'] }}</strong></p>
                    <p class="mb-2">Taux de participation: <strong>{{ $statsGlobales['tauxParticipation'] }}%</strong></p>
                    <button class="btn btn-outline-primary w-100 mt-3" data-bs-toggle="modal" data-bs-target="#statsDetailsModal">
                        <i class="fas fa-chart-bar me-2"></i>Voir les détails
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="card shadow-sm">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="card-title">Liste des Épargnes</h5>
            <div class="d-flex gap-2">
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" class="form-control" placeholder="Rechercher..." id="searchEpargne">
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Membre</th>
                        <th>Type</th>
                        <th>Montant</th>
                        <th>Date</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($epargnes as $epargne)
                    <tr>
                        <td>{{ $epargne->membre->nom }}</td>
                        <td>{{ $epargne->type }}</td>
                        <td>{{ number_format($epargne->montant, 0, ',', ' ') }} FCFA</td>
                        <td>{{ $epargne->date->format('d/m/Y') }}</td>
                        <td>
                            <span class="badge bg-{{ $epargne->statut === 'actif' ? 'success' : ($epargne->statut === 'en_attente' ? 'warning' : 'secondary') }}">
                                {{ ucfirst(str_replace('_', ' ', $epargne->statut)) }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-info btn-sm" onclick="showEpargneDetails({{ $epargne->id }})">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-primary btn-sm" onclick="editEpargne({{ $epargne->id }})">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-danger btn-sm" onclick="confirmDelete({{ $epargne->id }})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Aucune épargne trouvée</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end mt-3">
            {{ $epargnes->links() }}
        </div>
    </div>
</div>

@include('epargnes.modals.create')
@include('epargnes.modals.details')
@include('epargnes.modals.edit')
@include('epargnes.modals.stats')
@include('epargnes.modals.delete')

@push('scripts')
<script>
    function showEpargneDetails(id) {
        fetch(`/epargnes/${id}/details`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('detailMembre').textContent = data.membre.nom;
                document.getElementById('detailType').textContent = data.type;
                document.getElementById('detailMontant').textContent = new Intl.NumberFormat('fr-FR').format(data.montant) + ' FCFA';
                document.getElementById('detailDate').textContent = new Date(data.date).toLocaleDateString('fr-FR');
                document.getElementById('detailStatut').textContent = data.statut.charAt(0).toUpperCase() + data.statut.slice(1).replace('_', ' ');
                
                const modal = new bootstrap.Modal(document.getElementById('detailsEpargneModal'));
                modal.show();
            })
            .catch(error => {
                console.error('Erreur:', error);
                alert('Une erreur est survenue lors du chargement des détails');
            });
    }

    function editEpargne(id) {
        fetch(`/epargnes/${id}/edit`)
            .then(response => response.json())
            .then(data => {
                const form = document.getElementById('editEpargneForm');
                form.action = `/epargnes/${id}`;
                
                document.getElementById('edit_membre_id').value = data.membre_id;
                document.getElementById('edit_type').value = data.type;
                document.getElementById('edit_montant').value = data.montant;
                document.getElementById('edit_date').value = data.date;
                document.getElementById('edit_statut').value = data.statut;
                document.getElementById('edit_objectif').value = data.objectif || '';
                document.getElementById('edit_description').value = data.description || '';
                
                const modal = new bootstrap.Modal(document.getElementById('editEpargneModal'));
                modal.show();
            })
            .catch(error => {
                console.error('Erreur:', error);
                alert('Une erreur est survenue lors du chargement des données');
            });
    }

    function confirmDelete(id) {
        const form = document.getElementById('deleteEpargneForm');
        form.action = `/epargnes/${id}`;
        const modal = new bootstrap.Modal(document.getElementById('deleteEpargneModal'));
        modal.show();
    }

    document.getElementById('searchEpargne').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const rows = document.querySelectorAll('tbody tr');
        
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });
</script>
@endpush
@endsection
