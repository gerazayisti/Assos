@extends('layouts.app')

@section('title', 'Accueil')

@section('content')
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
                        <h5 class="card-title">Petite Tontine</h5>
                        <div class="mt-3">
                            <p class="mb-2">Montant par personne: <strong>10,000 FCFA</strong></p>
                            <p class="mb-2">Participants: <strong>15/20</strong></p>
                            <p class="mb-2">Prochain bénéficiaire: <strong>John Doe</strong></p>
                            <div class="progress mt-3">
                                <div class="progress-bar" role="progressbar" style="width: 75%">75%</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Grande Tontine</h5>
                        <div class="mt-3">
                            <p class="mb-2">Montant par personne: <strong>50,000 FCFA</strong></p>
                            <p class="mb-2">Participants: <strong>10/12</strong></p>
                            <p class="mb-2">Prochain bénéficiaire: <strong>Jane Smith</strong></p>
                            <div class="progress mt-3">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 83%">83%</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Statistiques</h5>
                        <div class="mt-3">
                            <p class="mb-2">Total des tontines: <strong>2</strong></p>
                            <p class="mb-2">Montant total: <strong>750,000 FCFA</strong></p>
                            <p class="mb-2">Participants totaux: <strong>25</strong></p>
                            <button class="btn btn-outline-primary w-100 mt-3" data-bs-toggle="modal" data-bs-target="#statsDetailsModal">
                                Voir les détails
                            </button>
                        </div>
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
                            <tr>
                                <td>Tontine A</td>
                                <td>Petite</td>
                                <td>10,000 FCFA</td>
                                <td>15/20</td>
                                <td>01/01/2024</td>
                                <td><span class="badge bg-success">En cours</span></td>
                                <td>
                                    <button class="btn btn-sm btn-info me-1" title="Voir détails" onclick="openTontineDetails(1)">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-warning me-1" title="Éditer">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- Add Tontine Modal -->
    <div class="modal fade" id="addTontineModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Créer une nouvelle tontine</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Nom de la tontine</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Type</label>
                            <select class="form-select" required>
                                <option value="">Sélectionner un type</option>
                                <option value="petite">Petite Tontine</option>
                                <option value="grande">Grande Tontine</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Montant par personne</label>
                            <input type="number" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nombre de participants</label>
                            <input type="number" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Date de début</label>
                            <input type="date" class="form-control" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary">Créer la tontine</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Détails Statistiques -->
    <div class="modal fade" id="statsDetailsModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title">
                        <i class="fas fa-chart-bar me-2 text-primary"></i>
                        Statistiques Détaillées des Tontines
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <!-- Résumé des tontines -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-3">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <h6 class="card-title">Tontines Actives</h6>
                                    <h2 class="mb-0">3</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <h6 class="card-title">Montant Total</h6>
                                    <h2 class="mb-0">2.5M</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-info text-white">
                                <div class="card-body">
                                    <h6 class="card-title">Participants</h6>
                                    <h2 class="mb-0">25</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-warning text-white">
                                <div class="card-body">
                                    <h6 class="card-title">Tours Complétés</h6>
                                    <h2 class="mb-0">12</h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Graphiques détaillés -->
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">Évolution Mensuelle</h6>
                                    <canvas id="monthlyProgressChart" height="200"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">Répartition par Type</h6>
                                    <canvas id="tontineTypeChart" height="200"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tableau des performances -->
                    <div class="card mt-4">
                        <div class="card-body">
                            <h6 class="card-title">Performance par Type de Tontine</h6>
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>Type</th>
                                            <th>Participants</th>
                                            <th>Montant Moyen</th>
                                            <th>Taux de Réussite</th>
                                            <th>Tendance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Mensuelle</td>
                                            <td>12</td>
                                            <td>50,000 FCFA</td>
                                            <td>95%</td>
                                            <td><i class="fas fa-arrow-up text-success"></i></td>
                                        </tr>
                                        <tr>
                                            <td>Trimestrielle</td>
                                            <td>8</td>
                                            <td>150,000 FCFA</td>
                                            <td>85%</td>
                                            <td><i class="fas fa-arrow-right text-warning"></i></td>
                                        </tr>
                                        <tr>
                                            <td>Annuelle</td>
                                            <td>5</td>
                                            <td>500,000 FCFA</td>
                                            <td>75%</td>
                                            <td><i class="fas fa-arrow-down text-danger"></i></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="button" class="btn btn-primary" onclick="exportStatsToExcel()">
                        <i class="fas fa-file-excel me-2"></i>Exporter
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Détails Tontine -->
    <div class="modal fade" id="tontineDetailsModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title">
                        <i class="fas fa-info-circle me-2 text-primary"></i>
                        Détails de la Tontine
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <!-- Informations de base -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="card-title mb-3">Informations Générales</h6>
                                    <div class="mb-2">
                                        <small class="text-muted">Nom de la tontine</small>
                                        <div id="tontineName" class="fw-bold">Tontine Mensuelle</div>
                                    </div>
                                    <div class="mb-2">
                                        <small class="text-muted">Type</small>
                                        <div id="tontineType" class="fw-bold">Mensuel</div>
                                    </div>
                                    <div class="mb-2">
                                        <small class="text-muted">Date de début</small>
                                        <div id="tontineStartDate" class="fw-bold">01/01/2024</div>
                                    </div>
                                    <div class="mb-2">
                                        <small class="text-muted">Statut</small>
                                        <div><span id="tontineStatus" class="badge bg-success">Active</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="card-title mb-3">Détails Financiers</h6>
                                    <div class="mb-2">
                                        <small class="text-muted">Montant par personne</small>
                                        <div id="tontineAmount" class="fw-bold">50,000 FCFA</div>
                                    </div>
                                    <div class="mb-2">
                                        <small class="text-muted">Total collecté</small>
                                        <div id="tontineTotal" class="fw-bold">600,000 FCFA</div>
                                    </div>
                                    <div class="mb-2">
                                        <small class="text-muted">Prochain versement</small>
                                        <div id="nextPayment" class="fw-bold">15/01/2024</div>
                                    </div>
                                    <div class="mb-2">
                                        <small class="text-muted">Tours restants</small>
                                        <div id="remainingRounds" class="fw-bold">10</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Liste des participants -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <h6 class="card-title mb-3">Participants et Tours</h6>
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>Membre</th>
                                            <th>Tour</th>
                                            <th>Date Prévue</th>
                                            <th>Montant</th>
                                            <th>Statut</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="participantsList">
                                        <tr>
                                            <td>John Doe</td>
                                            <td>1</td>
                                            <td>15/01/2024</td>
                                            <td>600,000 FCFA</td>
                                            <td><span class="badge bg-success">Reçu</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-info" title="Voir historique">
                                                    <i class="fas fa-history"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Graphique de progression -->
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title mb-3">Progression des Tours</h6>
                            <canvas id="toursProgressChart" height="200"></canvas>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="button" class="btn btn-success me-2" onclick="exportTontineDetails()">
                        <i class="fas fa-file-excel me-2"></i>Exporter
                    </button>
                    <button type="button" class="btn btn-primary" onclick="printTontineDetails()">
                        <i class="fas fa-print me-2"></i>Imprimer
                    </button>
                </div>
            </div>
        </div>
    </div>


    <!-- Scripts -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/settings.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    // Fonction pour ouvrir les détails des statistiques
    function openStatsDetails() {
        // Initialiser les graphiques
        initMonthlyProgressChart();
        initTontineTypeChart();
        
        // Afficher le modal
        const modal = new bootstrap.Modal(document.getElementById('statsDetailsModal'));
        modal.show();
    }

    // Fonction pour ouvrir les détails d'une tontine
    function openTontineDetails(tontineId) {
        // Charger les données de la tontine
        loadTontineData(tontineId);
        
        // Initialiser le graphique de progression
        initToursProgressChart();
        
        // Afficher le modal
        const modal = new bootstrap.Modal(document.getElementById('tontineDetailsModal'));
        modal.show();
    }

    // Initialisation du graphique d'évolution mensuelle
    function initMonthlyProgressChart() {
        const ctx = document.getElementById('monthlyProgressChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun'],
                datasets: [{
                    label: 'Montant Collecté',
                    data: [300000, 600000, 900000, 1200000, 1800000, 2500000],
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
                            callback: value => value.toLocaleString() + ' FCFA'
                        }
                    }
                }
            }
        });
    }

    // Initialisation du graphique de types de tontines
    function initTontineTypeChart() {
        const ctx = document.getElementById('tontineTypeChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Mensuelle', 'Trimestrielle', 'Annuelle'],
                datasets: [{
                    data: [12, 8, 5],
                    backgroundColor: [
                        'rgb(75, 192, 192)',
                        'rgb(255, 205, 86)',
                        'rgb(255, 99, 132)'
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    }

    // Initialisation du graphique de progression des tours
    function initToursProgressChart() {
        const ctx = document.getElementById('toursProgressChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Tour 1', 'Tour 2', 'Tour 3', 'Tour 4', 'Tour 5', 'Tour 6'],
                datasets: [{
                    label: 'Montant par tour',
                    data: [600000, 600000, 50000, 30000, 90000, 0],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgb(75, 192, 192)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: value => value.toLocaleString() + ' FCFA'
                        }
                    }
                }
            }
        });
    }

    // Fonction pour charger les données d'une tontine
    function loadTontineData(tontineId) {
        // Simuler le chargement des données
        // Dans un cas réel, vous feriez un appel API
        const data = {
            name: 'Tontine Mensuelle',
            type: 'Mensuel',
            startDate: '01/01/2024',
            status: 'Active',
            amount: '50,000 FCFA',
            total: '600,000 FCFA',
            nextPayment: '15/01/2024',
            remainingRounds: 10
        };

        // Mettre à jour les éléments du DOM
        document.getElementById('tontineName').textContent = data.name;
        document.getElementById('tontineType').textContent = data.type;
        document.getElementById('tontineStartDate').textContent = data.startDate;
        document.getElementById('tontineStatus').textContent = data.status;
        document.getElementById('tontineAmount').textContent = data.amount;
        document.getElementById('tontineTotal').textContent = data.total;
        document.getElementById('nextPayment').textContent = data.nextPayment;
        document.getElementById('remainingRounds').textContent = data.remainingRounds;
    }

    // Fonction pour exporter les statistiques
    function exportStatsToExcel() {
        // Implémenter l'export Excel
        alert('Export des statistiques en cours...');
    }

    // Fonction pour exporter les détails d'une tontine
    function exportTontineDetails() {
        // Implémenter l'export Excel
        alert('Export des détails en cours...');
    }

    // Fonction pour imprimer les détails
    function printTontineDetails() {
        window.print();
    }
    </script>
@endsection
