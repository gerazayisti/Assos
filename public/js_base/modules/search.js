export const handleSearch = (selector) => {
    const searchInput = document.querySelector(selector);
    if (!searchInput) return;

    const debounce = (func, wait) => {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    };

    const filterTable = (value) => {
        const searchValue = value.toLowerCase();
        const rows = document.querySelectorAll('table tbody tr');

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchValue) ? '' : 'none';
        });
    };

    searchInput.addEventListener('input', debounce((e) => {
        filterTable(e.target.value);
    }, 300));
};
