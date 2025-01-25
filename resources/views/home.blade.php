@extends('layouts.app')

@section('title', 'Accueil')

@section('content')
        <div class="row">
            <!-- Welcome Section -->
            <div class="col-md-8 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title">Bienvenue sur l'application de gestion </br></br></h2>
                    
                        <p class="card-text">
                            Gérez efficacement les activités de votre Association et bien d'autre.
                            Cette plateforme vous permet de suivre les tontines, épargnes et autres activités
                            de manière centralisée et sécurisée.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title h5">Statistiques rapides</h3>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <i class="fas fa-users text-primary me-2"></i>
                                Membres actifs: <span class="fw-bold">45</span>
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-money-bill-wave text-success me-2"></i>
                                Tontines en cours: <span class="fw-bold">3</span>
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-piggy-bank text-info me-2"></i>
                                Total épargnes: <span class="fw-bold">2.5M FCFA</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="col-12 mb-4">
                <div class="row g-4">
                    <div class="col-md-3">
                        <div class="card shadow-sm text-center">
                            <div class="card-body">
                                <i class="fas fa-user-plus fa-2x text-primary mb-3"></i>
                                <h4 class="h6">Nouveau Membre</h4>
                                <a href="membres.html" class="btn btn-sm btn-primary">Ajouter</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card shadow-sm text-center">
                            <div class="card-body">
                                <i class="fas fa-hand-holding-usd fa-2x text-success mb-3"></i>
                                <h4 class="h6">Nouvelle Tontine</h4>
                                <a href="tontines.html" class="btn btn-sm btn-success">Créer</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card shadow-sm text-center">
                            <div class="card-body">
                                <i class="fas fa-piggy-bank fa-2x text-info mb-3"></i>
                                <h4 class="h6">Nouvelle Épargne</h4>
                                <a href="epargnes.html" class="btn btn-sm btn-info text-white">Enregistrer</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card shadow-sm text-center">
                            <div class="card-body">
                                <i class="fas fa-file-alt fa-2x text-warning mb-3"></i>
                                <h4 class="h6">Générer Rapport</h4>
                                <a href="rapports.html" class="btn btn-sm btn-warning">Générer</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection