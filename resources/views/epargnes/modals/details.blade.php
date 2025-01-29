<div class="modal fade" id="detailsEpargneModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Détails de l'Épargne</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="fw-bold">Membre:</label>
                            <p id="detailMembre" class="mb-0"></p>
                        </div>
                        <div class="mb-3">
                            <label class="fw-bold">Type d'épargne:</label>
                            <p id="detailType" class="mb-0"></p>
                        </div>
                        <div class="mb-3">
                            <label class="fw-bold">Montant:</label>
                            <p id="detailMontant" class="mb-0"></p>
                        </div>
                        <div class="mb-3">
                            <label class="fw-bold">Date:</label>
                            <p id="detailDate" class="mb-0"></p>
                        </div>
                        <div class="mb-3">
                            <label class="fw-bold">Statut:</label>
                            <p id="detailStatut" class="mb-0"></p>
                        </div>
                    </div>
                </div>

                <div id="transactionsSection" class="d-none">
                    <h6 class="mb-3">Historique des Transactions</h6>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Type</th>
                                    <th>Montant</th>
                                </tr>
                            </thead>
                            <tbody id="transactionsTable">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
