<div class="modal fade" id="addEpargneModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nouvelle Épargne</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="createEpargneForm" method="POST" action="{{ route('epargnes.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="membre_id" class="form-label">Membre</label>
                        <select class="form-select" id="membre_id" name="membre_id" required>
                            <option value="">Sélectionner un membre</option>
                            @foreach($membres as $membre)
                                <option value="{{ $membre->id_membre }}">{{ $membre->nom }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label">Type d'épargne</label>
                        <select class="form-select" id="type" name="type" required>
                            <option value="">Sélectionner un type</option>
                            <option value="Régulière">Annuelle</option>
                            <option value="Projet">Scolaire</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="montant" class="form-label">Montant (FCFA)</label>
                        <input type="number" class="form-control" id="montant" name="montant" required min="0">
                    </div>

                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Set default date to today
    document.addEventListener('DOMContentLoaded', function() {
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('date').value = today;
    });
</script>
@endpush
