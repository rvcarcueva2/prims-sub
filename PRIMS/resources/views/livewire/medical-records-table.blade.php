<div class="p-6">
    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table id="recordsTable" class="w-full min-w-full divide-y divide-gray-200">
            <thead style="background-color: #F4BF4F;">
                <tr>
                    <th class="px-6 py-3 text-left text-sm uppercase tracking-wider w-1">
                        <input id="selectAll" type="checkbox" class="h-4 w-4 text-indigo-600 border-gray-300 rounded">
                    </th>
                    <th class="px-6 py-3 text-left text-sm uppercase tracking-wider">
                        APC ID Number
                    </th>
                    <th class="px-6 py-3 text-left text-sm uppercase tracking-wider">
                        Last Name
                    </th>
                    <th class="px-6 py-3 text-left text-sm uppercase tracking-wider">
                        First Name
                    </th>
                    <th class="px-6 py-3 text-center text-sm uppercase tracking-wider">
                        Middle Initial
                    </th>
                    <th class="px-6 py-3 text-left text-sm uppercase tracking-wider">
                        Email
                    </th>
                    <th class="px-6 py-3 text-left text-sm uppercase tracking-wider">
                        Last Visited
                    </th>
                    <th class="px-6 py-3 text-left text-sm uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($records as $record)
                    <tr>
                        <td>
                            <input type="checkbox" class="ml-6 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                        </td>
                        <td class="px-6 py-3 text-left text-md">{{ $record->apc_id_number }}</td>
                        <td class="px-6 py-3 text-left text-md">{{ $record->last_name }}</td>
                        <td class="px-6 py-3 text-left text-md">{{ $record->first_name }}</td>
                        <td class="px-6 py-3 text-left text-md text-center">{{ $record->mi }}</td>
                        <td class="px-6 py-3 text-left text-md">{{ $record->email }}</td>
                        <td class="px-6 py-3 text-left text-md">{{ $record->last_visited }}</td>
                        <td>
                            <a href="{{ route('view-medical-record', ['id' => $record->id]) }}" class="ml-6">
                                <button class="px-4 py-1 bg-prims-azure-500 text-white rounded-lg hover:bg-prims-azure-100">
                                    View
                                </button>
                            </a>
                            @livewire('archive-medical-record', ['record' => $record->id])
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div class="mt-4 flex gap-6">
        <a href="/staff/add-record">
            <button id="addRecordButton" class="px-4 py-2 bg-prims-azure-500 text-white rounded-lg hover:bg-prims-azure-100">
                Add Record
            </button>
        </a>
        <!-- <button id="deleteSelectedButton" class="text-red-600 hover:text-red-700">
            Delete All Selected
        </button> -->
    </div>
</div>
