<!-- Modal Ajouter une Contribution -->
<div class="modal fade" id="addContributionModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter une contribution à la tontine</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('tontines.add-contribution', $tontine) }}" method="POST">
                @csrf
                <div class="modal-body">
                    @if($tontine->participants->isEmpty())
                        <div class="alert alert-warning">
                            <strong>Attention !</strong> Aucun participant n'est disponible pour cette tontine.
                        </div>
                    @else
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="membre_id" class="form-label">Participant</label>
                                <select name="membre_id" class="form-select" required>
                                    <option value="">Sélectionner un participant</option>
                                    @foreach($tontine->participants as $participant)
                                        <option value="{{ $participant->id_membre }}">
                                            {{ $participant->nom }} {{ $participant->prenom }} 
                                            ({{ $participant->numero_membre }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="amount" class="form-label">Montant de la contribution</label>
                                <input type="number" name="amount" class="form-control" 
                                       min="0" step="0.01" required 
                                       placeholder="Montant de la contribution">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="contribution_date" class="form-label">Date de contribution</label>
                                <input type="date" name="contribution_date" class="form-control" 
                                       required value="{{ now()->format('Y-m-d') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="description" class="form-label">Description (optionnel)</label>
                                <textarea name="description" class="form-control" 
                                          placeholder="Description de la contribution"></textarea>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary" 
                            {{ $tontine->participants->isEmpty() ? 'disabled' : '' }}>
                        Ajouter la contribution
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
