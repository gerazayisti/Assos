@extends('layouts.app')

@section('title', 'Accueil')

@section('content')
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Gestion des Activités</h2>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addActivityModal">
                <i class="fas fa-plus me-2"></i>Nouvelle Activité
            </button>
        </div>

        <!-- Calendar View -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title">Calendrier des Activités</h5>
                    <div class="btn-group">
                        <button class="btn btn-outline-primary">Mois</button>
                        <button class="btn btn-outline-primary active">Semaine</button>
                        <button class="btn btn-outline-primary">Jour</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Lundi</th>
                                <th>Mardi</th>
                                <th>Mercredi</th>
                                <th>Jeudi</th>
                                <th>Vendredi</th>
                                <th>Samedi</th>
                                <th>Dimanche</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="height: 100px;">
                                <td class="position-relative">
                                    <div class="event bg-primary text-white p-1 rounded mb-1">
                                        Réunion mensuelle
                                    </div>
                                </td>
                                <td></td>
                                <td>
                                    <div class="event bg-success text-white p-1 rounded mb-1">
                                        Séance d'épargne
                                    </div>
                                </td>
                                <td></td>
                                <td></td>
                                <td>
                                    <div class="event bg-info text-white p-1 rounded mb-1">
                                        Formation
                                    </div>
                                </td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Activities List -->
        <div class="row g-4">
            <!-- Upcoming Activities -->
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Activités à venir</h5>
                        <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">Réunion mensuelle</h6>
                                    <small class="text-muted">Dans 3 jours</small>
                                </div>
                                <p class="mb-1">Réunion générale des membres</p>
                                <small class="text-muted">15 participants confirmés</small>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">Formation gestion financière</h6>
                                    <small class="text-muted">Dans 1 semaine</small>
                                </div>
                                <p class="mb-1">Formation sur la gestion des épargnes</p>
                                <small class="text-muted">8 participants confirmés</small>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activities -->
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Activités récentes</h5>
                        <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">Séance d'épargne</h6>
                                    <small class="text-muted">Il y a 2 jours</small>
                                </div>
                                <p class="mb-1">Collecte des épargnes mensuelles</p>
                                <small class="text-muted">20 participants présents</small>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">Événement social</h6>
                                    <small class="text-muted">Il y a 1 semaine</small>
                                </div>
                                <p class="mb-1">Célébration d'anniversaire</p>
                                <small class="text-muted">25 participants présents</small>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Add Activity Modal -->
    <div class="modal fade" id="addActivityModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter une nouvelle activité</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Titre de l'activité</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Type d'activité</label>
                            <select class="form-select" required>
                                <option value="">Sélectionner un type</option>
                                <option value="reunion">Réunion</option>
                                <option value="formation">Formation</option>
                                <option value="social">Événement social</option>
                                <option value="epargne">Séance d'épargne</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Date</label>
                            <input type="date" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Heure</label>
                            <input type="time" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Lieu</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Budget estimé</label>
                            <input type="number" class="form-control">
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
    @endsection