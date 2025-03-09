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
                    <td class="px-4 py-2">{{ $currentBatch->quantity_remaining }}</td>
                </tr>
            </tbody>
        </table>
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
                        <td class="px-4 py-2">{{ $batch->quantity_remaining }}</td>
                    </tr>
                @endforeach
                @if ($otherBatches->isEmpty())
                    <tr>
                        <td class="px-4 py-2 text-center" colspan="9">No other batches in stock</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
