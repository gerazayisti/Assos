@extends('layouts.app')

@section('title', 'Accueil')

@section('content')
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Gestion des Prêts</h2>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPretModal">
                <i class="fas fa-plus me-2"></i>Nouveau Prêt
            </button>
        </div>

        <!-- Prêts Overview -->
        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Prêts en cours</h5>
                        <div class="mt-3">
                            <p class="mb-2">Nombre de prêts: <strong>12</strong></p>
                            <p class="mb-2">Montant total: <strong>3,500,000 FCFA</strong></p>
                            <p class="mb-2">Taux moyen: <strong>5%</strong></p>
                            <div class="progress mt-3">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 65%">65% remboursés</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Remboursements</h5>
                        <div class="mt-3">
                            <p class="mb-2">À rembourser ce mois: <strong>500,000 FCFA</strong></p>
                            <p class="mb-2">Déjà remboursé: <strong>300,000 FCFA</strong></p>
                            <p class="mb-2">Retards: <strong>2 prêts</strong></p>
                            <div class="progress mt-3">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 60%">60%</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Intérêts générés</h5>
                        <div class="mt-3">
                            <p class="mb-2">Ce mois: <strong>75,000 FCFA</strong></p>
                            <p class="mb-2">Cette année: <strong>450,000 FCFA</strong></p>
                            <p class="mb-2">Projection annuelle: <strong>900,000 FCFA</strong></p>
                            <button class="btn btn-outline-primary w-100 mt-3" onclick="openStatsDetails()">Voir les détails</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Prêts Table -->
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="card-title">Liste des Prêts</h5>
                    <div class="d-flex gap-2">
                        <select class="form-select form-select-sm" style="width: 150px;">
                            <option value="all">Tous les statuts</option>
                            <option value="en_cours">En cours</option>
                            <option value="rembourse">Remboursé</option>
                            <option value="retard">En retard</option>
                        </select>
                        <input type="month" class="form-control form-control-sm" style="width: 150px;">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Membre</th>
                                <th>Montant</th>
                                <th>Taux</th>
                                <th>Date début</th>
                                <th>Échéance</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>John Doe</td>
                                <td>250,000 FCFA</td>
                                <td>5%</td>
                                <td>01/01/2024</td>
                                <td>01/07/2024</td>
                                <td><span class="badge bg-warning">En cours</span></td>
                                <td>
                                    <button class="btn btn-sm btn-info me-1" title="Détails" onclick="openPretDetails(1)">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-success me-1" title="Remboursement" onclick="openRemboursementModal(1)">
                                        <i class="fas fa-money-bill-wave"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" title="Annuler">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <nav class="mt-4">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Précédent</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Suivant</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </main>

    <!-- Add Prêt Modal -->
    <div class="modal fade" id="addPretModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Enregistrer un nouveau prêt</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Membre</label>
                            <select class="form-select" required>
                                <option value="">Sélectionner un membre</option>
                                <option value="1">John Doe</option>
                                <option value="2">Jane Smith</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Montant</label>
                            <input type="number" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Taux d'intérêt (%)</label>
                            <input type="number" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Date de début</label>
                            <input type="date" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Date d'échéance</label>
                            <input type="date" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Motif du prêt</label>
                            <textarea class="form-control" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary">Enregistrer</button>
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
                        Statistiques Détaillées des Prêts
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <!-- Résumé des prêts -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-3">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <h6 class="card-title">Prêts Actifs</h6>
                                    <h2 class="mb-0">12</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <h6 class="card-title">Montant Total</h6>
                                    <h2 class="mb-0">3.5M</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-info text-white">
                                <div class="card-body">
                                    <h6 class="card-title">Intérêts</h6>
                                    <h2 class="mb-0">450K</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-warning text-white">
                                <div class="card-body">
                                    <h6 class="card-title">Taux Moyen</h6>
                                    <h2 class="mb-0">5%</h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Graphiques détaillés -->
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">Évolution des Prêts</h6>
                                    <canvas id="loansProgressChart" height="200"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">Statut des Remboursements</h6>
                                    <canvas id="repaymentStatusChart" height="200"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tableau des performances -->
                    <div class="card mt-4">
                        <div class="card-body">
                            <h6 class="card-title">Performance des Remboursements</h6>
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>Période</th>
                                            <th>Prêts Accordés</th>
                                            <th>Montant Total</th>
                                            <th>Taux de Remboursement</th>
                                            <th>Tendance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Ce mois</td>
                                            <td>5</td>
                                            <td>1,500,000 FCFA</td>
                                            <td>95%</td>
                                            <td><i class="fas fa-arrow-up text-success"></i></td>
                                        </tr>
                                        <tr>
                                            <td>Dernier mois</td>
                                            <td>8</td>
                                            <td>2,000,000 FCFA</td>
                                            <td>85%</td>
                                            <td><i class="fas fa-arrow-right text-warning"></i></td>
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

    <!-- Modal Détails Prêt -->
    <div class="modal fade" id="pretDetailsModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title">
                        <i class="fas fa-money-bill-wave me-2 text-primary"></i>
                        Détails du Prêt
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
                                        <small class="text-muted">Membre</small>
                                        <div id="memberName" class="fw-bold">John Doe</div>
                                    </div>
                                    <div class="mb-2">
                                        <small class="text-muted">Date de début</small>
                                        <div id="startDate" class="fw-bold">01/01/2024</div>
                                    </div>
                                    <div class="mb-2">
                                        <small class="text-muted">Date d'échéance</small>
                                        <div id="endDate" class="fw-bold">01/07/2024</div>
                                    </div>
                                    <div class="mb-2">
                                        <small class="text-muted">Statut</small>
                                        <div><span id="loanStatus" class="badge bg-warning">En cours</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="card-title mb-3">Détails Financiers</h6>
                                    <div class="mb-2">
                                        <small class="text-muted">Montant emprunté</small>
                                        <div id="loanAmount" class="fw-bold">250,000 FCFA</div>
                                    </div>
                                    <div class="mb-2">
                                        <small class="text-muted">Taux d'intérêt</small>
                                        <div id="interestRate" class="fw-bold">5%</div>
                                    </div>
                                    <div class="mb-2">
                                        <small class="text-muted">Montant à rembourser</small>
                                        <div id="totalToRepay" class="fw-bold">262,500 FCFA</div>
                                    </div>
                                    <div class="mb-2">
                                        <small class="text-muted">Déjà remboursé</small>
                                        <div id="amountRepaid" class="fw-bold">100,000 FCFA</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Historique des remboursements -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <h6 class="card-title mb-3">Historique des Remboursements</h6>
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Montant</th>
                                            <th>Mode</th>
                                            <th>Référence</th>
                                            <th>Statut</th>
                                        </tr>
                                    </thead>
                                    <tbody id="repaymentsList">
                                        <tr>
                                            <td>15/01/2024</td>
                                            <td>50,000 FCFA</td>
                                            <td>Mobile Money</td>
                                            <td>REF123456</td>
                                            <td><span class="badge bg-success">Validé</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Graphique de progression -->
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title mb-3">Progression du Remboursement</h6>
                            <canvas id="repaymentProgressChart" height="200"></canvas>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="button" class="btn btn-success me-2" onclick="exportPretDetails()">
                        <i class="fas fa-file-excel me-2"></i>Exporter
                    </button>
                    <button type="button" class="btn btn-primary" onclick="printPretDetails()">
                        <i class="fas fa-print me-2"></i>Imprimer
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Remboursement -->
    <div class="modal fade" id="remboursementModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-money-bill-wave me-2"></i>
                        Effectuer un Remboursement
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-4">
                        <h6 class="mb-3">Résumé du Prêt</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="border rounded p-2">
                                    <small class="text-muted d-block">Membre</small>
                                    <strong id="remb-memberName">John Doe</strong>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="border rounded p-2">
                                    <small class="text-muted d-block">Montant restant</small>
                                    <strong id="remb-remainingAmount">162,500 FCFA</strong>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="border rounded p-2">
                                    <small class="text-muted d-block">Prochaine échéance</small>
                                    <strong id="remb-nextDueDate">15/01/2024</strong>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="border rounded p-2">
                                    <small class="text-muted d-block">Montant attendu</small>
                                    <strong id="remb-expectedAmount">50,000 FCFA</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form id="remboursementForm" class="needs-validation" novalidate>
                        <div class="mb-3">
                            <label class="form-label">Montant du remboursement</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="remboursementAmount" required
                                    min="1000" step="500">
                                <span class="input-group-text">FCFA</span>
                            </div>
                            <div class="invalid-feedback">
                                Veuillez entrer un montant valide
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Date du remboursement</label>
                            <input type="date" class="form-control" id="remboursementDate" required>
                            <div class="invalid-feedback">
                                Veuillez sélectionner une date
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mode de paiement</label>
                            <select class="form-select" id="remboursementMode" required>
                                <option value="">Choisir un mode de paiement</option>
                                <option value="especes">Espèces</option>
                                <option value="mobile_money">Mobile Money</option>
                                <option value="virement">Virement bancaire</option>
                                <option value="cheque">Chèque</option>
                            </select>
                            <div class="invalid-feedback">
                                Veuillez sélectionner un mode de paiement
                            </div>
                        </div>

                        <div id="referenceContainer" class="mb-3 d-none">
                            <label class="form-label">Référence du paiement</label>
                            <input type="text" class="form-control" id="remboursementReference">
                            <div class="invalid-feedback">
                                Veuillez entrer la référence du paiement
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Commentaire (optionnel)</label>
                            <textarea class="form-control" id="remboursementComment" rows="2"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-success" onclick="submitRemboursement()">
                        <i class="fas fa-check me-2"></i>Valider le remboursement
                    </button>
                </div>
            </div>
        </div>
    </div>


    <!-- Scripts -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    // Fonction pour ouvrir les détails des statistiques
    function openStatsDetails() {
        // Initialiser les graphiques
        initLoansProgressChart();
        initRepaymentStatusChart();
        
        // Afficher le modal
        const modal = new bootstrap.Modal(document.getElementById('statsDetailsModal'));
        modal.show();
    }

    // Fonction pour ouvrir les détails d'un prêt
    function openPretDetails(pretId) {
        // Charger les données du prêt
        loadPretData(pretId);
        
        // Initialiser le graphique de progression
        initRepaymentProgressChart();
        
        // Afficher le modal
        const modal = new bootstrap.Modal(document.getElementById('pretDetailsModal'));
        modal.show();
    }

    // Fonction pour ouvrir le modal de remboursement
    function openRemboursementModal(pretId) {
        // Charger les données du prêt
        loadRemboursementData(pretId);
        
        // Afficher le modal
        const modal = new bootstrap.Modal(document.getElementById('remboursementModal'));
        modal.show();

        // Réinitialiser le formulaire
        document.getElementById('remboursementForm').reset();
        
        // Mettre la date du jour par défaut
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('remboursementDate').value = today;
    }

    // Initialisation du graphique d'évolution des prêts
    function initLoansProgressChart() {
        const ctx = document.getElementById('loansProgressChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun'],
                datasets: [{
                    label: 'Montant Total des Prêts',
                    data: [1000000, 1500000, 2000000, 2500000, 3000000, 3500000],
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

    // Initialisation du graphique de statut des remboursements
    function initRepaymentStatusChart() {
        const ctx = document.getElementById('repaymentStatusChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['À jour', 'En retard', 'Remboursés'],
                datasets: [{
                    data: [8, 2, 5],
                    backgroundColor: [
                        'rgb(75, 192, 192)',
                        'rgb(255, 99, 132)',
                        'rgb(255, 205, 86)'
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

    // Initialisation du graphique de progression du remboursement
    function initRepaymentProgressChart() {
        const ctx = document.getElementById('repaymentProgressChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Total à rembourser', 'Déjà remboursé'],
                datasets: [{
                    label: 'Progression',
                    data: [262500, 100000],
                    backgroundColor: [
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderColor: [
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)'
                    ],
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

    // Fonction pour charger les données d'un prêt
    function loadPretData(pretId) {
        // Simuler le chargement des données
        // Dans un cas réel, vous feriez un appel API
        const data = {
            member: 'John Doe',
            startDate: '01/01/2024',
            endDate: '01/07/2024',
            status: 'En cours',
            amount: '250,000 FCFA',
            interestRate: '5%',
            totalToRepay: '262,500 FCFA',
            amountRepaid: '100,000 FCFA'
        };

        // Mettre à jour les éléments du DOM
        document.getElementById('memberName').textContent = data.member;
        document.getElementById('startDate').textContent = data.startDate;
        document.getElementById('endDate').textContent = data.endDate;
        document.getElementById('loanStatus').textContent = data.status;
        document.getElementById('loanAmount').textContent = data.amount;
        document.getElementById('interestRate').textContent = data.interestRate;
        document.getElementById('totalToRepay').textContent = data.totalToRepay;
        document.getElementById('amountRepaid').textContent = data.amountRepaid;
    }

    // Fonction pour charger les données du remboursement
    function loadRemboursementData(pretId) {
        // Simuler le chargement des données
        // Dans un cas réel, vous feriez un appel API
        const data = {
            member: 'John Doe',
            remainingAmount: '162,500 FCFA',
            nextDueDate: '15/01/2024',
            expectedAmount: '50,000 FCFA'
        };

        // Mettre à jour les éléments du DOM
        document.getElementById('remb-memberName').textContent = data.member;
        document.getElementById('remb-remainingAmount').textContent = data.remainingAmount;
        document.getElementById('remb-nextDueDate').textContent = data.nextDueDate;
        document.getElementById('remb-expectedAmount').textContent = data.expectedAmount;
    }

    // Gérer l'affichage du champ de référence selon le mode de paiement
    document.getElementById('remboursementMode').addEventListener('change', function() {
        const referenceContainer = document.getElementById('referenceContainer');
        const referenceInput = document.getElementById('remboursementReference');
        
        if (this.value === 'especes') {
            referenceContainer.classList.add('d-none');
            referenceInput.removeAttribute('required');
        } else {
            referenceContainer.classList.remove('d-none');
            referenceInput.setAttribute('required', 'required');
        }
    });

    // Fonction pour soumettre le remboursement
    function submitRemboursement() {
        const form = document.getElementById('remboursementForm');
        
        if (!form.checkValidity()) {
            form.classList.add('was-validated');
            return;
        }

        // Récupérer les données du formulaire
        const formData = {
            amount: document.getElementById('remboursementAmount').value,
            date: document.getElementById('remboursementDate').value,
            mode: document.getElementById('remboursementMode').value,
            reference: document.getElementById('remboursementReference').value,
            comment: document.getElementById('remboursementComment').value
        };

        // Simuler l'envoi des données
        // Dans un cas réel, vous feriez un appel API
        console.log('Données du remboursement:', formData);
        
        // Fermer le modal et afficher un message de succès
        const modal = bootstrap.Modal.getInstance(document.getElementById('remboursementModal'));
        modal.hide();
        
        // Afficher une notification de succès
        alert('Remboursement enregistré avec succès !');
        
        // Recharger les données du prêt
        // Dans un cas réel, vous rechargeriez les données depuis l'API
        location.reload();
    }

    // Fonction pour exporter les statistiques
    function exportStatsToExcel() {
        // Implémenter l'export Excel
        alert('Export des statistiques en cours...');
    }

    // Fonction pour exporter les détails d'un prêt
    function exportPretDetails() {
        // Implémenter l'export Excel
        alert('Export des détails en cours...');
    }

    // Fonction pour imprimer les détails
    function printPretDetails() {
        window.print();
    }
    </script>
@endsection
