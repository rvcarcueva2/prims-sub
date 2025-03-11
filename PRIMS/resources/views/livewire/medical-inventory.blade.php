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
                    <th class="px-4 py-2">Generic Name</th>
                    <th class="px-4 py-2">Brand</th>
                    <th class="px-4 py-2">Category</th>
                    <th class="px-4 py-2">Dosage Form</th>
                    <th class="px-4 py-2">Strength</th>
                    <th class="px-4 py-2">Date Supplied</th>
                    <th class="px-4 py-2">Expiration Date</th>
                    <th class="px-4 py-2">Quantity Received</th>
                    <th class="px-4 py-2">Remaining Stock</th>
                </tr>
            </thead>
            <tbody>

                @php
                    $groupedInventory = collect($inventory)->groupBy('supply_name')->map(function ($items) {
                        return [
                            'earliest_expiring' => $items->sortBy([
                                ['expiration_date', 'asc'],  // Sort by expiration date (earliest first)
                                ['created_at', 'asc']        // If same expiration, sort by creation date (earliest first)
                            ])->first(), // Get the first item after sorting
                            'total_remaining_stock' => $items->sum('remaining_stock') // Sum of remaining stock
                        ];
                    });
                @endphp

                @foreach ($groupedInventory as $supply_name => $data)
                    @php
                        $item = $data['earliest_expiring'];
                        $totalStock = $data['total_remaining_stock'];
                    @endphp
                    <tr class="bg-gray-50 hover:bg-gray-100 cursor-pointer text-center align-middle"
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
                                    <div class="absolute bottom-full mb-1 left-1/2 transform -translate-x-1/2 hidden group-hover:flex 
                                                bg-black text-red-300 text-xs rounded px-2 py-1 whitespace-nowrap z-50">
                                        Expired - Need to dispose
                                    </div>
                            @elseif (now()->diffInDays($item->expiration_date, false) <= 14 && now()->diffInDays($item->expiration_date, false) >= 0)
                                    <div class="absolute bottom-full mb-1 left-1/2 transform -translate-x-1/2 hidden group-hover:flex 
                                                bg-black text-yellow-300 text-xs rounded px-2 py-1 whitespace-nowrap z-50">
                                        Near Expiry ({{ round(now()->diffInDays($item->expiration_date)) }} days left)
                                    </div>
                            @endif
                        </td>
                        <td class="px-4 py-2">{{ $item->quantity_received }}</td>
                        <td class="px-4 py-2 font-semibold relative group
                            @if ($totalStock <= 25) text-red-500
                            @elseif ($totalStock <= 50) text-yellow-500
                            @endif">
                            
                            
                            {{ $item->remaining_stock }}
                                <div class="absolute bottom-full mb-1 left-1/2 transform -translate-x-1/2 hidden group-hover:flex 
                                                    bg-black text-white text-xs rounded px-2 py-1 whitespace-nowrap z-50">
                                    Total stock: {{ $totalStock }}
                                </div>

                            @if ($totalStock <= 50 && $totalStock > 25)
                                    <div class="absolute bottom-full mb-1 left-1/2 transform -translate-x-1/2 hidden group-hover:flex 
                                                bg-black text-yellow-300 text-xs rounded px-2 py-1 whitespace-nowrap z-50">
                                        Please consider reordering
                                    </div>
                            @endif
                            @if ($totalStock <= 25)
                                    <div class="absolute bottom-full mb-1 left-1/2 transform -translate-x-1/2 hidden group-hover:flex 
                                                bg-black text-red-300 text-xs rounded px-2 py-1 whitespace-nowrap z-50">
                                        Low Stock - Need to reorder
                                    </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if (session()->has('dispose-message'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
            wire:ignore 
            class="bg-green-500 text-white px-4 py-2 rounded-md mb-4 transition-opacity duration-500 ease-in-out">
            {{ session('dispose-message') }}
        </div>
    @endif

    @if (session()->has('batch_deleted_no-stock'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
            wire:ignore 
            class="bg-red-500 text-white px-4 py-2 rounded-md mb-4 transition-opacity duration-500 ease-in-out">
            {{ session('batch_deleted_no-stock') }}
        </div>
    @endif

    <!-- Out-of-Stock Supplies Section (Collapsible) -->
    <div x-data="{ open: false }" class="mt-6">
        <button @click="open = !open"
            class="bg-red-900 text-white px-4 py-2 rounded-md flex items-center w-full">
            <span class="mr-2" x-text="open ? '+' : '-'"></span> 
            <h2 class="text-gray-100 font-semibold text-xl">Out-of-Stock Supplies</h2>
        </button>

        <div x-show="open" class="bg-white rounded-b-md shadow overflow-x-auto mt-2">
            <table class="w-full table-auto">
                <thead class="bg-red-500 text-white">
                    <tr>
                        <th class="px-4 py-2">Generic Name</th>
                        <th class="px-4 py-2">Brand</th>
                        <th class="px-4 py-2">Category</th>
                        <th class="px-4 py-2">Dosage Form</th>
                        <th class="px-4 py-2">Strength</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $outOfStock = collect($inventory)->filter(fn($item) => $item->remaining_stock == 0);
                    @endphp

                    @foreach ($outOfStock as $item)
                        <tr class="bg-gray-50 hover:bg-gray-100 text-center align-middle">
                            <td class="px-4 py-2">{{ $item->supply_name }}</td>
                            <td class="px-4 py-2">{{ $item->brand ?? 'N/A' }}</td>
                            <td class="px-4 py-2">{{ $item->category }}</td>
                            <td class="px-4 py-2">{{ $item->dosage_form }}</td>
                            <td class="px-4 py-2">{{ $item->dosage_strength }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

