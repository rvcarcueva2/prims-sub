@php
    use Carbon\Carbon;
@endphp

<div class="flex gap-5">
    <!-- Left Side: Calendar & Pending Appointments -->
    <div class="w-3/5 bg-white shadow-lg rounded-lg p-4 mt-7">
        <div class="flex justify-center mb-4 pt-7">
            <h2 class="text-lg font-semibold">{{ $currentMonthYear }}</h2>
        </div>
        <div class="grid grid-cols-7 gap-1 text-center">
            <!-- Days of the Week -->
            @foreach(['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $day)
                <div class="font-bold text-gray-700">{{ $day }}</div>
            @endforeach
            
            <!-- Calendar Days -->
            @foreach($calendarDays as $day)
                @php
                    $carbonDate = \Carbon\Carbon::parse($day['date']);
                    $isInCurrentMonth = $carbonDate->month == $currentDate->month;
                @endphp

                <div class="relative p-2 rounded-lg cursor-pointer hover:bg-gray-200 
                    {{ !$isInCurrentMonth ? 'text-gray-400' : '' }} 
                    {{ $day['isToday'] ? 'text-blue-600' : '' }} 
                    {{ $selectedDate === $day['date'] ? 'bg-prims-yellow-5' : '' }}"
                    wire:click="selectDate('{{ $day['date'] }}')">
                    {{ $day['day'] }}

                    <!-- Red dot for pending appointments -->
                    @if($day['hasPendingAppointments'])
                        <span class="absolute top-2 right-6 w-2 h-2 bg-red-500 rounded-full"></span>
                    @endif
                </div>
            @endforeach
        </div>

        <!-- Display Selected Date Appointments -->
        @if($selectedDate && $appointments->isNotEmpty())
        <div class="mt-5">
            <h3 class="text-xl font-semibold">Pending appointments for {{ \Carbon\Carbon::parse($selectedDate)->format('F j, Y') }}</h3>

            <!-- Loop through pending appointments -->
            @foreach($appointments as $appointment)
                <div class="flex justify-between mt-3 p-2 border border-gray-200 rounded">
                    <div>
                        <!-- Display patient info if available -->
                        @if($appointment->patient)
                            <p><strong>Patient:</strong> {{ $appointment->patient->first_name }} {{ $appointment->patient->last_name }}</p>
                            <p><strong>Reason:</strong> {{ $appointment->reason_for_visit }}</p>
                            <p><strong>Time:</strong> {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('h:i A') }}</p>
                        @else
                            <p>Patient info unavailable</p>
                        @endif
                    </div>
                    <div class="flex flex-col gap-2">
                        <x-button wire:click="approveAppointment({{ $appointment->id }})" class="bg-green-500">Approve</x-button>
                        <x-button wire:click="declineAppointment({{ $appointment->id }})" class="bg-red-500">Decline</x-button>
                    </div>
                </div>
            @endforeach
        </div>
        @endif

        <div class="flex justify-center gap-3 mt-10 pb-7">
            <x-button wire:click="changeMonth(-1)" class="px-2 py-1 bg-gray-200 rounded">Previous</x-button>
            <x-button wire:click="changeMonth(1)" class="px-2 py-1 bg-gray-200 rounded">Next</x-button>
        </div>
    </div>

    <!-- Right Side: Approved Upcoming Appointments -->
    <div class="w-2/5 flex flex-col p-4 mt-7 relative overflow-hidden">
        <h3 class="text-sm">Approved Appointments as of <span class="text-red-500">{{ \Carbon\Carbon::parse($selectedDate ?? now())->format('F j, Y') }}</span></h3>
        <!-- <div class="w-2/5 bg-white shadow-lg rounded-lg"> -->

        <div wire:poll.5s="loadAppointments" class="relative mt-2 flex flex-col items-center">
            @forelse($approvedAppointments as $index => $appointment)
                <div 
                    class="w-4/5 p-3 border border-gray-200 rounded-lg bg-white shadow-md transition-all duration-300 transform 
                    mb-3 hover:scale-105"
                    wire:key="approved-{{ $appointment->id }}"
                    wire:click="expandAppointment({{ $appointment->id }})"
                >
                    <p class="text-lg"><strong>Upcoming Appointment</strong></p>
                    <p class="text-3xl pb-3"><strong>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('h:i A') }}</strong></p>
                    <p>Patient: {{ $appointment->patient->first_name }} {{ $appointment->patient->last_name }}</p>

                    <x-prims-sub-button2 class="mt-3">Start Appointment</x-prims-sub-button2>
                </div>
            @empty
                <p class="text-gray-500 mt-3">No approved appointments yet.</p>
            @endforelse
        </div>
    </div>
</div>
