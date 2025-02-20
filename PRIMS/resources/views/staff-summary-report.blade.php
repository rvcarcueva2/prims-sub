<x-app-layout>
    <div class="p-4 bg-gray-100">
        <!-- Header -->
        <div class="flex justify-between items-center bg-blue-900 text-white p-3 rounded-lg">
            <h2 class="text-lg font-bold">Summary Report</h2>
            <div class="flex space-x-2 relative">
                <select id="month-filter" class="border p-2 pr-8 rounded text-black bg-white appearance-none"></select>
                <select id="year-filter" class="border p-2 pr-8 rounded text-black bg-white appearance-none"></select>
            </div>
        </div>

        <!-- Statistics -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mt-3">
            <div class="space-y-3">
                <!-- Appointments Count -->
                <div class="bg-yellow-300 p-4 rounded-lg text-center border-2 border-blue-500 shadow-md">
                    <h3 id="appointments-count" class="text-3xl font-bold">79</h3>
                    <p class="text-sm">Appointments</p>
                    <!-- Meter -->
                    <div class="w-full bg-gray-300 h-4 rounded-lg mt-2">
                        <div id="appointments-meter" class="h-full bg-green-500 rounded-lg" style="width: 70%;"></div>
                    </div>
                    <p class="text-xs mt-1">Attended: <span id="attended-count">55</span> | Canceled: <span id="canceled-count">24</span></p>
                </div>

                <!-- Patients Count -->
                <div class="bg-yellow-300 p-4 rounded-lg text-center border-2 border-blue-500 shadow-md">
                    <h3 id="patients-count" class="text-3xl font-bold">52</h3>
                    <p class="text-sm">Patients</p>
                    <div class="h-[200px] mt-2">
                        <canvas id="gender-chart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Patient Count Graph -->
            <div class="bg-white p-4 rounded-lg shadow-md border-t-2 border-blue-500 h-[400px]">
                <h4 class="font-bold text-md mb-3">Patient Count Graph</h4>
                <canvas id="line-chart"></canvas>
            </div>
        </div>

        <!-- Reports Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mt-4">
            <!-- Primary Reasons Chart (Fixed Layout) -->
            <div class="bg-white p-4 rounded-lg shadow-md border-t-2 border-blue-500 h-[400px] flex flex-col items-center">
                <h4 class="font-bold text-md mb-3">Primary Reasons for Clinic Visits</h4>
                <div class="w-[80%] h-[300px]">
                    <canvas id="pie-chart"></canvas>
                </div>
            </div>

            <!-- Most Commonly Prescribed Medications -->
            <div class="bg-white p-4 rounded-lg shadow-md border-t-2 border-blue-500 h-[350px] overflow-hidden pb-4">
                <h4 class="font-bold text-md mb-3">Most Commonly Prescribed Medications</h4>
                <canvas id="bar-chart" class="h-full"></canvas>
            </div>
        </div>

        <!-- Generate Report Button -->
        <div class="text-center mt-4">
            <button class="bg-blue-900 text-white px-4 py-2 rounded-lg text-md shadow-md">Generate a summary report</button>
        </div>
    </div>

    <!-- Chart.js Library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Appointments Meter
            let attended = 55;
            let canceled = 24;
            let totalAppointments = attended + canceled;
            let attendedPercentage = (attended / totalAppointments) * 100;
            document.getElementById("appointments-meter").style.width = attendedPercentage + "%";
            document.getElementById("attended-count").textContent = attended;
            document.getElementById("canceled-count").textContent = canceled;

            // Gender Chart (Patients)
            var ctxGender = document.getElementById("gender-chart").getContext("2d");
            new Chart(ctxGender, {
                type: "doughnut",
                data: {
                    labels: ["Male", "Female"],
                    datasets: [{
                        data: [30, 22],
                        backgroundColor: ["#36A2EB", "#FF6384"]
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });

            // Line Chart (Patient Count Graph)
            var ctxLine = document.getElementById("line-chart").getContext("2d");
            new Chart(ctxLine, {
                type: "line",
                data: {
                    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    datasets: [
                        {
                            label: "Patients This Year",
                            data: [30, 50, 45, 60, 80, 75, 90, 100, 85, 95, 110, 120],
                            borderColor: "blue",
                            fill: false,
                        },
                        {
                            label: "Previous Year",
                            data: [20, 40, 35, 50, 70, 65, 80, 90, 75, 85, 100, 110],
                            borderColor: "orange",
                            fill: false,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });

            // Pie Chart (Clinic Visit Reasons - Fixed Layout)
            var ctxPie = document.getElementById("pie-chart").getContext("2d");
            new Chart(ctxPie, {
                type: "pie",
                data: {
                    labels: ["Top 1 Reason", "Top 2 Reason", "Top 3 Reason"],
                    datasets: [{
                        data: [60, 25, 15],
                        backgroundColor: ["#FF6384", "#36A2EB", "#FFCE56"]
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    layout: {
                        padding: 10
                    },
                    plugins: {
                        legend: {
                            position: "bottom",
                            labels: {
                                padding: 15,
                                boxWidth: 20
                            }
                        }
                    }
                }
            });

            // Bar Chart (Most Commonly Prescribed Medications)
            var ctxBar = document.getElementById("bar-chart").getContext("2d");
            new Chart(ctxBar, {
                type: "bar",
                data: {
                    labels: ["Drug 1", "Drug 2", "Drug 3", "Drug 4", "Drug 5"],
                    datasets: [{
                        label: "Prescriptions",
                        data: [80, 60, 40, 30, 70],
                        backgroundColor: "gray"
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    indexAxis: "y"
                }
            });

            // Dynamic Year & Month Selection (Improved for Long-Term Use)
            const monthFilter = document.getElementById("month-filter");
            const yearFilter = document.getElementById("year-filter");

            const months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
            months.forEach((month, index) => {
                monthFilter.add(new Option(month, index + 1));
            });

            const currentYear = new Date().getFullYear();
            for (let i = currentYear - 5; i <= currentYear + 1; i++) {
                yearFilter.add(new Option(i, i));
            }
        });
    </script>
</x-app-layout>
