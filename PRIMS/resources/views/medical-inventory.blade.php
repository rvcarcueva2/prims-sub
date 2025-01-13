<x-app-layout>

  <!-- Main Content Area -->
  <div class="flex-1 p-6">
    <!-- Blue Header for Medicine Inventory, Sort, Filter, and Search -->
    <div class="bg-blue-900 text-white p-2 rounded-md mb-6">
      <div class="flex justify-between items-center">
        <h2 class="text-gray-100 font-semibold text-xl">Medicine Inventory</h2>

        <!-- Sort, Filter, and Search Section -->
        <div class="flex items-center space-x-4">
          <button class="bg-white text-gray-700 border border-gray-300 px-4 py-1 rounded">
            Sort
          </button>
          <button class="bg-white text-gray-700 border border-gray-300 px-4 py-1 rounded">
            Filter
          </button>
          <input
            type="text"
            placeholder="Search"
            class="w-64 border border-gray-300 text-gray-700 px-4 py-1 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
        </div>
      </div>
    </div>

    <!-- Table Wrapper -->
    <div class="bg-white rounded-b-md shadow overflow-x-auto">
      <table class="w-full table-auto">
        <thead class="bg-yellow-500 text-black">
          <tr>
            <th class="px-4 py-2 text-left">Item ID</th>
            <th class="px-4 py-2 text-left">Name</th>
            <th class="px-4 py-2 text-left">Dosage/Form</th>
            <th class="px-4 py-2 text-left">Expiration Date</th>
            <th class="px-4 py-2 text-left">Quantity</th>
            <th class="px-4 py-2 text-left">Unit of Measurement</th>
          </tr>
        </thead>
        <tbody>
          <tr class="bg-gray-50 hover:bg-gray-100">
            <td class="px-4 py-2">000000</td>
            <td class="px-4 py-2">
              <span class="block font-semibold">Ibuprofen</span>
              <span class="block text-sm text-gray-500">Advil</span>
            </td>
            <td class="px-4 py-2">200mg/Capsule</td>
            <td class="px-4 py-2">MM/DD/YYYY</td>
            <td class="px-4 py-2">100</td>
            <td class="px-4 py-2">Each/Pack/Bottle</td>
          </tr>
          <tr class="bg-white hover:bg-gray-100">
            <td class="px-4 py-2">000001</td>
            <td class="px-4 py-2">
              <span class="block font-semibold">Ibuprofen</span>
              <span class="block text-sm text-gray-500">Advil</span>
            </td>
            <td class="px-4 py-2">200mg/Capsule</td>
            <td class="px-4 py-2">MM/DD/YYYY</td>
            <td class="px-4 py-2">100</td>
            <td class="px-4 py-2">Each/Pack/Bottle</td>
          </tr>
          <tr class="bg-white hover:bg-gray-100">
            <td class="px-4 py-2">000002</td>
            <td class="px-4 py-2">
              <span class="block font-semibold">Ibuprofen</span>
              <span class="block text-sm text-gray-500">Advil</span>
            </td>
            <td class="px-4 py-2">200mg/Capsule</td>
            <td class="px-4 py-2">MM/DD/YYYY</td>
            <td class="px-4 py-2">100</td>
            <td class="px-4 py-2">Each/Pack/Bottle</td>
          </tr>
          <tr class="bg-white hover:bg-gray-100">
            <td class="px-4 py-2">000003</td>
            <td class="px-4 py-2">
              <span class="block font-semibold">Ibuprofen</span>
              <span class="block text-sm text-gray-500">Advil</span>
            </td>
            <td class="px-4 py-2">200mg/Capsule</td>
            <td class="px-4 py-2">MM/DD/YYYY</td>
            <td class="px-4 py-2">100</td>
            <td class="px-4 py-2">Each/Pack/Bottle</td>
          </tr>
          <tr class="bg-white hover:bg-gray-100">
            <td class="px-4 py-2">000004</td>
            <td class="px-4 py-2">
              <span class="block font-semibold">Ibuprofen</span>
              <span class="block text-sm text-gray-500">Advil</span>
            </td>
            <td class="px-4 py-2">200mg/Capsule</td>
            <td class="px-4 py-2">MM/DD/YYYY</td>
            <td class="px-4 py-2">100</td>
            <td class="px-4 py-2">Each/Pack/Bottle</td>
          </tr>
          <tr class="bg-white hover:bg-gray-100">
            <td class="px-4 py-2">000005</td>
            <td class="px-4 py-2">
              <span class="block font-semibold">Ibuprofen</span>
              <span class="block text-sm text-gray-500">Advil</span>
            </td>
            <td class="px-4 py-2">200mg/Capsule</td>
            <td class="px-4 py-2">MM/DD/YYYY</td>
            <td class="px-4 py-2">100</td>
            <td class="px-4 py-2">Each/Pack/Bottle</td>
            <tr class="bg-white hover:bg-gray-100">
            <td class="px-4 py-2">000006</td>
            <td class="px-4 py-2">
              <span class="block font-semibold">Ibuprofen</span>
              <span class="block text-sm text-gray-500">Advil</span>
            </td>
            <td class="px-4 py-2">200mg/Capsule</td>
            <td class="px-4 py-2">MM/DD/YYYY</td>
            <td class="px-4 py-2">100</td>
            <td class="px-4 py-2">Each/Pack/Bottle</td>
          </tr>
          <tr class="bg-white hover:bg-gray-100">
            <td class="px-4 py-2">000007</td>
            <td class="px-4 py-2">
              <span class="block font-semibold">Ibuprofen</span>
              <span class="block text-sm text-gray-500">Advil</span>
            </td>
            <td class="px-4 py-2">200mg/Capsule</td>
            <td class="px-4 py-2">MM/DD/YYYY</td>
            <td class="px-4 py-2">100</td>
            <td class="px-4 py-2">Each/Pack/Bottle</td>
            <tr class="bg-white hover:bg-gray-100">
            <td class="px-4 py-2">000008</td>
            <td class="px-4 py-2">
              <span class="block font-semibold">Ibuprofen</span>
              <span class="block text-sm text-gray-500">Advil</span>
            </td>
            <td class="px-4 py-2">200mg/Capsule</td>
            <td class="px-4 py-2">MM/DD/YYYY</td>
            <td class="px-4 py-2">100</td>
            <td class="px-4 py-2">Each/Pack/Bottle</td>
            <tr class="bg-white hover:bg-gray-100">
            <td class="px-4 py-2">000009</td>
            <td class="px-4 py-2">
              <span class="block font-semibold">Ibuprofen</span>
              <span class="block text-sm text-gray-500">Advil</span>
            </td>
            <td class="px-4 py-2">200mg/Capsule</td>
            <td class="px-4 py-2">MM/DD/YYYY</td>
            <td class="px-4 py-2">100</td>
            <td class="px-4 py-2">Each/Pack/Bottle</td>
          </tr>
          </tr>
          </tr>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

</x-app-layout>
