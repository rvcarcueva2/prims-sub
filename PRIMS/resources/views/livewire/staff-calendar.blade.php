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
     
                $isInCurrentMonth = \Carbon\Carbon::parse($day['date'])->month == $currentDate->month;
            @endphp

            <div class="p-2 rounded-lg cursor-pointer hover:bg-gray-200 
                {{ !$isInCurrentMonth ? 'text-gray-400' : '' }} 
                {{ $day['isToday'] ? 'text-blue-600' : '' }} 
                {{ $selectedDate === $day['date'] ? 'bg-prims-yellow-5' : '' }}"
                wire:click="selectDate('{{ $day['date'] }}')">
                {{ $day['day'] }}
            </div>
        @endforeach
    </div>
    <div class="flex justify-center gap-3 mt-10 pb-7">
        <x-button wire:click="changeMonth(-1)" class="px-2 py-1 bg-gray-200 rounded">Previous</x-button>
        <x-button wire:click="changeMonth(1)" class="px-2 py-1 bg-gray-200 rounded">Next</x-button>
    </div>
</div>
