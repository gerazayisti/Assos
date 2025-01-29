<div class="modal fade" id="statsDetailsModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title">
                    <i class="fas fa-chart-bar me-2 text-primary"></i>
                    Statistiques Détaillées des Épargnes
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <!-- Résumé des épargnes -->
                <div class="row g-3 mb-4">
                    <div class="col-md-3">
                        <div class="card bg-primary text-white">
                            <div class="card-body text-center">
                                <h6 class="card-title">Total Épargnes</h6>
                                <h4 class="mb-0">{{ number_format($statsGlobales['totalEpargnes'], 0, ',', ' ') }} FCFA</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-success text-white">
                            <div class="card-body text-center">
                                <h6 class="card-title">Épargnes Actives</h6>
                                <h4 class="mb-0">{{ $statsGlobales['epargnesActives'] }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-info text-white">
                            <div class="card-body text-center">
                                <h6 class="card-title">Moyenne/Épargne</h6>
                                <h4 class="mb-0">{{ number_format($statsGlobales['moyenneEpargnes'], 0, ',', ' ') }} FCFA</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-warning text-white">
                            <div class="card-body text-center">
                                <h6 class="card-title">En Attente</h6>
                                <h4 class="mb-0">{{ $statsGlobales['epargnesEnAttente'] }}</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Détails des performances -->
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title mb-3">Performance des Épargnes</h6>
                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <tbody>
                                            <tr>
                                                <td>Taux de participation:</td>
                                                <td class="text-end"><strong>{{ $statsGlobales['tauxParticipation'] }}%</strong></td>
                                            </tr>
                                            <tr>
                                                <td>Objectif atteint:</td>
                                                <td class="text-end"><strong>{{ $statsGlobales['objectifAtteint'] }}%</strong></td>
                                            </tr>
                                            <tr>
                                                <td>Plus grande épargne:</td>
                                                <td class="text-end"><strong>{{ number_format($statsGlobales['maxEpargne'], 0, ',', ' ') }} FCFA</strong></td>
                                            </tr>
                                            <tr>
                                                <td>Plus petite épargne:</td>
                                                <td class="text-end"><strong>{{ number_format($statsGlobales['minEpargne'], 0, ',', ' ') }} FCFA</strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title mb-3">Répartition par Type</h6>
                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <tbody>
                                            <tr>
                                                <td>Épargne Annuelle:</td>
                                                <td class="text-end">
                                                    <strong>{{ number_format($epargneAnnuelle['total'], 0, ',', ' ') }} FCFA</strong>
                                                    <div class="progress mt-1" style="height: 5px;">
                                                        <div class="progress-bar bg-success" role="progressbar" 
                                                             style="width: {{ $epargneAnnuelle['progression'] }}%"></div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Épargne Scolaire:</td>
                                                <td class="text-end">
                                                    <strong>{{ number_format($epargneScolaire['total'], 0, ',', ' ') }} FCFA</strong>
                                                    <div class="progress mt-1" style="height: 5px;">
                                                        <div class="progress-bar bg-info" role="progressbar" 
                                                             style="width: {{ $epargneScolaire['progression'] }}%"></div>
                                                    </div>
                                                </td>
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
            </div>
        </div>
    </div>
</div>
