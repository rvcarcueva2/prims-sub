<x-app-layout>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <!-- Card Container for Stats -->
        <div class="bg-white shadow-lg rounded-lg p-6 mb-6">
            <div class="flex justify-between items-center">
                <!-- Left Section: Title -->
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800">
                        Appointment Summary
                    </h2>
                    <p class="text-sm text-gray-500">A quick overview of appointment stats</p>
                </div>
                <!-- Right Section: Display number of attended appointments -->
                <div class="text-center">
                    <h3 class="text-xl font-semibold text-yellow-500">Number of Appointments Attended:</h3>
                    <p class="text-2xl font-bold text-blue-500">{{ $attendedCount }}</p>
                </div>
            </div>
        </div>

        <!-- Doughnut Chart -->
        <div class="bg-white shadow-lg rounded-lg p-6">
            <div class="text-center mb-4">
                <h3 class="text-xl font-semibold text-gray-800">Appointments Overview</h3>
                <p class="text-sm text-gray-500">Visual representation of appointment statuses</p>
            </div>

            <!-- Doughnut Chart -->
            <div class="relative h-[400px] w-full">
                <canvas id="appointmentMeter"></canvas>
            </div>
        </div>

        <!-- Top 5 Prescribed Medications -->
        <div class="bg-white shadow-lg rounded-lg p-6 mt-6">
            <h3 class="text-xl font-semibold text-gray-800 text-center mb-4">Top 5 Most Prescribed Medications</h3>

            <!-- Horizontal Bar Chart for Top 5 Medications -->
            <div class="relative h-[400px] w-full">
                <canvas id="medicationChart"></canvas>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let chartInstance = null;

            // Render Doughnut Chart
            function renderDoughnut() {
                const ctx = document.getElementById('appointmentMeter').getContext('2d');
                if (chartInstance) {
                    chartInstance.destroy(); // Destroy old chart first
                }
                const attendedPercentage = @json($attendedPercentage);
                chartInstance = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Attended Appointment', 'Remaining'],
                        datasets: [{
                            data: [attendedPercentage, 100 - attendedPercentage],
                            backgroundColor: ['#4CAF50', '#FF5733'],
                            borderColor: ['#ffffff'],
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: '70%',
                        plugins: {
                            legend: { position: 'bottom' },
                            tooltip: {
                                callbacks: {
                                    label: function(tooltipItem) {
                                        if (tooltipItem.index === 0) {
                                            return 'Attended: ' + Math.round(attendedPercentage) + '%';
                                        } else {
                                            return 'Remaining: ' + Math.round(100 - attendedPercentage) + '%';
                                        }
                                    }
                                }
                            }
                        }
                    }
                });
            }

            // Render Horizontal Bar Chart for Top 5 Medications
            function renderMedicationChart() {
                const ctx = document.getElementById('medicationChart').getContext('2d');
                const medications = @json($medications); // Get medication data from controller
                const labels = medications.map(m => m.name);
                const data = medications.map(m => m.quantity_dispensed);

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Quantity Dispensed',
                            data: data,
                            backgroundColor: '#4CAF50', // Green color for the bars
                            borderColor: '#ffffff',
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        indexAxis: 'y', // Make it a horizontal bar chart
                        scales: {
                            x: { title: { display: true, text: 'Quantity Dispensed' } },
                            y: { title: { display: true, text: 'Medications' } }
                        },
                        plugins: {
                            legend: { position: 'top' }
                        }
                    }
                });
            }

            // Render both charts
            renderDoughnut();
            renderMedicationChart();
        });
    </script>
</x-app-layout>
