@extends('layouts.app')

@section('title', 'Accueil')

@section('content')
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Gestion des Membres</h2>
            <div class="d-flex gap-2 align-items-center">
                <span class="badge bg-info">Connecté en tant que Président</span>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMemberModal">
                    <i class="fas fa-plus me-2"></i>Nouveau Membre
                </button>
            </div>
        </div>

        <!-- Search and Filter Section -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3">
                        <input type="text" class="form-control" placeholder="Rechercher un membre...">
                    </div>
                    <div class="col-md-2">
                        <select class="form-select">
                            <option value="">Statut</option>
                            <option value="actif">Actif</option>
                            <option value="inactif">Inactif</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select">
                            <option value="">Rôle dans l'association</option>
                            <option value="president">Président</option>
                            <option value="secretaire">Secrétaire</option>
                            <option value="comptable">Comptable</option>
                            <option value="membre">Membre</option>
                            <option value="autre">Autre</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select class="form-select">
                            <option value="">Trier par</option>
                            <option value="nom">Nom</option>
                            <option value="date">Date d'inscription</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-secondary w-100">Filtrer</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Members List -->
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>CNI</th>
                                <th>Profession</th>
                                <th>Rôle</th>
                                <th>Date d'inscription</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Doe</td>
                                <td>John</td>
                                <td>123456789</td>
                                <td>Enseignant</td>
                                <td><span class="badge bg-primary">Président</span></td>
                                <td>01/01/2024</td>
                                <td><span class="badge bg-success">Actif</span></td>
                                <td>
                                    <button class="btn btn-sm btn-info me-1" title="Voir détails" data-member-id="1">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-warning me-1" title="Modifier le rôle">
                                        <i class="fas fa-user-tag"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" title="Désactiver">
                                        <i class="fas fa-user-times"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Smith</td>
                                <td>Jane</td>
                                <td>987654321</td>
                                <td>Médecin</td>
                                <td><span class="badge bg-info">Secrétaire</span></td>
                                <td>01/01/2024</td>
                                <td><span class="badge bg-success">Actif</span></td>
                                <td>
                                    <button class="btn btn-sm btn-info me-1" title="Voir détails" data-member-id="2">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-warning me-1" title="Modifier le rôle">
                                        <i class="fas fa-user-tag"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" title="Désactiver">
                                        <i class="fas fa-user-times"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <nav class="mt-4">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Précédent</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Suivant</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </main>

    <!-- Add Member Modal -->
    <div class="modal fade" id="addMemberModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter un nouveau membre</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="addMemberForm">
                        <div class="mb-3">
                            <label class="form-label">Nom</label>
                            <input type="text" class="form-control" name="nom" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Prénom</label>
                            <input type="text" class="form-control" name="prenom" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Numéro CNI</label>
                            <input type="text" class="form-control" name="numero_cni" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Date de naissance</label>
                            <input type="date" class="form-control" name="date_naissance" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Lieu de naissance</label>
                            <input type="text" class="form-control" name="lieu_naissance" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sexe</label>
                            <select class="form-select" name="sexe" required>
                                <option value="">Sélectionner</option>
                                <option value="M">Masculin</option>
                                <option value="F">Féminin</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Profession</label>
                            <input type="text" class="form-control" name="profession" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Rôle dans l'association</label>
                            <select class="form-select" name="role" required>
                                <option value="">Sélectionner un rôle</option>
                                <option value="president">Président</option>
                                <option value="secretaire">Secrétaire</option>
                                <option value="tresorier">Trésorier</option>
                                <option value="membre">Membre</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Montant d'adhésion</label>
                            <input type="number" class="form-control" name="montant_adhesion" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Téléphone</label>
                            <input type="tel" class="form-control" name="telephone" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Adresse</label>
                            <textarea class="form-control" name="adresse" rows="2"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Photo</label>
                            <input type="file" class="form-control" name="photo" accept="image/*" onchange="previewPhoto(this)">
                            <div class="mt-2">
                                <img id="photoPreview" src="assets/img/default-profile.svg" class="rounded" style="max-width: 100px;">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Date d'adhésion</label>
                            <input type="date" class="form-control" name="date_adhesion" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Statut</label>
                            <select class="form-select" name="statut" required>
                                <option value="">Sélectionner</option>
                                <option value="actif">Actif</option>
                                <option value="inactif">Inactif</option>
                                <option value="suspendu">Suspendu</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary" onclick="checkPresidentRole()">Enregistrer</button>
                </div>
            </div>
        </div>
    </div>

    <!-- View Member Details Modal -->
    <div class="modal fade" id="viewMemberModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Détails du membre</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4 text-center mb-3">
                            <div class="mb-3 position-relative">
                                <img src="assets/img/default-profile.svg" class="rounded-circle bg-light" alt="Photo de profil" style="width: 150px; height: 150px; object-fit: cover;" id="memberPhoto">
                                <div class="position-absolute bottom-0 end-0">
                                    <button class="btn btn-sm btn-primary rounded-circle me-1" style="width: 32px; height: 32px;" onclick="openPhotoUpload()" title="Télécharger une photo">
                                        <i class="fas fa-upload"></i>
                                    </button>
                                    <button class="btn btn-sm btn-secondary rounded-circle" style="width: 32px; height: 32px;" onclick="removePhoto()" title="Supprimer la photo">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                                <input type="file" id="photoInput" accept="image/*" style="display: none;" onchange="handlePhotoUpload(event)">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Nom</label>
                                    <p id="memberName"></p>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Prénom</label>
                                    <p id="memberFirstName"></p>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">CNI</label>
                                    <p id="memberCNI"></p>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Date de naissance</label>
                                    <p id="memberBirthDate"></p>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Lieu de naissance</label>
                                    <p id="memberBirthPlace"></p>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Sexe</label>
                                    <p id="memberGender"></p>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Profession</label>
                                    <p id="memberProfession"></p>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Email</label>
                                    <p id="memberEmail"></p>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Téléphone</label>
                                    <p id="memberPhone"></p>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Adresse</label>
                                    <p id="memberAddress"></p>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Date d'adhésion</label>
                                    <p id="memberJoinDate"></p>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Montant d'adhésion</label>
                                    <p id="memberFee"></p>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Statut</label>
                                    <p><span class="badge" id="memberStatus"></span></p>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Rôle</label>
                                    <p><span class="badge" id="memberRole"></span></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Historique des rôles -->
                    <div class="mt-4">
                        <h6 class="border-bottom pb-2">Historique des rôles</h6>
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Ancien rôle</th>
                                        <th>Nouveau rôle</th>
                                        <th>Modifié par</th>
                                        <th>Motif</th>
                                    </tr>
                                </thead>
                                <tbody id="roleHistory">
                                    <tr>
                                        <td>01/01/2024</td>
                                        <td>Membre</td>
                                        <td>Président</td>
                                        <td>Admin</td>
                                        <td>Élection annuelle</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Statistiques de participation -->
                    <div class="mt-4">
                        <h6 class="border-bottom pb-2">Statistiques de participation</h6>
                        <div class="row g-3">
                            <div class="col-md-3">
                                <div class="card bg-light">
                                    <div class="card-body text-center">
                                        <h3 class="mb-0" id="meetingAttendance">85%</h3>
                                        <small>Présence réunions</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-light">
                                    <div class="card-body text-center">
                                        <h3 class="mb-0" id="savingsRate">100%</h3>
                                        <small>Épargnes à jour</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-light">
                                    <div class="card-body text-center">
                                        <h3 class="mb-0" id="loanCount">2</h3>
                                        <small>Prêts actifs</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-light">
                                    <div class="card-body text-center">
                                        <h3 class="mb-0" id="sanctionCount">0</h3>
                                        <small>Sanctions</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="button" class="btn btn-warning" onclick="openChangeRoleModal()" id="changeRoleBtn">
                        <i class="fas fa-user-tag me-2"></i>Modifier le rôle
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Change Role Modal -->
    <div class="modal fade" id="changeRoleModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title">
                        <i class="fas fa-user-tag me-2"></i>Modifier le rôle du membre
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        Seul le président peut modifier les rôles des membres.
                        Cette action sera enregistrée dans l'historique.
                    </div>

                    <form id="changeRoleForm">
                        <div class="mb-3">
                            <label class="form-label">Membre</label>
                            <input type="text" class="form-control" id="memberFullName" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Rôle actuel</label>
                            <input type="text" class="form-control" id="currentRole" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nouveau rôle</label>
                            <select class="form-select" id="newRole" required>
                                <option value="">Sélectionner un rôle</option>
                                <option value="president">Président</option>
                                <option value="secretaire">Secrétaire</option>
                                <option value="tresorier">Trésorier</option>
                                <option value="membre">Membre</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Motif du changement</label>
                            <textarea class="form-control" id="changeReason" rows="3" required 
                                placeholder="Expliquez la raison de ce changement de rôle..."></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Date d'effet</label>
                            <input type="date" class="form-control" id="effectiveDate" required>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="confirmChange" required>
                            <label class="form-check-label" for="confirmChange">
                                Je confirme ce changement de rôle et comprends que cette action sera enregistrée
                            </label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-warning" onclick="submitRoleChange()">
                        <i class="fas fa-save me-2"></i>Confirmer le changement
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
    // Fonction pour ouvrir le modal des détails
    function openMemberDetails(memberId) {
        // Ici, vous feriez normalement un appel API pour récupérer les détails du membre
        // Pour l'exemple, nous utilisons des données statiques
        const memberDetails = {
            id: memberId,
            name: 'Doe',
            firstName: 'John',
            role: 'Président',
            status: 'Actif',
            // ... autres détails
        };

        // Mettre à jour les éléments du modal avec les détails du membre
        document.getElementById('memberName').textContent = memberDetails.name;
        document.getElementById('memberFirstName').textContent = memberDetails.firstName;
        // ... mettre à jour les autres champs

        // Afficher le modal
        const modal = new bootstrap.Modal(document.getElementById('viewMemberModal'));
        modal.show();
    }

    // Fonction pour ouvrir le modal de changement de rôle
    function openChangeRoleModal() {
        // Vérifier si l'utilisateur est président
        if (!isPresident()) {
            showNotification('Seul le président peut modifier les rôles des membres.', 'error');
            return;
        }

        // Préremplir les informations du membre
        document.getElementById('memberFullName').value = 
            document.getElementById('memberName').textContent + ' ' + 
            document.getElementById('memberFirstName').textContent;
        document.getElementById('currentRole').value = 
            document.getElementById('memberRoleBadge').textContent;

        // Définir la date d'effet par défaut à aujourd'hui
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('effectiveDate').value = today;

        // Fermer le modal des détails et ouvrir celui du changement de rôle
        bootstrap.Modal.getInstance(document.getElementById('viewMemberModal')).hide();
        const modal = new bootstrap.Modal(document.getElementById('changeRoleModal'));
        modal.show();
    }

    // Fonction pour soumettre le changement de rôle
    function submitRoleChange() {
        const form = document.getElementById('changeRoleForm');
        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }

        // Récupérer les valeurs du formulaire
        const newRole = document.getElementById('newRole').value;
        const reason = document.getElementById('changeReason').value;
        const effectiveDate = document.getElementById('effectiveDate').value;

        // Ici, vous feriez normalement un appel API pour enregistrer le changement
        console.log('Changement de rôle:', { newRole, reason, effectiveDate });

        // Fermer le modal et afficher une notification
        bootstrap.Modal.getInstance(document.getElementById('changeRoleModal')).hide();
        showNotification('Le rôle a été modifié avec succès!', 'success');

        // Mettre à jour l'interface utilisateur
        document.getElementById('memberRoleBadge').textContent = newRole;
    }

    // Fonction pour vérifier si l'utilisateur est président
    function isPresident() {
        // À implémenter avec la vraie logique d'authentification
        return true;
    }

    // Fonction pour supprimer la photo
    function removePhoto() {
        if (confirm('Êtes-vous sûr de vouloir supprimer votre photo de profil ?')) {
            document.getElementById('memberPhoto').src = 'assets/img/default-profile.svg';
            showNotification('Photo de profil supprimée avec succès!', 'success');
        }
    }

    // Fonction pour ouvrir le sélecteur de fichier
    function openPhotoUpload() {
        document.getElementById('photoInput').click();
    }

    // Fonction pour gérer le téléchargement de la photo
    function handlePhotoUpload(event) {
        const file = event.target.files[0];
        if (!file) return;

        // Vérifier le type de fichier
        if (!file.type.startsWith('image/')) {
            showNotification('Veuillez sélectionner une image.', 'error');
            return;
        }

        // Vérifier la taille du fichier (max 5MB)
        if (file.size > 5 * 1024 * 1024) {
            showNotification('La taille de l\'image ne doit pas dépasser 5MB.', 'error');
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            // Mettre à jour l'image directement
            document.getElementById('memberPhoto').src = e.target.result;
            showNotification('Photo de profil mise à jour avec succès!', 'success');
        };
        reader.readAsDataURL(file);
    }

    // Fonction pour afficher les notifications
    function showNotification(message, type) {
        // Créer l'élément de notification
        const notification = document.createElement('div');
        notification.className = `alert alert-${type} alert-dismissible fade show position-fixed bottom-0 end-0 m-3`;
        notification.role = 'alert';
        notification.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        `;

        // Ajouter au document
        document.body.appendChild(notification);

        // Supprimer après 3 secondes
        setTimeout(() => {
            notification.remove();
        }, 3000);
    }

    // Ajouter les gestionnaires d'événements pour les boutons de détails
    document.querySelectorAll('.btn-info').forEach(button => {
        button.addEventListener('click', function() {
            const memberId = this.closest('tr').dataset.memberId;
            openMemberDetails(memberId);
        });
    });
    </script>

@endsection
