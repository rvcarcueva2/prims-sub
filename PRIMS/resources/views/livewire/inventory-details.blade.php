@php
    $currentBatch = $inventory->supply->inventory->sortBy('expiration_date')->first();

    $otherBatches = $inventory->supply->inventory->where('id', '!=', $currentBatch->id)->sortBy('expiration_date');
@endphp

<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg mt-5">
    <div class="p-6 lg:p-8 gap-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700 flex flex-wrap justify-start">
        <div class="grid grid-cols-2 grid-rows-2 gap-2 w-full">
            <div>
                <p class="font-bold">Generic Name:</p>
                <p>:: {{ $inventory->supply->name }}</p>
            </div>
            <div>
                <p class="font-bold">Category:</p>
                <p>:: {{ $inventory->supply->category }}</p>
            </div>
            <div>
                <p class="font-bold">Brand Name:</p>
                <p>:: {{ $inventory->supply->brand }}</p>
            </div>
            <div>
                <p class="font-bold">Dosage Form & Strength:</p>
                <p>:: {{ $inventory->supply->dosage_form }} {{ $inventory->supply->dosage_strength }}</p>
            </div>
        </div>
    </div>

    <!-- CURRENT BATCH IN USE -->
    <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700 flex flex-wrap justify-start">
        <div class="mx-auto">    
            <span class="text-lg font-bold uppercase">Current Batch In  Use</span>
        </div>
        <table class="w-full bg-white border border-gray-200 rounded-lg shadow-lg">
            <thead class="bg-prims-yellow-5 text-prims-blue-500 ">
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
                <tr class="text-center align-middle">
                    <td class="px-4 py-2">{{ $currentBatch->supply->name }}</td>
                    <td class="px-4 py-2">{{ $currentBatch->supply->brand }}</td>
                    <td class="px-4 py-2">{{ $currentBatch->supply->category }}</td>
                    <td class="px-4 py-2">{{ $currentBatch->supply->dosage_form }}</td>
                    <td class="px-4 py-2">{{ $currentBatch->supply->dosage_strength }}</td>
                    <td class="px-4 py-2">{{ $currentBatch->date_supplied }}</td>
                    <td class="px-4 py-2">{{ $currentBatch->expiration_date }}</td>
                    <td class="px-4 py-2">{{ $currentBatch->quantity_received }}</td>
                    <td class="px-4 py-2">{{ $currentBatch->quantity_received - $currentBatch->dispensed->sum('quantity_dispensed') }}
                </tr>
            </tbody>
        </table>
        <div class="p-6 lg:p-8">
            <div class="flex justify-end space-x-4">
                <!-- Dispose Button -->
                <button wire:click="openDisposeModal" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                    Dispose
                </button>

                @if ($showDisposeModal)
                    <div class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
                        <div class="bg-white p-6 rounded shadow-lg">
                            <h2 class="text-lg font-bold mb-4">Confirm Disposal</h2>
                            <p>Are you sure you want to dispose of this medicine? This action cannot be undone.</p>

                            <div class="mt-4 flex justify-end space-x-2">
                                <button wire:click="confirmDispose" class="bg-red-600 text-white px-4 py-2 rounded">Confirm</button>
                                <button wire:click="$set('showDisposeModal', false)" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Dispense Button -->
                <button wire:click="openDispenseModal" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    Dispense to Patient
                </button>

                @if ($showDispenseModal)
                    <div class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
                        <div class="bg-white p-6 rounded shadow-lg">
                            <h2 class="text-lg font-bold mb-4">Dispense Medicine</h2>

                            <label class="block mb-2">APC ID Number</label>
                            <input type="text" wire:model.live="patientId" class="w-full border p-2 rounded">
                            
                            <!-- Display patient details dynamically -->
                            <div class="mt-2">
                                @if ($selectedPatient)
                                    <p class="text-green-600 font-semibold">{{ $selectedPatient->first_name }} {{ $selectedPatient->middle_initial}}. {{ $selectedPatient->last_name }}</p>
                                    <p class="text-gray-500">{{ $selectedPatient->email }}</p>
                                @else
                                    <p class="text-red-600">No patient with that ID</p>
                                @endif
                            </div>

                            <label class="block mb-2 mt-4">Amount to Dispense</label>
                            <input type="number" wire:model="amountDispensed" class="w-full border p-2 rounded">

                            <div class="mt-4 flex justify-end space-x-2">
                                <button wire:click="dispense" class="bg-blue-600 text-white px-4 py-2 rounded" 
                                    @if (!$selectedPatient) disabled @endif>
                                    Confirm
                                </button>
                                <button wire:click="closeDispenseModal" class="bg-gray-500 text-white px-4 py-2 rounded">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>

    <!-- OTHER BATCH/ES IN STOCK -->
    <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700 flex flex-wrap justify-start">
        <div class="mx-auto">    
            <span class="text-lg font-bold uppercase">Batch/es in Stock</span>
        </div>
        <table class="w-full bg-white border border-gray-200 rounded-lg shadow-lg">
            <thead class="bg-gray-200 text-prims-blue-500 ">
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
                @foreach ($otherBatches as $batch)
                    <tr class="text-center align-middle">
                        <td class="px-4 py-2">{{ $batch->supply->name }}</td>
                        <td class="px-4 py-2">{{ $batch->supply->brand }}</td>
                        <td class="px-4 py-2">{{ $batch->supply->category }}</td>
                        <td class="px-4 py-2">{{ $batch->supply->dosage_form }}</td>
                        <td class="px-4 py-2">{{ $batch->supply->dosage_strength }}</td>
                        <td class="px-4 py-2">{{ $batch->date_supplied }}</td>
                        <td class="px-4 py-2">{{ $batch->expiration_date }}</td>
                        <td class="px-4 py-2">{{ $batch->quantity_received }}</td>
                        <td class="px-4 py-2">{{ $batch->quantity_received - $batch->dispensed->sum('quantity_dispensed') }}</td>
                    </tr>
                @endforeach
                @if ($otherBatches->isEmpty())
                    <tr>
                        <td class="px-4 py-2 text-center" colspan="9"><em>No other batches in stock</em></td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
