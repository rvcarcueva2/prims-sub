<x-app-layout>
    <x-prims-sub-header>
    Medical Records
    </x-prims-sub-header>
    <div class="p-6">
    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table id="recordsTable" class="w-full min-w-full divide-y divide-gray-200">
            <thead style="background-color: #FFF9DB;">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1">
                        <input id="selectAll" type="checkbox" class="h-4 w-4 text-indigo-600 border-gray-300 rounded">
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Item ID / Name
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Last Name
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        First Name
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Last Visited
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <!-- Placeholder for dynamic rows -->
            </tbody>
        </table>
    </div>
    <div class="mt-4 flex gap-6">
            <a href="/staff/add-record">
        <button id="addRecordButton" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
            Add Record
        </button>
            </a>
        <button id="deleteSelectedButton" class="text-red-600 hover:text-red-700">
            Delete All Selected
        </button>
    </div>
</x-app-layout>