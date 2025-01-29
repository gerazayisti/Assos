import Chart from 'chart.js/auto';

const chartOptions = {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
        legend: {
            position: 'bottom'
        }
    }
};

const createLoansProgressChart = (data) => {
    const ctx = document.getElementById('loansProgressChart');
    if (!ctx) return;

    return new Chart(ctx, {
        type: 'line',
        data: {
            labels: data.labels,
            datasets: [{
                label: 'Montant des prêts',
                data: data.montants,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        },
        options: {
            ...chartOptions,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: (value) => new Intl.NumberFormat('fr-FR').format(value) + ' FCFA'
                    }
                }
            }
        }
    });
};

const createRepaymentStatusChart = (data) => {
    const ctx = document.getElementById('repaymentStatusChart');
    if (!ctx) return;

    return new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Remboursé', 'En cours', 'En retard'],
            datasets: [{
                data: [data.rembourse, data.en_cours, data.en_retard],
                backgroundColor: [
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 99, 132)'
                ]
            }]
        },
        options: chartOptions
    });
};

const createRepaymentProgressChart = (data) => {
    const ctx = document.getElementById('repaymentProgressChart');
    if (!ctx) return;

    return new Chart(ctx, {
        type: 'bar',
        data: {
            labels: data.labels,
            datasets: [{
                label: 'Remboursements',
                data: data.montants,
                backgroundColor: 'rgba(75, 192, 192, 0.5)',
                borderColor: 'rgb(75, 192, 192)',
                borderWidth: 1
            }]
        },
        options: {
            ...chartOptions,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: (value) => new Intl.NumberFormat('fr-FR').format(value) + ' FCFA'
                    }
                }
            }
        }
    });
};

export const initCharts = async () => {
    try {
        const [loansResponse, statusResponse] = await Promise.all([
            fetch('/api/prets/stats/progress'),
            fetch('/api/prets/stats/status')
        ]);

        const [loansData, statusData] = await Promise.all([
            loansResponse.json(),
            statusResponse.json()
        ]);

        if (loansData.success && statusData.success) {
            createLoansProgressChart(loansData.data);
            createRepaymentStatusChart(statusData.data);
        }
    } catch (error) {
        console.error('Error initializing charts:', error);
        toastr.error('Erreur lors du chargement des graphiques');
    }
};
