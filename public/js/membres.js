// Gestion des membres
let currentPage = 1;
const itemsPerPage = 10;
let membres = [];
let filteredMembres = [];

// Initialisation
document.addEventListener('DOMContentLoaded', () => {
    // Chargement initial des membres
    loadMembers();
    
    // Chargement des statistiques
    loadStatistics();
    initializeCharts();

    // Gestionnaires d'événements pour les filtres
    document.getElementById('searchMembre').addEventListener('input', filterMembers);
    document.getElementById('filterStatut').addEventListener('change', filterMembers);
    document.getElementById('filterRole').addEventListener('change', filterMembers);
    document.getElementById('filterCotisation').addEventListener('change', filterMembers);

    // Validation du formulaire d'ajout
    const addMemberForm = document.getElementById('addMemberForm');
    if (addMemberForm) {
        addMemberForm.addEventListener('submit', handleAddMember);
    }
});

// Charger les membres depuis l'API
async function loadMembers() {
    try {
        // Simulation d'appel API
        const response = await fetch('api/membres');
        membres = await response.json();
        filteredMembres = [...membres];
        displayMembers();
    } catch (error) {
        showNotification('Erreur lors du chargement des membres', 'error');
    }
}

// Charger les statistiques
async function loadStatistics() {
    try {
        // Simulation d'appel API
        const response = await fetch('api/membres/statistiques');
        const stats = await response.json();

        // Mise à jour des compteurs
        document.getElementById('totalMembres').textContent = stats.total;
        document.getElementById('membresActifs').textContent = stats.actifs;
        document.getElementById('cotisationsRetard').textContent = stats.retards;
        document.getElementById('nouveauxMembres').textContent = stats.nouveaux;

        // Mise à jour des graphiques
        updateAdhesionsChart(stats.adhesions);
        updateStatutsChart(stats.statuts);
    } catch (error) {
        showNotification('Erreur lors du chargement des statistiques', 'error');
    }
}

// Initialiser les graphiques
function initializeCharts() {
    // Graphique des adhésions
    const adhesionsCtx = document.getElementById('adhesionsChart').getContext('2d');
    window.adhesionsChart = new Chart(adhesionsCtx, {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                label: 'Nouvelles adhésions',
                data: [],
                borderColor: '#0d6efd',
                tension: 0.4,
                fill: true,
                backgroundColor: 'rgba(13, 110, 253, 0.1)'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });

    // Graphique des statuts
    const statutsCtx = document.getElementById('statutsChart').getContext('2d');
    window.statutsChart = new Chart(statutsCtx, {
        type: 'doughnut',
        data: {
            labels: ['Actifs', 'Inactifs', 'Suspendus'],
            datasets: [{
                data: [],
                backgroundColor: [
                    '#198754', // success
                    '#6c757d', // secondary
                    '#ffc107'  // warning
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'right'
                }
            }
        }
    });
}

// Mettre à jour le graphique des adhésions
function updateAdhesionsChart(data) {
    window.adhesionsChart.data.labels = data.labels;
    window.adhesionsChart.data.datasets[0].data = data.values;
    window.adhesionsChart.update();
}

// Mettre à jour le graphique des statuts
function updateStatutsChart(data) {
    window.statutsChart.data.datasets[0].data = [
        data.actifs,
        data.inactifs,
        data.suspendus
    ];
    window.statutsChart.update();
}

// Filtrer les membres
function filterMembers() {
    const searchTerm = document.getElementById('searchMembre').value.toLowerCase();
    const statutFilter = document.getElementById('filterStatut').value;
    const roleFilter = document.getElementById('filterRole').value;
    const cotisationFilter = document.getElementById('filterCotisation').value;

    filteredMembres = membres.filter(membre => {
        const matchSearch = `${membre.nom} ${membre.prenom} ${membre.numero_membre}`.toLowerCase().includes(searchTerm);
        const matchStatut = !statutFilter || membre.statut === statutFilter;
        const matchRole = !roleFilter || membre.role === roleFilter;
        const matchCotisation = !cotisationFilter || membre.statut_cotisation === cotisationFilter;

        return matchSearch && matchStatut && matchRole && matchCotisation;
    });

    currentPage = 1;
    displayMembers();
}

// Afficher les membres
function displayMembers() {
    const tbody = document.getElementById('membersTableBody');
    const start = (currentPage - 1) * itemsPerPage;
    const end = start + itemsPerPage;
    const membersToDisplay = filteredMembres.slice(start, end);

    tbody.innerHTML = membersToDisplay.map(membre => `
        <tr data-member-id="${membre.id}">
            <td>${membre.numero_membre}</td>
            <td>
                <img src="${membre.photo || 'images/default-profile.png'}" 
                     alt="Photo" class="rounded-circle" 
                     style="width: 32px; height: 32px; object-fit: cover;">
            </td>
            <td>${membre.nom}</td>
            <td>${membre.prenom}</td>
            <td>
                <div>${membre.telephone || '-'}</div>
                <small class="text-muted">${membre.email || ''}</small>
            </td>
            <td>
                <span class="badge bg-${getStatusBadgeClass(membre.statut)}">
                    ${membre.statut}
                </span>
            </td>
            <td>
                <span class="badge bg-${getRoleBadgeClass(membre.role)}">
                    ${membre.role}
                </span>
            </td>
            <td>
                <span class="badge bg-${getContributionBadgeClass(membre.statut_cotisation)}">
                    ${membre.statut_cotisation}
                </span>
            </td>
            <td>
                <div class="btn-group btn-group-sm">
                    <button class="btn btn-outline-primary" onclick="viewMemberDetails(${membre.id})">
                        <i class="fas fa-eye"></i>
                    </button>
                    <button class="btn btn-outline-warning" onclick="editMember(${membre.id})">
                        <i class="fas fa-edit"></i>
                    </button>
                    ${isPresident() ? `
                        <button class="btn btn-outline-danger" onclick="deleteMember(${membre.id})">
                            <i class="fas fa-trash"></i>
                        </button>
                    ` : ''}
                </div>
            </td>
        </tr>
    `).join('');

    updatePagination();
}

// Mettre à jour la pagination
function updatePagination() {
    const totalPages = Math.ceil(filteredMembres.length / itemsPerPage);
    const pagination = document.getElementById('membersPagination');
    
    let paginationHtml = '';
    
    // Bouton précédent
    paginationHtml += `
        <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
            <a class="page-link" href="#" onclick="changePage(${currentPage - 1})">
                <i class="fas fa-chevron-left"></i>
            </a>
        </li>
    `;

    // Pages
    for (let i = 1; i <= totalPages; i++) {
        if (i === 1 || i === totalPages || (i >= currentPage - 2 && i <= currentPage + 2)) {
            paginationHtml += `
                <li class="page-item ${i === currentPage ? 'active' : ''}">
                    <a class="page-link" href="#" onclick="changePage(${i})">${i}</a>
                </li>
            `;
        } else if (i === currentPage - 3 || i === currentPage + 3) {
            paginationHtml += '<li class="page-item disabled"><span class="page-link">...</span></li>';
        }
    }

    // Bouton suivant
    paginationHtml += `
        <li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
            <a class="page-link" href="#" onclick="changePage(${currentPage + 1})">
                <i class="fas fa-chevron-right"></i>
            </a>
        </li>
    `;

    pagination.innerHTML = paginationHtml;
}

// Changer de page
function changePage(page) {
    const totalPages = Math.ceil(filteredMembres.length / itemsPerPage);
    if (page >= 1 && page <= totalPages) {
        currentPage = page;
        displayMembers();
    }
}

// Gérer l'ajout d'un membre
async function handleAddMember(event) {
    event.preventDefault();
    
    const form = event.target;
    if (!form.checkValidity()) {
        event.stopPropagation();
        form.classList.add('was-validated');
        return;
    }

    const formData = new FormData(form);
    const memberData = Object.fromEntries(formData.entries());

    try {
        // Simulation d'appel API
        const response = await fetch('api/membres', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(memberData),
        });

        if (response.ok) {
            showNotification('Membre ajouté avec succès', 'success');
            $('#addMemberModal').modal('hide');
            form.reset();
            loadMembers();
        } else {
            throw new Error('Erreur lors de l\'ajout du membre');
        }
    } catch (error) {
        showNotification(error.message, 'error');
    }
}

// Afficher les détails d'un membre
async function viewMemberDetails(memberId) {
    try {
        // Simulation d'appel API
        const response = await fetch(`api/membres/${memberId}`);
        const membre = await response.json();

        // Mise à jour des informations dans le modal
        document.getElementById('memberDetailPhoto').src = membre.photo || 'images/default-profile.png';
        document.getElementById('memberDetailName').textContent = `${membre.nom} ${membre.prenom}`;
        document.getElementById('memberDetailRole').textContent = membre.role;
        document.getElementById('memberDetailNumber').textContent = membre.numero_membre;
        
        // Informations personnelles
        document.getElementById('memberDetailBirthDate').textContent = membre.date_naissance || '-';
        document.getElementById('memberDetailBirthPlace').textContent = membre.lieu_naissance || '-';
        document.getElementById('memberDetailPhone').textContent = membre.telephone || '-';
        document.getElementById('memberDetailEmail').textContent = membre.email || '-';
        document.getElementById('memberDetailAddress').textContent = membre.adresse || '-';
        document.getElementById('memberDetailProfession').textContent = membre.profession || '-';
        document.getElementById('memberDetailJoinDate').textContent = membre.date_adhesion || '-';

        // Statistiques
        document.getElementById('memberDetailSavings').textContent = formatMoney(membre.total_epargne);
        document.getElementById('memberDetailLoans').textContent = formatMoney(membre.total_prets);
        document.getElementById('memberDetailMeetings').textContent = `${membre.participation_reunions}%`;
        document.getElementById('memberDetailContribStatus').textContent = membre.statut_cotisation;

        // Historique des rôles
        const roleHistory = await fetch(`api/membres/${memberId}/historique-roles`).then(r => r.json());
        displayRoleHistory(roleHistory);

        // Afficher le modal
        $('#viewMemberModal').modal('show');
    } catch (error) {
        showNotification('Erreur lors du chargement des détails du membre', 'error');
    }
}

// Afficher l'historique des rôles
function displayRoleHistory(history) {
    const tbody = document.getElementById('roleHistoryTable');
    tbody.innerHTML = history.map(entry => `
        <tr>
            <td>${formatDate(entry.date_changement)}</td>
            <td>${entry.ancien_role}</td>
            <td>${entry.nouveau_role}</td>
            <td>${entry.modifie_par_nom}</td>
        </tr>
    `).join('');
}

// Modifier un membre
async function editMember(memberId) {
    // TODO: Implémenter la modification
    showNotification('Fonctionnalité en cours de développement', 'info');
}

// Supprimer un membre
async function deleteMember(memberId) {
    if (!confirm('Êtes-vous sûr de vouloir supprimer ce membre ?')) {
        return;
    }

    try {
        // Simulation d'appel API
        const response = await fetch(`api/membres/${memberId}`, {
            method: 'DELETE'
        });

        if (response.ok) {
            showNotification('Membre supprimé avec succès', 'success');
            loadMembers();
        } else {
            throw new Error('Erreur lors de la suppression du membre');
        }
    } catch (error) {
        showNotification(error.message, 'error');
    }
}

// Fonctions utilitaires
function getStatusBadgeClass(status) {
    const classes = {
        'actif': 'success',
        'inactif': 'secondary',
        'suspendu': 'warning'
    };
    return classes[status] || 'secondary';
}

function getRoleBadgeClass(role) {
    const classes = {
        'president': 'danger',
        'admin': 'primary',
        'tresorier': 'success',
        'secretaire': 'info',
        'membre': 'secondary'
    };
    return classes[role] || 'secondary';
}

function getContributionBadgeClass(status) {
    const classes = {
        'à_jour': 'success',
        'en_retard': 'warning',
        'suspendu': 'danger'
    };
    return classes[status] || 'secondary';
}

function formatMoney(amount) {
    return new Intl.NumberFormat('fr-FR', {
        style: 'currency',
        currency: 'XAF'
    }).format(amount);
}

function formatDate(dateString) {
    return new Date(dateString).toLocaleDateString('fr-FR', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
}

// Prévisualisation de la photo
function previewPhoto(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('photoPreview').src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// Vérifier si l'utilisateur est président
function isPresident() {
    // TODO: Implémenter la vérification du rôle
    return true; // Pour le développement
}

// Afficher une notification
function showNotification(message, type = 'info') {
    // Utiliser Bootstrap Toast ou une autre bibliothèque de notification
    console.log(`${type}: ${message}`);
}
