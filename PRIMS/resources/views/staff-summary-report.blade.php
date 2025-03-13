<x-app-layout>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
 
    <div class="relative h-[400px] w-full">
<canvas id="appointmentChart"></canvas>
</div>
 
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let chartInstance = null;
 
            function renderChart() {
                const ctx = document.getElementById('appointmentChart').getContext('2d');
 
                if (chartInstance) {
                    chartInstance.destroy(); // Delete old chart first
                }
 
                // Ensure PHP variables are safely injected into JavaScript
                const attendedCount = @json($attendedCount);
                const cancelledCount = @json($cancelledCount);
 
                console.log("Chart Data:", attendedCount, cancelledCount); // Debugging
 
                chartInstance = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: ['Attended Appointment', 'Cancelled Appointment'],
                        datasets: [{
                            data: [attendedCount, cancelledCount],
                            backgroundColor: ['#4CAF50', '#FF5733'],
                            borderColor: ['#ffffff'],
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });
            }
 
            // Render the chart
            renderChart();
        });
</script>
</x-app-layout>