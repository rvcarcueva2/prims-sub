<x-app-layout>
    <div class="p-6 bg-gray-100">
        <div class="flex justify-between items-center bg-blue-900 text-white p-4 rounded-lg">
            <h2 class="text-xl font-bold">Summary Report</h2>
            <div class="flex space-x-2 relative">
                <select id="month-filter" class="border p-2 pr-8 rounded text-black bg-white appearance-none">
                </select>
                <select id="year-filter" class="border p-2 pr-8 rounded text-black bg-white appearance-none">
                </select>
            </div>
        </div>
        
        <div class="grid grid-cols-3 gap-4 mt-4">
            <div class="bg-yellow-300 p-6 rounded-lg text-center border-4 border-blue-500 shadow-lg">
                <h3 id="appointments-count" class="text-4xl font-bold">79</h3>
                <p class="text-lg">Appointments</p>
            </div>
            <div class="bg-yellow-300 p-6 rounded-lg text-center border-4 border-blue-500 shadow-lg">
                <h3 id="patients-count" class="text-4xl font-bold">52</h3>
                <p class="text-lg">Patients</p>
            </div>
            <div class="bg-yellow-300 p-6 rounded-lg text-center border-4 border-blue-500 shadow-lg">
                <h3 id="visitors-count" class="text-4xl font-bold">130</h3>
                <p class="text-lg">Visitors</p>
            </div>
        </div>
        
        <div class="grid grid-cols-2 gap-4 mt-6">
            <div class="bg-white p-6 rounded-lg shadow-lg border-t-4 border-blue-500">
                <h4 class="font-bold text-lg mb-4">Primary Reasons for Clinic Visits</h4>
                <canvas id="pie-chart"></canvas>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg border-t-4 border-blue-500">
                <h4 class="font-bold text-lg mb-4">Most Commonly Prescribed Medications</h4>
                <canvas id="bar-chart"></canvas>
            </div>
        </div>
        
        <div class="mt-6 p-6 bg-white rounded-lg shadow-lg border-t-4 border-blue-500">
            <h4 class="font-bold text-lg mb-4">Patient Count Graph</h4>
            <canvas id="line-chart"></canvas>
        </div>
        
        <div class="text-center mt-6">
            <button class="bg-blue-900 text-white px-6 py-3 rounded-lg text-lg shadow-lg">Generate a summary report</button>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            populateFilters();
            document.getElementById("month-filter").addEventListener("change", updateReport);
            document.getElementById("year-filter").addEventListener("change", updateReport);
        });
        
        function populateFilters() {
            const monthFilter = document.getElementById("month-filter");
            const yearFilter = document.getElementById("year-filter");
            
            const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
            const currentYear = new Date().getFullYear();
            const years = Array.from({ length: 10 }, (_, i) => currentYear - i);
            
            months.forEach(month => {
                const option = document.createElement("option");
                option.value = month;
                option.textContent = month;
                monthFilter.appendChild(option);
            });
            
            years.forEach(year => {
                const option = document.createElement("option");
                option.value = year;
                option.textContent = year;
                yearFilter.appendChild(option);
            });
        }
        
        function updateReport() {
            const month = document.getElementById("month-filter").value;
            const year = document.getElementById("year-filter").value;
            
            console.log(`Fetching report data for ${month} ${year}`);
            
            // Simulate fetching data (Replace this with an AJAX call to your Laravel backend)
            const data = {
                "May 2024": { appointments: 79, patients: 52, visitors: 130 },
                "June 2024": { appointments: 85, patients: 60, visitors: 140 },
                "July 2024": { appointments: 90, patients: 70, visitors: 150 }
            };
            
            const reportData = data[`${month} ${year}`] || { appointments: 0, patients: 0, visitors: 0 };
            
            document.getElementById("appointments-count").innerText = reportData.appointments;
            document.getElementById("patients-count").innerText = reportData.patients;
            document.getElementById("visitors-count").innerText = reportData.visitors;
        }
    </script>
</x-app-layout>
