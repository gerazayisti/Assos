<!-- Modal Ajouter un Participant -->
<div class="modal fade" id="addParticipantModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter un participant à la tontine</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('tontines.add-participant', $tontine) }}" method="POST">
                @csrf
                <div class="modal-body">
                    @if($availableMembers->isEmpty())
                        <div class="alert alert-warning">
                            <strong>Attention !</strong> Aucun membre supplémentaire n'est disponible pour cette tontine.
                            <br>Soit tous les membres sont déjà participants, soit il n'y a pas de membres dans la base de données.
                        </div>
                    @else
                        <div class="alert alert-info">
                            <strong>{{ $availableMembers->count() }} membre(s) disponible(s)</strong>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Sélection</th>
                                        <th>Numéro Membre</th>
                                        <th>Nom</th>
                                        <th>Prénom</th>
                                        <th>Téléphone</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($availableMembers as $membre)
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="membre_id" 
                                                       value="{{ $membre->id_membre }}" 
                                                       id="membre{{ $membre->id_membre }}" required>
                                                <label class="form-check-label" for="membre{{ $membre->id_membre }}"></label>
                                            </div>
                                        </td>
                                        <td>{{ $membre->numero_membre }}</td>
                                        <td>{{ $membre->nom }}</td>
                                        <td>{{ $membre->prenom }}</td>
                                        <td>{{ $membre->telephone }}</td>
                                        <td>{{ $membre->email }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary" {{ $availableMembers->isEmpty() ? 'disabled' : '' }}>
                        Ajouter le participant
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
