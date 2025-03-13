<!-- Modal Éditer une Tontine -->
@foreach($tontines as $tontine)
<div class="modal fade" id="editTontineModal{{ $tontine->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifier la tontine: {{ $tontine->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('tontines.update', $tontine) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nom de la tontine</label>
                        <input type="text" name="name" class="form-control" value="{{ $tontine->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Type</label>
                        <select name="type" class="form-select" required>
                            <option value="petite" {{ $tontine->type == 'petite' ? 'selected' : '' }}>Petite Tontine</option>
                            <option value="grande" {{ $tontine->type == 'grande' ? 'selected' : '' }}>Grande Tontine</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Montant par personne (FCFA)</label>
                        <input type="number" name="amount_per_person" class="form-control" value="{{ $tontine->amount_per_person }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nombre total de participants</label>
                        <input type="number" name="total_participants" class="form-control" value="{{ $tontine->total_participants }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Date de début</label>
                        <input type="date" name="start_date" class="form-control" value="{{ $tontine->start_date }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Statut</label>
                        <select name="status" class="form-select" required>
                            <option value="en_cours" {{ $tontine->status == 'en_cours' ? 'selected' : '' }}>En cours</option>
                            <option value="terminee" {{ $tontine->status == 'terminee' ? 'selected' : '' }}>Terminée</option>
                            <option value="annulee" {{ $tontine->status == 'annulee' ? 'selected' : '' }}>Annulée</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description (optionnel)</label>
                        <textarea name="description" class="form-control" rows="3">{{ $tontine->description }}</textarea>
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
@endforeach
