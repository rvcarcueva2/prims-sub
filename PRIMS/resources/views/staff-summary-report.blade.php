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
                <!-- Right Section: Display Attended & Cancelled Appointments Side-by-Side -->
                <div class="flex space-x-10">
                    <div class="text-center">
                        <h3 class="text-xl font-semibold text-green-500">Attended Appointments</h3>
                        <p class="text-2xl font-bold text-blue-500">{{ $attendedCount }}</p>
                    </div>
                    <div class="text-center">
                        <h3 class="text-xl font-semibold text-red-500">Cancelled Appointments</h3>
                        <p class="text-2xl font-bold text-red-500">{{ $cancelledCount }}</p>
                    </div>
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

        <!-- Top 5 Prescribed Medications & Most Common Diagnoses (Separate Containers) -->
        <div class="flex space-x-8 mt-6">
            <!-- Medication Chart Container -->
            <div class="bg-white shadow-lg rounded-lg p-6 w-1/2">
                <h3 class="text-xl font-semibold text-gray-800 text-center mb-4">Top 5 Most Prescribed Medications</h3>
                <div class="relative h-[400px]">
                    <canvas id="medicationChart"></canvas>
                </div>
            </div>

            <!-- Diagnosis Chart Container -->
            <div class="bg-white shadow-lg rounded-lg p-6 w-1/2">
                <h3 class="text-xl font-semibold text-gray-800 text-center mb-4">Most Common Diagnoses</h3>
                <div class="relative h-[400px]">
                    <canvas id="diagnosisChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let chartInstance = null;

            // Render Doughnut Chart for Appointment Overview
            function renderDoughnut() {
                const ctx = document.getElementById('appointmentMeter').getContext('2d');
                if (chartInstance) {
                    chartInstance.destroy(); // Destroy old chart first
                }
                const attendedCount = @json($attendedCount);
                const cancelledCount = @json($cancelledCount);
                const totalAppointments = attendedCount + cancelledCount;
                const attendedPercentage = totalAppointments > 0 ? (attendedCount / totalAppointments) * 100 : 0;
                const cancelledPercentage = totalAppointments > 0 ? (cancelledCount / totalAppointments) * 100 : 0;

                chartInstance = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Attended Appointments', 'Cancelled Appointments'],
                        datasets: [{
                            data: [attendedPercentage, cancelledPercentage],
                            backgroundColor: ['#4CAF50', '#FF5733'], // Green for attended, Red for cancelled
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
                                            return 'Cancelled: ' + Math.round(cancelledPercentage) + '%';
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

            // Render Pie Chart for Most Common Diagnoses
            function renderDiagnosisChart() {
                const ctx = document.getElementById('diagnosisChart').getContext('2d');
                const diagnoses = @json($diagnoses); // Get common diagnosis data from controller
                const labels = diagnoses.map(d => d.diagnosis);
                const data = diagnoses.map(d => d.count);

                new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Diagnosis Frequency',
                            data: data,
                            backgroundColor: ['#FF9F40', '#FF6384', '#36A2EB', '#FFCE56', '#4CAF50'],
                            borderColor: '#ffffff',
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { position: 'top' }
                        }
                    }
                });
            }

            // Render all charts
            renderDoughnut();
            renderMedicationChart();
            renderDiagnosisChart();
        });
    </script>
</x-app-layout>
