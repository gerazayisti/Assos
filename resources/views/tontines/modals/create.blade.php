<!-- Modal Créer une Tontine -->
<div class="modal fade" id="addTontineModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Créer une nouvelle tontine</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('tontines.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nom de la tontine</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Type</label>
                        <select name="type" class="form-select" required>
                            <option value="">Sélectionner un type</option>
                            <option value="petite">Petite Tontine</option>
                            <option value="grande">Grande Tontine</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Montant par personne (FCFA)</label>
                        <input type="number" name="amount_per_person" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nombre total de participants</label>
                        <input type="number" name="total_participants" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Date de début</label>
                        <input type="date" name="start_date" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description (optionnel)</label>
                        <textarea name="description" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Créer la tontine</button>
                </div>
            </form>
        </div>
    </div>
</div>
