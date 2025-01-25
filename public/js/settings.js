// Fonction pour charger les paramètres de l'application
function loadAppSettings() {
    const defaultLogo = 'images/default-logo.png';
    const defaultName = 'Famille Megué';

    // Récupérer les paramètres sauvegardés
    const savedName = localStorage.getItem('associationName') || defaultName;
    const savedLogo = localStorage.getItem('associationLogo') || defaultLogo;

    // Mettre à jour tous les éléments de l'interface
    document.querySelectorAll('.nav-header .app-name').forEach(el => {
        el.textContent = savedName;
    });

    document.querySelectorAll('.nav-header .app-logo').forEach(el => {
        el.src = savedLogo;
        el.alt = savedName;
    });
}

// Charger les paramètres au chargement de la page
document.addEventListener('DOMContentLoaded', loadAppSettings);
