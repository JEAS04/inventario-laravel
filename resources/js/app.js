import './bootstrap';

import Alpine from 'alpinejs';
import DataTable from 'datatables.net-dt';
import 'datatables.net-dt/css/dataTables.dataTables.css';
import Chart from 'chart.js/auto';

window.Alpine = Alpine;
window.Chart = Chart;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('table[id$="-table"]').forEach((table) => {
        new DataTable(table, {
            pageLength: 10,
            columnDefs: [{ targets: -1, orderable: false, searchable: false }],
        });
    });

    const canvas = document.getElementById('stock-chart');
    if (canvas) {
        const { labels, values } = JSON.parse(canvas.dataset.chart);
        new Chart(canvas, {
            type: 'bar',
            data: {
                labels,
                datasets: [{ label: 'Units in stock', data: values, backgroundColor: '#4f46e5' }],
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true, ticks: { precision: 0 } } },
            },
        });
    }
});
