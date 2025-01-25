export const handleForms = (selector) => {
    const form = document.querySelector(selector);
    if (!form) return;

    const formatFormData = (formData) => {
        const data = {};
        for (let [key, value] of formData.entries()) {
            // Handle numeric values
            if (!isNaN(value) && value !== '') {
                value = parseFloat(value);
            }
            data[key] = value;
        }
        return data;
    };

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        try {
            const formData = new FormData(form);
            const data = formatFormData(formData);

            const response = await fetch(form.action, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(data)
            });

            const result = await response.json();

            if (response.ok) {
                toastr.success('Opération réussie');
                // Close modal if exists
                const modal = bootstrap.Modal.getInstance(form.closest('.modal'));
                if (modal) {
                    modal.hide();
                }
                // Reload page after a short delay
                setTimeout(() => window.location.reload(), 1000);
            } else {
                throw new Error(result.message || 'Une erreur est survenue');
            }
        } catch (error) {
            console.error('Form submission error:', error);
            toastr.error(error.message || 'Une erreur est survenue');
        }
    });
};
