@extends('layouts.app')

@section('title', 'Accueil')

@section('content')
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h2">Paramètres</h1>
        </div>

        <!-- Settings Sections -->
        <div class="row">
            <!-- Navigation des paramètres -->
            <div class="col-md-3 mb-4">
                <div class="list-group">
                    <a href="#general" class="list-group-item list-group-item-action active" data-bs-toggle="list">
                        <i class="fas fa-cog me-2"></i>Général
                    </a>
                    <a href="#association" class="list-group-item list-group-item-action" data-bs-toggle="list">
                        <i class="fas fa-building me-2"></i>Association
                    </a>
                    <a href="#notifications" class="list-group-item list-group-item-action" data-bs-toggle="list">
                        <i class="fas fa-bell me-2"></i>Notifications
                    </a>
                    <a href="#financier" class="list-group-item list-group-item-action" data-bs-toggle="list">
                        <i class="fas fa-money-bill me-2"></i>Paramètres financiers
                    </a>
                    <a href="#securite" class="list-group-item list-group-item-action" data-bs-toggle="list">
                        <i class="fas fa-shield-alt me-2"></i>Sécurité
                    </a>
                    <a href="#systeme" class="list-group-item list-group-item-action" data-bs-toggle="list">
                        <i class="fas fa-desktop me-2"></i>Système
                    </a>
                </div>
            </div>

            <!-- Contenu des paramètres -->
            <div class="col-md-9">
                <div class="tab-content">
                    <!-- Paramètres généraux -->
                    <div class="tab-pane fade show active" id="general">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Paramètres généraux</h5>
                                <form>
                                    <div class="mb-3">
                                        <label class="form-label">Logo de l'association</label>
                                        <div class="d-flex align-items-center">
                                            <img src="images/default-logo.png" alt="Logo actuel" class="me-3" style="width: 60px; height: 60px;">
                                            <div>
                                                <input type="file" class="form-control" accept="image/*">
                                                <small class="text-muted">Format recommandé : PNG, JPG (max 2MB)</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Nom de l'association</label>
                                        <input type="text" class="form-control" value="Famille Megué">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Langue</label>
                                        <select class="form-select">
                                            <option value="fr">Français</option>
                                            <option value="en">English</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Fuseau horaire</label>
                                        <select class="form-select">
                                            <option value="UTC+1">UTC+01:00 (Paris, Douala)</option>
                                            <option value="UTC+0">UTC+00:00 (Londres)</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Paramètres de l'association -->
                    <div class="tab-pane fade" id="association">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Informations de l'association</h5>
                                <form>
                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control" rows="3"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Adresse</label>
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Email de contact</label>
                                        <input type="email" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Téléphone</label>
                                        <input type="tel" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Date de création</label>
                                        <input type="date" class="form-control">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Paramètres des notifications -->
                    <div class="tab-pane fade" id="notifications">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Préférences de notification</h5>
                                <form>
                                    <div class="mb-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="emailNotif" checked>
                                            <label class="form-check-label" for="emailNotif">Notifications par email</label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="smsNotif">
                                            <label class="form-check-label" for="smsNotif">Notifications par SMS</label>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Types de notifications</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="notifReunion" checked>
                                            <label class="form-check-label" for="notifReunion">Réunions</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="notifCotisation" checked>
                                            <label class="form-check-label" for="notifCotisation">Cotisations</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="notifPret" checked>
                                            <label class="form-check-label" for="notifPret">Prêts</label>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Paramètres financiers -->
                    <div class="tab-pane fade" id="financier">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Configuration financière</h5>
                                <form>
                                    <div class="mb-3">
                                        <label class="form-label">Devise</label>
                                        <select class="form-select">
                                            <option value="XAF">FCFA (XAF)</option>
                                            <option value="EUR">Euro (EUR)</option>
                                            <option value="USD">Dollar US (USD)</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Taux d'intérêt par défaut (%)</label>
                                        <input type="number" class="form-control" value="5">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Durée maximale des prêts (mois)</label>
                                        <input type="number" class="form-control" value="12">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Montant minimal d'épargne</label>
                                        <input type="number" class="form-control" value="1000">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Paramètres de sécurité -->
                    <div class="tab-pane fade" id="securite">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Sécurité et authentification</h5>
                                <form>
                                    <div class="mb-3">
                                        <label class="form-label">Mot de passe actuel</label>
                                        <input type="password" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Nouveau mot de passe</label>
                                        <input type="password" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Confirmer le mot de passe</label>
                                        <input type="password" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="2fa">
                                            <label class="form-check-label" for="2fa">Activer l'authentification à deux facteurs</label>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Paramètres système -->
                    <div class="tab-pane fade" id="systeme">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Configuration système</h5>
                                <div class="mb-4">
                                    <h6>Informations système</h6>
                                    <p class="mb-1"><strong>Version :</strong> 1.0.0</p>
                                    <p class="mb-1"><strong>Dernière mise à jour :</strong> 04/01/2025</p>
                                    <p class="mb-3"><strong>Espace disque utilisé :</strong> 150 MB</p>
                                </div>
                                <div class="mb-4">
                                    <h6>Maintenance</h6>
                                    <button class="btn btn-secondary me-2">
                                        <i class="fas fa-sync-alt me-2"></i>Vérifier les mises à jour
                                    </button>
                                    <button class="btn btn-warning">
                                        <i class="fas fa-database me-2"></i>Sauvegarder les données
                                    </button>
                                </div>
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="debug">
                                        <label class="form-check-label" for="debug">Mode débogage</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Boutons d'action -->
                <div class="mt-4 d-flex justify-content-end">
                    <button type="button" class="btn btn-secondary me-2">Annuler</button>
                    <button type="button" class="btn btn-primary">Enregistrer les modifications</button>
                </div>
            </div>
        </div>
    </main>

    <!-- Scripts -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/settings.js"></script>
    <script>
        // Prévisualisation du logo
        function previewLogo(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('logoPreview').src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Réinitialiser le formulaire
        function resetForm() {
            document.getElementById('settingsForm').reset();
            document.getElementById('logoPreview').src = 'images/default-logo.png';
        }

        // Gestion du formulaire
        document.getElementById('settingsForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Sauvegarder dans le localStorage
            const name = document.getElementById('associationName').value;
            const logo = document.getElementById('logoPreview').src;
            
            localStorage.setItem('associationName', name);
            localStorage.setItem('associationLogo', logo);
            
            // Mettre à jour l'interface
            document.querySelectorAll('.nav-header .app-name').forEach(el => {
                el.textContent = name;
            });
            document.querySelectorAll('.nav-header .app-logo').forEach(el => {
                el.src = logo;
            });
            
            // Afficher un message de succès
            alert('Les paramètres ont été enregistrés avec succès !');
        });

        // Charger les paramètres sauvegardés
        window.addEventListener('load', function() {
            const savedName = localStorage.getItem('associationName');
            const savedLogo = localStorage.getItem('associationLogo');
            
            if (savedName) {
                document.getElementById('associationName').value = savedName;
            }
            if (savedLogo) {
                document.getElementById('logoPreview').src = savedLogo;
            }
        });
    </script>
@endsection
