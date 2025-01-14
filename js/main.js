// Main JavaScript file for Famille Megué Application

// Wait for the DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Search functionality
    const searchInput = document.querySelector('input[placeholder="Rechercher un membre..."]');
    if (searchInput) {
        searchInput.addEventListener('input', function(e) {
            // TODO: Implement search functionality
            console.log('Searching for:', e.target.value);
        });
    }

    // Filter functionality
    const filterButton = document.querySelector('.btn-secondary');
    if (filterButton) {
        filterButton.addEventListener('click', function() {
            const status = document.querySelector('select[class="form-select"]').value;
            const sortBy = document.querySelectorAll('select[class="form-select"]')[1].value;
            
            // TODO: Implement filter functionality
            console.log('Filtering by status:', status, 'and sorting by:', sortBy);
        });
    }

    // Form submission handling
    const addMemberForm = document.querySelector('#addMemberModal form');
    if (addMemberForm) {
        addMemberForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form data
            const formData = new FormData(this);
            const memberData = Object.fromEntries(formData.entries());
            
            // TODO: Send data to backend
            console.log('New member data:', memberData);
            
            // Close modal
            const modal = bootstrap.Modal.getInstance(document.querySelector('#addMemberModal'));
            modal.hide();
            
            // Show success message
            showNotification('Membre ajouté avec succès!', 'success');
        });
    }

    // Delete member handling
    const deleteButtons = document.querySelectorAll('.btn-danger');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            if (confirm('Êtes-vous sûr de vouloir supprimer ce membre ?')) {
                // TODO: Implement delete functionality
                console.log('Deleting member...');
                showNotification('Membre supprimé avec succès!', 'success');
            }
        });
    });
});

// Utility function to show notifications
function showNotification(message, type = 'info') {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `alert alert-${type} alert-dismissible fade show position-fixed top-0 end-0 m-3`;
    notification.role = 'alert';
    notification.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    `;
    
    // Add to document
    document.body.appendChild(notification);
    
    // Remove after 3 seconds
    setTimeout(() => {
        notification.remove();
    }, 3000);
}

// Handle API calls
async function apiCall(endpoint, method = 'GET', data = null) {
    try {
        const options = {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                // Add any authentication headers here
            }
        };
        
        if (data) {
            options.body = JSON.stringify(data);
        }
        
        const response = await fetch(`/api/${endpoint}`, options);
        const result = await response.json();
        
        if (!response.ok) {
            throw new Error(result.message || 'Une erreur est survenue');
        }
        
        return result;
    } catch (error) {
        console.error('API Error:', error);
        showNotification(error.message, 'danger');
        throw error;
    }
}

// Data formatting utilities
const formatDate = (date) => {
    return new Date(date).toLocaleDateString('fr-FR', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
};

const formatCurrency = (amount) => {
    return new Intl.NumberFormat('fr-FR', {
        style: 'currency',
        currency: 'XAF'
    }).format(amount);
};
