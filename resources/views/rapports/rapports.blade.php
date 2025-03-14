@extends('layouts.app')

@section('title', 'Accueil')

@section('content')
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Rapports et Statistiques</h2>
            <div class="d-flex gap-2">
                <select class="form-select" style="width: 200px;">
                    <option value="2024">Année 2024</option>
                    <option value="2023">Année 2023</option>
                </select>
                <button class="btn btn-primary">
                    <i class="fas fa-download me-2"></i>Exporter
                </button>
            </div>
        </div>

        <!-- Financial Overview -->
        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h6 class="text-muted">Total des épargnes</h6>
                        <h3 class="mb-0">4,500,000 FCFA</h3>
                        <small class="text-success">
                            <i class="fas fa-arrow-up"></i> +15% depuis le dernier mois
                        </small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h6 class="text-muted">Total des prêts</h6>
                        <h3 class="mb-0">3,200,000 FCFA</h3>
                        <small class="text-danger">
                            <i class="fas fa-arrow-down"></i> -5% depuis le dernier mois
                        </small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h6 class="text-muted">Intérêts générés</h6>
                        <h3 class="mb-0">450,000 FCFA</h3>
                        <small class="text-success">
                            <i class="fas fa-arrow-up"></i> +8% depuis le dernier mois
                        </small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h6 class="text-muted">Membres actifs</h6>
                        <h3 class="mb-0">45</h3>
                        <small class="text-success">
                            <i class="fas fa-arrow-up"></i> +3 ce mois
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="row g-4 mb-4">
            <!-- Épargnes Chart -->
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Évolution des épargnes</h5>
                        <div style="height: 200px;">
                            <canvas id="epargnesChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Prêts Chart -->
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Distribution des prêts</h5>
                        <div style="height: 200px;">
                            <canvas id="pretsChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detailed Reports -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h5 class="card-title mb-4">Rapports détaillés</h5>
                
                <!-- Rapports mensuels -->
                <div class="mb-4">
                    <h6 class="border-bottom pb-2">Rapports Mensuels</h6>
                    <div class="list-group">
                        <div class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col-md-3">
                                    <strong>Décembre 2024</strong>
                                </div>
                                <div class="col-md-7">
                                    <div class="btn-group w-100">
                                        <button class="btn btn-outline-primary btn-sm" onclick="openMonthlyReport('epargnes')">
                                            <i class="fas fa-file-alt me-1"></i>Épargnes
                                        </button>
                                        <button class="btn btn-outline-primary btn-sm" onclick="openMonthlyReport('tontines')">
                                            <i class="fas fa-money-bill-wave me-1"></i>Tontines
                                        </button>
                                        <button class="btn btn-outline-primary btn-sm" onclick="openMonthlyReport('prets')">
                                            <i class="fas fa-hand-holding-usd me-1"></i>Prêts
                                        </button>
                                        <button class="btn btn-outline-primary btn-sm" onclick="openMonthlyReport('activites')">
                                            <i class="fas fa-calendar-alt me-1"></i>Activités
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-2 text-end">
                                    <button class="btn btn-success btn-sm" title="Télécharger tous les rapports du mois">
                                        <i class="fas fa-download me-1"></i>Tout
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col-md-3">
                                    <strong>Novembre 2024</strong>
                                </div>
                                <div class="col-md-7">
                                    <div class="btn-group w-100">
                                        <button class="btn btn-outline-primary btn-sm" onclick="openMonthlyReport('epargnes')">
                                            <i class="fas fa-file-alt me-1"></i>Épargnes
                                        </button>
                                        <button class="btn btn-outline-primary btn-sm" onclick="openMonthlyReport('tontines')">
                                            <i class="fas fa-money-bill-wave me-1"></i>Tontines
                                        </button>
                                        <button class="btn btn-outline-primary btn-sm" onclick="openMonthlyReport('prets')">
                                            <i class="fas fa-hand-holding-usd me-1"></i>Prêts
                                        </button>
                                        <button class="btn btn-outline-primary btn-sm" onclick="openMonthlyReport('activites')">
                                            <i class="fas fa-calendar-alt me-1"></i>Activités
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-2 text-end">
                                    <button class="btn btn-success btn-sm" title="Télécharger tous les rapports du mois">
                                        <i class="fas fa-download me-1"></i>Tout
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-2">
                        <button class="btn btn-link btn-sm">Voir les mois précédents</button>
                    </div>
                </div>

                <!-- Rapports annuels -->
                <div>
                    <h6 class="border-bottom pb-2">Rapports Annuels</h6>
                    <div class="list-group">
                        <div class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col-md-3">
                                    <strong>Année 2024</strong>
                                </div>
                                <div class="col-md-7">
                                    <div class="btn-group w-100">
                                        <button class="btn btn-outline-primary btn-sm" onclick="openAnnualReport('bilan')">
                                            <i class="fas fa-chart-line me-1"></i>Bilan Financier
                                        </button>
                                        <button class="btn btn-outline-primary btn-sm" onclick="openAnnualReport('social')">
                                            <i class="fas fa-users me-1"></i>Rapport Social
                                        </button>
                                        <button class="btn btn-outline-primary btn-sm" onclick="openAnnualReport('audit')">
                                            <i class="fas fa-clipboard-check me-1"></i>Audit
                                        </button>
                                        <button class="btn btn-outline-primary btn-sm" onclick="openAnnualReport('stats')">
                                            <i class="fas fa-chart-pie me-1"></i>Statistiques
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-2 text-end">
                                    <button class="btn btn-success btn-sm" title="Télécharger tous les rapports annuels">
                                        <i class="fas fa-download me-1"></i>Tout
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col-md-3">
                                    <strong>Année 2023</strong>
                                </div>
                                <div class="col-md-7">
                                    <div class="btn-group w-100">
                                        <button class="btn btn-outline-primary btn-sm" onclick="openAnnualReport('bilan')">
                                            <i class="fas fa-chart-line me-1"></i>Bilan Financier
                                        </button>
                                        <button class="btn btn-outline-primary btn-sm" onclick="openAnnualReport('social')">
                                            <i class="fas fa-users me-1"></i>Rapport Social
                                        </button>
                                        <button class="btn btn-outline-primary btn-sm" onclick="openAnnualReport('audit')">
                                            <i class="fas fa-clipboard-check me-1"></i>Audit
                                        </button>
                                        <button class="btn btn-outline-primary btn-sm" onclick="openAnnualReport('stats')">
                                            <i class="fas fa-chart-pie me-1"></i>Statistiques
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-2 text-end">
                                    <button class="btn btn-success btn-sm" title="Télécharger tous les rapports annuels">
                                        <i class="fas fa-download me-1"></i>Tout
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modales des Rapports Mensuels -->
    <!-- Modal Épargnes -->
    <div class="modal fade" id="monthlyEpargnesModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-file-alt me-2"></i>
                        Rapport Mensuel des Épargnes
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-4">
                        <!-- Résumé -->
                        <div class="col-12">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="card-title">Vue d'ensemble</h6>
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <small class="text-muted">Total des épargnes</small>
                                            <div class="h5 mb-0">2,000,000 FCFA</div>
                                        </div>
                                        <div class="col-md-4">
                                            <small class="text-muted">Croissance mensuelle</small>
                                            <div class="h5 mb-0">+15%</div>
                                        </div>
                                        <div class="col-md-4">
                                            <small class="text-muted">Membres épargnants</small>
                                            <div class="h5 mb-0">45</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Graphique d'évolution -->
                        <div class="col-md-7">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">Évolution des épargnes</h6>
                                    <canvas id="monthlyEpargnesEvolutionChart"></canvas>
                                </div>
                            </div>
                        </div>

                        <!-- Graphique de distribution -->
                        <div class="col-md-5">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">Distribution des épargnes</h6>
                                    <canvas id="monthlyEpargnesDistributionChart"></canvas>
                                </div>
                            </div>
                        </div>

                        <!-- Tableau détaillé -->
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">Détails des épargnes par type</h6>
                                    <div class="table-responsive">
                                        <table class="table table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Type d'épargne</th>
                                                    <th>Nombre de membres</th>
                                                    <th>Montant total</th>
                                                    <th>% du total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Épargne Régulière</td>
                                                    <td>35</td>
                                                    <td>800,000 FCFA</td>
                                                    <td>40%</td>
                                                </tr>
                                                <tr>
                                                    <td>Épargne Projet</td>
                                                    <td>25</td>
                                                    <td>600,000 FCFA</td>
                                                    <td>30%</td>
                                                </tr>
                                                <tr>
                                                    <td>Épargne Éducation</td>
                                                    <td>20</td>
                                                    <td>400,000 FCFA</td>
                                                    <td>20%</td>
                                                </tr>
                                                <tr>
                                                    <td>Épargne Retraite</td>
                                                    <td>10</td>
                                                    <td>200,000 FCFA</td>
                                                    <td>10%</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="button" class="btn btn-primary" onclick="downloadReport('epargnes', 'monthly')">
                        <i class="fas fa-download me-2"></i>Télécharger en PDF
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Prêts -->
    <div class="modal fade" id="monthlyPretsModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-hand-holding-usd me-2"></i>
                        Rapport Mensuel des Prêts
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-4">
                        <!-- Statistiques des prêts -->
                        <div class="col-12">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="card-title">Statistiques des prêts en cours</h6>
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <small class="text-muted">Total des prêts actifs</small>
                                            <div class="h5 mb-0">12</div>
                                        </div>
                                        <div class="col-md-4">
                                            <small class="text-muted">Montant total</small>
                                            <div class="h5 mb-0">5,000,000 FCFA</div>
                                        </div>
                                        <div class="col-md-4">
                                            <small class="text-muted">Taux moyen de remboursement</small>
                                            <div class="h5 mb-0">85%</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Graphique de remboursement -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">Taux de remboursement</h6>
                                    <canvas id="monthlyPretsRemboursementChart"></canvas>
                                </div>
                            </div>
                        </div>

                        <!-- Distribution -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">Distribution des prêts</h6>
                                    <canvas id="monthlyPretsDistributionChart"></canvas>
                                </div>
                            </div>
                        </div>

                        <!-- Historique des transactions -->
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">Historique des transactions récentes</h6>
                                    <div class="table-responsive">
                                        <table class="table table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Membre</th>
                                                    <th>Montant</th>
                                                    <th>Statut</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>2025-01-02</td>
                                                    <td>Jean Dupont</td>
                                                    <td>100,000 FCFA</td>
                                                    <td><span class="badge bg-success">Remboursé</span></td>
                                                </tr>
                                                <tr>
                                                    <td>2025-01-01</td>
                                                    <td>Marie Martin</td>
                                                    <td>150,000 FCFA</td>
                                                    <td><span class="badge bg-warning">En cours</span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="button" class="btn btn-primary" onclick="downloadReport('prets', 'monthly')">
                        <i class="fas fa-download me-2"></i>Télécharger en PDF
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/jspdf.umd.min.js"></script>
    <script src="js/html2canvas.min.js"></script>
    <script>
        // Fonction pour ouvrir les rapports mensuels
        function openMonthlyReport(type) {
            const modalId = `monthly${type.charAt(0).toUpperCase() + type.slice(1)}Modal`;
            const modal = new bootstrap.Modal(document.getElementById(modalId));
            
            // Initialiser les graphiques appropriés
            switch(type) {
                case 'epargnes':
                    initMonthlyEpargnesCharts();
                    break;
                case 'tontines':
                    initMonthlyTontinesCharts();
                    break;
                case 'prets':
                    initMonthlyPretsCharts();
                    break;
                case 'activites':
                    initMonthlyActivitesCharts();
                    break;
            }
            
            modal.show();
        }

        // Fonctions d'initialisation des graphiques
        function initMonthlyEpargnesCharts() {
            // Graphique d'évolution des épargnes
            const evolutionCtx = document.getElementById('monthlyEpargnesEvolutionChart').getContext('2d');
            new Chart(evolutionCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'],
                    datasets: [{
                        label: 'Épargnes Totales',
                        data: [500000, 750000, 1000000, 1250000, 1500000, 2000000],
                        borderColor: '#0d6efd',
                        tension: 0.1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Évolution des épargnes sur 6 mois'
                        }
                    }
                }
            });

            // Graphique de distribution des épargnes
            const distributionCtx = document.getElementById('monthlyEpargnesDistributionChart').getContext('2d');
            new Chart(distributionCtx, {
                type: 'pie',
                data: {
                    labels: ['Épargne Régulière', 'Épargne Projet', 'Épargne Éducation', 'Épargne Retraite'],
                    datasets: [{
                        data: [40, 30, 20, 10],
                        backgroundColor: [
                            '#0d6efd',
                            '#6610f2',
                            '#6f42c1',
                            '#d63384'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Distribution des types d\'épargne'
                        }
                    }
                }
            });
        }

        function initMonthlyPretsCharts() {
            // Graphique de distribution des prêts
            const distributionCtx = document.getElementById('monthlyPretsDistributionChart').getContext('2d');
            new Chart(distributionCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Prêts Commerciaux', 'Prêts Personnels', 'Prêts Éducation', 'Prêts Urgence'],
                    datasets: [{
                        data: [35, 25, 20, 20],
                        backgroundColor: [
                            '#198754',
                            '#0dcaf0',
                            '#ffc107',
                            '#dc3545'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Distribution des types de prêts'
                        }
                    }
                }
            });

            // Graphique de remboursement
            const remboursementCtx = document.getElementById('monthlyPretsRemboursementChart').getContext('2d');
            new Chart(remboursementCtx, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'],
                    datasets: [{
                        label: 'Taux de remboursement',
                        data: [95, 92, 88, 90, 85, 87],
                        backgroundColor: '#198754'
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Taux de remboursement mensuel (%)'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100
                        }
                    }
                }
            });
        }
    </script>
@endsection
