<x-app-layout>
    <x-prims-sub-header>
    Appointment
    </x-prims-sub-header>
    <div class="flex ml-2">
        <h1 class="text-xl font-bold">Choose a data</h1>
    </div>
    <div class="justify-center grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Date Picker -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex justify-center mb-4">
                    <select class="border-gray-300 rounded-lg p-2.5">
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
                    <select class="border-gray-300 rounded-lg p-2.5">
                        <option>2024</option>
                    </select>
                </div>
            </div>
    </div>
    <div class="flex ml-2">
        <h1 class="text-xl font-bold">Choose a time</h1>
    </div>
    <div class="flex justify-center">
        <h1 class="text-xl font-bold">Ready to appoint a check up?</h1>
    </div>
</x-app-layout>