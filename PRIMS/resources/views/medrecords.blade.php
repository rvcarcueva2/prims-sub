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
                        Item ID
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
    <button id="addRecordButton" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
        Add Record
    </button>
    <button id="deleteSelectedButton" class="text-red-600 hover:text-red-700">
        Delete All Selected
    </button>
</div>


<script>
    document.getElementById('addRecordButton').addEventListener('click', function() {
        const tableBody = document.querySelector('#recordsTable tbody');
        const newRow = document.createElement('tr');

        newRow.innerHTML = `
            <td class="px-6 py-4">
                <input type="checkbox" class="record-checkbox h-4 w-4 text-indigo-600 border-gray-300 rounded">
            </td>
            <td class="px-6 py-4 text-sm text-gray-900">2000-000000</td>
            <td class="px-6 py-4 text-sm text-gray-900">TESTLNAME</td>
            <td class="px-6 py-4 text-sm text-gray-900">TESTFNAME</td>
            <td class="px-6 py-4 text-sm text-gray-900">MM/DD/YYYY</td>
            <td class="px-6 py-4 text-sm text-indigo-600 hover:underline cursor-pointer">Details</td>
        `;

        tableBody.appendChild(newRow);
    });

    document.getElementById('deleteSelectedButton').addEventListener('click', function() {
        const checkboxes = document.querySelectorAll('#recordsTable .record-checkbox:checked');
        checkboxes.forEach(checkbox => {
            checkbox.closest('tr').remove();
        });
    });

    document.getElementById('selectAll').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('#recordsTable .record-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });
</script>

</x-app-layout>