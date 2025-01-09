<x-app-layout>
    <x-prims-sub-header>
    Appointment
    </x-prims-sub-header>

    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Calendar</title>
    <!-- Include Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    </head>

 <!-- Calendar Container -->
 <div class="max-w-lg mx-auto bg-white rounded-lg shadow-md p-6">
        <h1 class="text-xl font-bold text-center mb-4">Dynamic Calendar</h1>

        <!-- Month and Year Selection -->
        <div class="flex justify-center gap-4 mb-4">
            <select id="month-select" class="border border-gray-300 rounded-lg p-2">
                <option value="0">January</option>
                <option value="1">February</option>
                <option value="2">March</option>
                <option value="3">April</option>
                <option value="4">May</option>
                <option value="5">June</option>
                <option value="6">July</option>
                <option value="7">August</option>
                <option value="8">September</option>
                <option value="9">October</option>
                <option value="10">November</option>
                <option value="11">December</option>
            </select>
            <select id="year-select" class="border border-gray-300 rounded-lg p-2">
                <?php
                $currentYear = date('Y');
                for ($i = $currentYear - 5; $i <= $currentYear + 5; $i++) {
                    echo "<option value='$i'>$i</option>";
                }
                ?>
            </select>
        </div>
<<<<<<< HEAD
            <div class="bg-white p-6 rounded-[1rem] shadow-md">
                <div class="flex gap-4 justify-center mx-1 font-bold text-sub-header-1">
                    <select class="border-gray-300 rounded-lg text-sub-header">
                        <option>January</option>
                        <option>February</option>
                        <option>March</option>
                        <option>April</option>
                        <option>May</option>
                        <option>June</option>
                        <option>July</option>
                        <option>August</option>
                        <option>September</option>
                        <option>October</option>
                        <option>November</option>
                        <option>December</option>
                    </select>
                    <select class="border-gray-300 rounded-lg">
                        <option>2025</option>
                    </select>
                </div>
                <!-- Days -->
                <div class="grid grid-cols-7 px-4 mt-4 font-bold text-center">
                    <div class="text-red-700">Sun</div>
                    <div>Mon</div>
                    <div>Tues</div>
                    <div>Wed</div>
                    <div>Thu</div>
                    <div>Fri</div>
                    <div>Sat</div>
                </div>
                <div class="grid grid-cols-7 px-4 mt-5 text-center">
                    <div>1</div>
                    <div>2</div>
                    <div>3</div>
                    <div>4</div>
                    <div>5</div>
                    <div>6</div>
                    <div>7</div>
                 </div>
                 <div class="grid grid-cols-7 px-4 mt-3 text-center">
                    <div>8</div>
                    <div>9</div>
                    <div>10</div>
                    <div>11</div>
                    <div>12</div>
                    <div>13</div>
                    <div>14</div>
                 </div>
            </div>
        <div class="grid grid-cols-3 gap-1 items-center text-xs ml-2">
            <div class="flex justify-around mt-4">
                <div class="flex items-center text-left space-x-1.5">
                    <div class="w-4 h-4 bg-prims-yellow-1 rounded-full mr-[0.2rem]"></div>
                    <span class="text-sm">Some slots are available</span>
                </div>
            </div>
            <div class="flex justify-around mt-4">
                <div class="flex items-center space-x-1.5">
                    <div class="w-4 h-4 bg-red-600 rounded-full"></div>
                    <span class="text-sm">Fully booked</span>
                </div>
            </div>
            <div class="flex justify-around mt-4">
                <div class="flex items-center space-x-1.5">
                    <div class="w-4 h-4 bg-zinc-400 rounded-full"></div>
                    <span class="text-sm">Selected</span>
                </div>
            </div>
        </div>
=======

        <!-- Days of the Week -->
        <div class="grid grid-cols-7 gap-2 text-center font-bold text-gray-700 mb-2">
            <div class="text-red-500">Sun</div>
            <div>Mon</div>
            <div>Tues</div>
            <div>Wed</div>
            <div>Thu</div>
            <div>Fri</div>
            <div>Sat</div>
        </div>

        <!-- Calendar Days -->
        <div id="calendar-days" class="grid grid-cols-7 gap-2 text-center"></div>
>>>>>>> origin/main
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const monthSelect = document.getElementById("month-select");
            const yearSelect = document.getElementById("year-select");
            const calendarDaysContainer = document.getElementById("calendar-days");

            function generateCalendar(month, year) {
                calendarDaysContainer.innerHTML = ""; // Clear previous calendar

                const firstDay = new Date(year, month, 1).getDay();
                const daysInMonth = new Date(year, month + 1, 0).getDate();

                // Add empty slots for days before the 1st
                for (let i = 0; i < firstDay; i++) {
                    const emptyCell = document.createElement("div");
                    calendarDaysContainer.appendChild(emptyCell);
                }

                // Add days of the month
                for (let day = 1; day <= daysInMonth; day++) {
                    const dayCell = document.createElement("div");
                    dayCell.textContent = day;
                    dayCell.className = "p-2 rounded hover:bg-blue-100 cursor-pointer";
                    calendarDaysContainer.appendChild(dayCell);
                }
            }

            // Event listeners for month and year dropdowns
            monthSelect.addEventListener("change", () => {
                generateCalendar(parseInt(monthSelect.value), parseInt(yearSelect.value));
            });

            yearSelect.addEventListener("change", () => {
                generateCalendar(parseInt(monthSelect.value), parseInt(yearSelect.value));
            });

            // Generate the initial calendar for the current month and year
            const currentDate = new Date();
            monthSelect.value = currentDate.getMonth();
            yearSelect.value = currentDate.getFullYear();
            generateCalendar(currentDate.getMonth(), currentDate.getFullYear());
        });
    </script>

    <!-- Time -->
    <div class="mx-[30rem]">
        <div class="flex mt-5 mb-2 ml-2">
            <h1 class="text-xl font-bold">Choose a time</h1>
        </div>
        <div class="bg-white p-6 rounded-[1rem] shadow-md">
            <div class="flex gap-4 justify-center mx-1 font-bold text-sub-header-1">
                <select class="border-gray-300 rounded-lg">
                    <option>AM</option>
                    <option>PM</option>
                </select>
            </div>
            <div class="grid grid-cols-4 gap-4 px-4 mt-4 font-bold text-center">
                <x-prims-sub-button3 href="">9:30</x-prims-sub-button3>
                <x-prims-sub-button3 href="">10:00</x-prims-sub-button3>
                <x-prims-sub-button3 href="">10:30</x-prims-sub-button3>
                <x-prims-sub-button3 href="">11:00</x-prims-sub-button3>
            </div>
            <div class="grid grid-cols-4 gap-4 px-4 mt-4 font-bold text-center">
                <x-prims-sub-button3 href="">11:30</x-prims-sub-button3>
                <x-prims-sub-button3 href="">12:00</x-prims-sub-button3>
                <x-prims-sub-button3 href="">12:30</x-prims-sub-button3>
                <x-prims-sub-button3 href="">1:00</x-prims-sub-button3>
            </div>
        </div>
    </div>
    <x-ready-appointment>
        <h1 class="text-xl font-bold">Ready to appoint a check up?</h1>
        <x-hyperlink>No</x-hyperlink>
        <x-prims-main-button href="" class="my-6">Yes</x-prims-main-button>

        
    </x-ready-appointment>
</x-app-layout>