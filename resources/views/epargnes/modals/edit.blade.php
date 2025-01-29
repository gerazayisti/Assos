<div class="modal fade" id="editEpargneModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifier l'Épargne</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editEpargneForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_membre_id" class="form-label">Membre</label>
                        <select class="form-select" id="edit_membre_id" name="membre_id" required>
                            <option value="">Sélectionner un membre</option>
                            @foreach($membres as $membre)
                                <option value="{{ $membre->id_membre }}">{{ $membre->nom }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="edit_type" class="form-label">Type d'épargne</label>
                        <select class="form-select" id="edit_type" name="type" required>
                            <option value="">Sélectionner un type</option>
                            <option value="Régulière">Régulière</option>
                            <option value="Projet">Projet</option>
                            <option value="Retraite">Retraite</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="edit_montant" class="form-label">Montant (FCFA)</label>
                        <input type="number" class="form-control" id="edit_montant" name="montant" required min="0">
                    </div>

                    <div class="mb-3">
                        <label for="edit_date" class="form-label">Date</label>
                        <input type="date" class="form-control" id="edit_date" name="date" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_statut" class="form-label">Statut</label>
                        <select class="form-select" id="edit_statut" name="statut" required>
                            <option value="actif">Actif</option>
                            <option value="en_attente">En attente</option>
                            <option value="termine">Terminé</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="edit_objectif" class="form-label">Objectif (FCFA)</label>
                        <input type="number" class="form-control" id="edit_objectif" name="objectif" min="0">
                    </div>

                    <div class="mb-3">
                        <label for="edit_description" class="form-label">Description</label>
                        <textarea class="form-control" id="edit_description" name="description" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                </div>
            </form>
        </div>
    </div>
</div>
