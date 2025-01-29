document.addEventListener('DOMContentLoaded', function() {
    // Gestion du menu mobile
    const moreMenuBtn = document.getElementById('moreMenuBtn');
    const dropupMenu = document.getElementById('dropupMenu');
    const navItems = document.querySelectorAll('.navbar-nav .nav-item:not(.more-menu)');

    // Fonction pour gérer l'affichage du menu dropup
    if (moreMenuBtn && dropupMenu) {
        moreMenuBtn.addEventListener('click', function(e) {
            e.preventDefault();
            dropupMenu.classList.toggle('show');
        });

        // Fermer le menu quand on clique en dehors
        document.addEventListener('click', function(e) {
            if (!moreMenuBtn.contains(e.target) && !dropupMenu.contains(e.target)) {
                dropupMenu.classList.remove('show');
            }
        });
    }

    // Fonction pour déplacer les éléments du menu dans le dropup sur mobile
    function updateMobileMenu() {
        if (window.innerWidth < 768 && dropupMenu) {
            // Vider le dropup menu
            dropupMenu.innerHTML = '';
            
            // Déplacer les éléments après le 4ème dans le dropup
            navItems.forEach((item, index) => {
                if (index >= 4) {
                    const clone = item.querySelector('.nav-link').cloneNode(true);
                    const newItem = document.createElement('a');
                    newItem.className = clone.className;
                    newItem.href = clone.href;
                    newItem.innerHTML = clone.innerHTML;
                    dropupMenu.appendChild(newItem);
                }
            });
        }
    }

    // Mettre à jour le menu au chargement et au redimensionnement
    updateMobileMenu();
    window.addEventListener('resize', updateMobileMenu);
});
