<div class="flex-1 p-6">
    <div class="bg-blue-900 text-white p-2 rounded-md mb-6">
        <div class="flex justify-between items-center">
            <h2 class="text-gray-100 font-semibold text-xl">Medicine Inventory</h2>

            <div class="flex items-center space-x-4">
                <div x-data="{ open: false }" class="relative inline-block">
                    <!-- Main Sort Button -->
                    <button @click="open = !open" class="bg-white text-gray-700 border border-gray-300 px-4 py-1 rounded">
                        Sort
                    </button>

                    <!-- Dropdown Options -->
                    <div x-show="open" @click.away="open = false" class="absolute bg-white shadow-md rounded-lg mt-2 w-48">
                        <button wire:click="sortBy('supplies.name')" class="text-black block w-full px-4 py-2 text-left hover:bg-gray-200">
                            Sort Alphabetically
                        </button>
                        <button wire:click="sortBy('expiration_date')" class="text-black block w-full px-4 py-2 text-left hover:bg-gray-200">
                            Sort by Expiration
                        </button>
                        <button wire:click="sortBy('quantity_received')" class="text-black block w-full px-4 py-2 text-left hover:bg-gray-200">
                            Sort by Quantity
                        </button>
                    </div>
                </div>

                <button class="bg-white text-gray-700 border border-gray-300 px-4 py-1 rounded" 
                    onclick="window.location.href='{{ route('add-medicine') }}'">
                    Add
                </button>

                <input wire:model.live="search" type="text" placeholder="Search" 
                    class="w-64 border border-gray-300 text-gray-700 px-4 py-1 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>
        </div>
    </div>

    <div class="bg-white rounded-b-md shadow overflow-x-auto">
        <table class="w-full table-auto">
            <thead class="bg-yellow-500 text-black">
                <tr>                    
                    <th class="px-4 py-2 text-left">Generic Name</th>
                    <th class="px-4 py-2 text-left">Brand</th>
                    <th class="px-4 py-2 text-left">Category</th>
                    <th class="px-4 py-2 text-left">Dosage Form</th>
                    <th class="px-4 py-2 text-left">Strength</th>
                    <th class="px-4 py-2 text-left">Date Supplied</th>
                    <th class="px-4 py-2 text-left">Expiration Date</th>
                    <th class="px-4 py-2 text-left">Quantity Received</th>
                    <th class="px-4 py-2 text-left">Remaining Stock</th>
                </tr>
            </thead>
            <tbody>

                @php
                    // Group items by unique key and get the one with the earliest expiration date
                    $groupedInventory = collect($inventory)->groupBy(function ($item) {
                        return $item->supply_name . '|' . $item->brand . '|' . $item->category . '|' . $item->dosage_strength . '|' . $item->dosage_form;
                    })->map(function ($items) {
                        return $items->sortBy('expiration_date')->first(); // Get the earliest expiration date
                    });
                @endphp

                @foreach ($groupedInventory as $item)
                    <tr class="bg-gray-50 hover:bg-gray-100 cursor-pointer"
                        onclick="window.location.href='{{ route('inventory.show', ['id' => $item->id]) }}'">
                        <td class="px-4 py-2">{{ $item->supply_name }}</td>
                        <td class="px-4 py-2">{{ $item->brand ?? 'N/A' }}</td>
                        <td class="px-4 py-2">{{ $item->category }}</td>
                        <td class="px-4 py-2">{{ $item->dosage_form }}</td>
                        <td class="px-4 py-2">{{ $item->dosage_strength }}</td>
                        <td class="px-4 py-2">{{ $item->date_supplied }}</td>
                        <td class="relative group px-4 py-2 
                            {{ now()->diffInDays($item->expiration_date, false) <= 14 && now()->diffInDays($item->expiration_date, false) >= 0 ? 'text-yellow-500 font-semibold' : '' }} 
                            {{ \Carbon\Carbon::parse($item->expiration_date)->isPast() ? 'text-red-500 font-bold' : '' }}">

                            {{ $item->expiration_date ?? 'N/A' }}

                            @if (\Carbon\Carbon::parse($item->expiration_date)->isPast())
                                <span class="cursor-pointer" wire:click="confirmDisposal({{ $item->id }})">
                                    🚫
                                    <div class="absolute bottom-full mb-1 left-1/2 transform -translate-x-1/2 hidden group-hover:flex 
                                                bg-black text-white text-xs rounded px-2 py-1 whitespace-nowrap z-50">
                                        Expired - Click to dispose
                                    </div>
                                </span>
                            @elseif (now()->diffInDays($item->expiration_date, false) <= 14 && now()->diffInDays($item->expiration_date, false) >= 0)
                                <span class="relative group">
                                    ⚠️
                                    <div class="absolute bottom-full mb-1 left-1/2 transform -translate-x-1/2 hidden group-hover:flex 
                                                bg-black text-white text-xs rounded px-2 py-1 whitespace-nowrap z-50">
                                        Near Expiry ({{ round(now()->diffInDays($item->expiration_date)) }} days left)
                                    </div>
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-2">{{ $item->quantity_received }}</td>
                        <td class="px-4 py-2 {{ $item->remaining_stock <= 5 ? 'bg-orange-200 text-black font-semibold' : '' }}">
                            {{ $item->remaining_stock }}
                            @if ($item->remaining_stock <= 5)
                                <span class="text-black font-bold">⚠️</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

