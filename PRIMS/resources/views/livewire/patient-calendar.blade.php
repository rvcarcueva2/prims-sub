<div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-7 grid-rows-4 gap-4 justify-center m-4">
            
            <!-- Doctor Information Section -->
            <div class="col-span-2 row-span-12 bg-white rounded-md shadow-md text-center">
                <div class="p-5 mt-8">
                    <img src="/img/placeholder-pfp.png" alt="placeholder pfp" class="w-24 h-24 mx-auto">
                    <h2 class="font-bold text-xl mt-4">[Available Doctor]</h2>
                    <hr class="border-gray-300 border-2 rounded-full m-4">
                    <p class="text-gray-700 text-center mx-8">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    </p>
                </div>
            </div>

            <!-- Calendar Section -->
            <div class="col-span-5 row-span-full bg-white rounded-md shadow-md">
                <div class="flex justify-center mt-6 bg-prims-yellow-5">
                    <h1 class="text-2xl font-bold">Choose a Date</h1>
                </div>
                <div class="flex gap-4 justify-center mx-1 my-4 font-bold text-sub-header-1">
                    <select wire:model="month" wire:change="generateCalendar" class="border border-gray-300 rounded-lg px-7 py-2">
                        @foreach(range(1, 12) as $m)
                            <option value="{{ $m }}">{{ \Carbon\Carbon::create()->month($m)->format('F') }}</option>
                        @endforeach
                    </select>
                    <select wire:model="year" wire:change="generateCalendar" class="border border-gray-300 rounded-lg px-7 py-2">
                        @foreach(range(now()->year - 5, now()->year + 5) as $y)
                            <option value="{{ $y }}">{{ $y }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Days of the Week -->
                <div class="grid grid-cols-7 gap-4 text-center font-bold text-gray-700 mb-4 mx-3">
                    <div class="text-red-500">Sun</div>
                    <div>Mon</div>
                    <div>Tues</div>
                    <div>Wed</div>
                    <div>Thu</div>
                    <div>Fri</div>
                    <div>Sat</div>
                </div>

                <!-- Calendar Days -->
                <div class="grid grid-cols-7 gap-2 text-center mb-4 mx-3">
                @foreach($daysInMonth as $day)
                    @if($day)
                        <div class="p-2 rounded-lg cursor-pointer hover:bg-gray-200 
                            {{ $day['isToday'] ? 'text-blue-600' : '' }} 
                            {{ $selectedDate === $day['date'] ? 'bg-prims-yellow-5' : '' }}"
                            wire:click="selectDate({{ $day['day'] }})">
                            {{ $day['day'] }}
                        </div>
                    @else
                        <div></div>
                    @endif
                @endforeach
                </div>

            <!-- Time Selection Section -->
            <div class="col-span-5 row-span-4 bg-white rounded-md shadow-md">
                <div class="flex justify-center mt-6 bg-prims-yellow-5">
                    <h1 class="text-2xl font-bold">Choose a Time</h1>
                </div>
                <div class="grid grid-cols-4 gap-4 px-4 my-4 font-bold text-center">
                    @foreach($availableTimes as $time)
                        <button wire:click="selectTime('{{ $time }}')" 
                                class="p-2 rounded-lg cursor-pointer bg-gray-200 hover:bg-gray-300 
                                    {{ $selectedTime == $time ? 'bg-green-500 text-white' : '' }}">
                            {{ $time }}
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Submit -->
            <div class="col-span-5 row-span-4 bg-prims-yellow-1 rounded-md shadow-md p-6">
                <h1 class="text-3xl font-bold text-center mb-4">Ready to appoint a check-up?</h1>

                <label for="reason" class="block text-sm font-medium text-gray-700">Reason for Visit:</label>
                <textarea wire:model="reasonForVisit" id="reason" class="border border-gray-300 rounded-lg w-full p-2 mt-2"></textarea>

                <div class="mt-4 flex justify-center gap-4">
                    <button wire:click="submitAppointment" class="px-6 py-2 bg-green-500 text-white rounded-lg">Yes</button>
                    <button class="px-6 py-2 bg-red-500 text-white rounded-lg">No</button>
                </div>
            </div>

            @if (session()->has('success'))
                <div class="text-green-600 font-bold">{{ session('success') }}</div>
            @endif

            @if (session()->has('error'))
                <div class="text-red-600 font-bold">{{ session('error') }}</div>
            @endif

        </div>
    </div>
</div>
