@section('title', 'PRIMS · Appointment History')

<x-app-layout>
    
    <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <x-prims-sub-header>Appointment History</x-prims-sub-header>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg mt-5">
                    <div class="p-6 lg:p-8 gap-6 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700 flex flex-wrap justify-around">
                        <!-- left - picture -->
                        <div>
                            <img src="img/appointment-history/temp-id-pic.jpg" class="max-h-44 inline-block align-middle">
                        </div>
                        <!-- center - personal details -->
                        <div class="flex flex-col">
                            <!-- name -->
                            <div class="text-2xl pb-5">
                                <strong>{{ Auth::user()->name }}</strong>
                            </div>
                            <div class="flex justify-between gap-3 flex-wrap">
                                <div class="flex flex-col gap-3">
                                    <!-- student number -->
                                    <div class="text-sm flex flex-row align-center gap-2">
                                        <img src="img/appointment-history/id-number-icon.svg" class="max-h-20">
                                        <span>2022-187311</span>
                                    </div>
                                    <!-- contact number -->
                                    <div class="text-sm flex flex-row align-center gap-2">
                                        <img src="img/appointment-history/contact-number-icon.svg" class="max-h-20">
                                        <span>09752986539</span>
                                    </div>
                                    
                                </div>
                                <div class="flex flex-col gap-3 max-w-[70%]">
                                    <!-- email -->
                                    <div class="text-sm flex flex-row align-center gap-2 break-all">
                                        <img src="img/appointment-history/email-icon.svg" class="max-h-20">
                                        <span>{{ Auth::user()->email }}</span>
                                    </div>
                                    <!-- address -->
                                    <div class="text-sm flex flex-row align-center gap-2 break-words">
                                        <img src="img/appointment-history/address-icon.svg" class="max-h-20">
                                        <span>1234 Taft Avenue, Malate, Manila, Philippines long long long long long long long long </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- right - appointments -->
                        <div>
                            <div class="flex flex-col gap-3">
                                <span><strong>Upcoming Appointment:</strong></span>
                                <span class="text-sm">[date] - [start_time] to [end_time]</span>
                                <span class="text-sm">January 5, 2027 - 1:45 to 2:30</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="max-w-7xl mx-auto mt-5 sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                    <div class="p-6 lg:p-8 gap-6 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                        <div class="justify-between flex items-end">
                            <span>Total: </span>
                            <div>
                                <x-prims-sub-button2>Create New Appointment</x-prims-sub-button2>
                                <x-prims-sub-button2>Request Medical Record</x-prims-sub-button2>
                            </div>
                        </div>
                        <div class="overflow-x-auto py-4">
                            <table class="w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg">
                                <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                                    <tr>
                                        <th class="text-left px-6 py-3 text-sm font-medium uppercase border-b dark:border-gray-600">#</th>
                                        <th class="text-left px-6 py-3 text-sm font-medium uppercase border-b dark:border-gray-600">Student Number</th>
                                        <th class="text-left px-6 py-3 text-sm font-medium uppercase border-b dark:border-gray-600">Date</th>
                                        <th class="text-left px-6 py-3 text-sm font-medium uppercase border-b dark:border-gray-600">Time</th>
                                        <th class="text-left px-6 py-3 text-sm font-medium uppercase border-b dark:border-gray-600">Nurse/Doctor</th>
                                        <th class="text-left px-6 py-3 text-sm font-medium uppercase border-b dark:border-gray-600">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-700 dark:text-gray-300">
                                    @foreach ($appointmentHistory as $appointment)
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <td class="px-6 py-4 border-b dark:border-gray-600">{{ $appointment->id }}</td>
                                            <td class="px-6 py-4 border-b dark:border-gray-600">{{ $appointment->student_number }}</td>
                                            <td class="px-6 py-4 border-b dark:border-gray-600">{{ $appointment->date }}</td>
                                            <td class="px-6 py-4 border-b dark:border-gray-600">{{ $appointment->time }}</td>
                                            <td class="px-6 py-4 border-b dark:border-gray-600">{{ $appointment->nurse_doctor }}</td>
                                            <td class="px-6 py-4 border-b dark:border-gray-600">
                                                <span class="px-3 py-1 text-xs font-semibold">{{ $appointment->status }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
</x-app-layout>