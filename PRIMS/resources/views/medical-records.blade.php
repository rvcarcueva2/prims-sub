<x-app-layout>
    <x-prims-sub-header>
    Appointment
    </x-prims-sub-header>

    
    <div class="grid grid-cols-7 grid-rows-4 gap-4 justify-center m-4 ">
        <div class="col-span-2 row-span-12 bg-white rounded-md shadow-md justify-center text-center">
            <div class="p-5 mt-4">
                <div class="w-25 h-25">
                    <img src="img/placeholder-pfp.png" class="inline-block align-middle bg-transparent">
                </div>
                <h2 class="font-bold text-xl mt-4">[Dr./Nurse's Name]</h2>
                <hr class="border-gray-300 border-2 rounded-full m-4">
                <p class="text-gray-700 text-center my-4 mx-8">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate pharetra metus.
                </p>
            </div>
        </div>
            <div class="col-span-5 row-span-full bg-white rounded-md shadow-md">
                <div class="flex justify-center mt-6 bg-prims-yellow-5">
                    <h1 class="text-2xl font-bold">Choose a Date</h1>
                </div>
                <div class="flex gap-4 justify-center mx-1 my-4 font-bold text-sub-header-1">
                    <select id="month-select" class="border relative border-gray-300 rounded-lg px-7 py-2">
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
                    <select id="year-select" class="border border-gray-300 rounded-lg px-7 py-2">
                        <?php
                        $currentYear = date('Y');
                        for ($i = $currentYear - 5; $i <= $currentYear + 5; $i++) {
                            echo "<option value='$i'>$i</option>";
                        }
                        ?>
                    </select>
                </div>
                <!-- Days of the Week -->
                <div class="grid grid-cols-7 gap-4 text-center font-bold text-gray-700 mb-4">
                    <div class="text-red-500">Sun</div>
                    <div>Mon</div>
                    <div>Tues</div>
                    <div>Wed</div>
                    <div>Thu</div>
                    <div>Fri</div>
                    <div>Sat</div>
                </div>
                <!-- Calendar Days -->
                <div id="calendar-days" class="grid grid-cols-7 gap-2 text-center mb-3"></div>
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

            <div class="col-span-5 row-span-4 bg-white rounded-md shadow-md">
                <div class="flex justify-center mt-6 bg-prims-yellow-5">
                    <h1 class="text-2xl font-bold">Choose a Time</h1>
                </div>
                    <div class="p-3">
                        <div class="flex gap-4 justify-center mx-2 font-bold text-sub-header-1">
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
                        <x-prims-sub-button3 href="">More...</x-prims-sub-button3>
                    </div>
                </div>
            </div>
            <div class="col-span-5 row-span-4 bg-prims-yellow-1 rounded-md shadow-md">
                <div class="flex gap-4 justify-center font-bold text-sub-header-1">
                    <div class="relative flex flex-row items-center">
                        <h1 class="text-3xl font-bold">Ready to appoint a check up?</h1>
                        <x-hyperlink>No</x-hyperlink>
                        <x-prims-sub-button5 href="" class="my-5">Yes</x-prims-sub-button5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>