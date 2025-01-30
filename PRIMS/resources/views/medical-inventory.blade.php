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
            id="searchInput"
            type="text"
            placeholder="Search"
            class="w-64 border border-gray-300 text-gray-700 px-4 py-1 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
            oninput="filterTable()"
          />
        </div>
      </div>
    </div>

    <!-- Table Wrapper -->
    <div class="bg-white rounded-b-md shadow overflow-x-auto">
      <table id="medicineTable" class="w-full table-auto">
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
          <!-- Existing rows -->
          <tr class="bg-gray-50 hover:bg-gray-100">
            <td class="px-4 py-2">000000</td>
            <td class="px-4 py-2">
              <span class="block font-semibold">Ibuprofen</span>
              <span class="block text-sm text-gray-500">Advil</span>
            </td>
            <td class="px-4 py-2">200mg/Capsule</td>
            <td class="px-4 py-2">01/01/2025</td>
            <td class="px-4 py-2">100</td>
            <td class="px-4 py-2">Each</td>
          </tr>
          <tr class="bg-white hover:bg-gray-100">
            <td class="px-4 py-2">000001</td>
            <td class="px-4 py-2">
              <span class="block font-semibold">Paracetamol</span>
              <span class="block text-sm text-gray-500">Tylenol</span>
            </td>
            <td class="px-4 py-2">500mg/Tablet</td>
            <td class="px-4 py-2">12/12/2024</td>
            <td class="px-4 py-2">200</td>
            <td class="px-4 py-2">Pack</td>
          </tr>
          <!-- 10 new rows -->
          <tr class="bg-gray-50 hover:bg-gray-100">
            <td class="px-4 py-2">000002</td>
            <td class="px-4 py-2">
              <span class="block font-semibold">Amoxicillin</span>
              <span class="block text-sm text-gray-500">Generic</span>
            </td>
            <td class="px-4 py-2">250mg/Capsule</td>
            <td class="px-4 py-2">05/15/2025</td>
            <td class="px-4 py-2">150</td>
            <td class="px-4 py-2">Bottle</td>
          </tr>
          <tr class="bg-white hover:bg-gray-100">
            <td class="px-4 py-2">000003</td>
            <td class="px-4 py-2">
              <span class="block font-semibold">Cetirizine</span>
              <span class="block text-sm text-gray-500">Zyrtec</span>
            </td>
            <td class="px-4 py-2">10mg/Tablet</td>
            <td class="px-4 py-2">07/10/2024</td>
            <td class="px-4 py-2">300</td>
            <td class="px-4 py-2">Pack</td>
          </tr>
          <tr class="bg-gray-50 hover:bg-gray-100">
            <td class="px-4 py-2">000004</td>
            <td class="px-4 py-2">
              <span class="block font-semibold">Aspirin</span>
              <span class="block text-sm text-gray-500">Bayer</span>
            </td>
            <td class="px-4 py-2">81mg/Tablet</td>
            <td class="px-4 py-2">02/20/2025</td>
            <td class="px-4 py-2">250</td>
            <td class="px-4 py-2">Box</td>
          </tr>
          <tr class="bg-white hover:bg-gray-100">
            <td class="px-4 py-2">000005</td>
            <td class="px-4 py-2">
              <span class="block font-semibold">Omeprazole</span>
              <span class="block text-sm text-gray-500">Prilosec</span>
            </td>
            <td class="px-4 py-2">20mg/Tablet</td>
            <td class="px-4 py-2">09/30/2024</td>
            <td class="px-4 py-2">180</td>
            <td class="px-4 py-2">Bottle</td>
          </tr>
          <tr class="bg-gray-50 hover:bg-gray-100">
            <td class="px-4 py-2">000006</td>
            <td class="px-4 py-2">
              <span class="block font-semibold">Loratadine</span>
              <span class="block text-sm text-gray-500">Claritin</span>
            </td>
            <td class="px-4 py-2">10mg/Tablet</td>
            <td class="px-4 py-2">11/15/2024</td>
            <td class="px-4 py-2">120</td>
            <td class="px-4 py-2">Pack</td>
          </tr>
          <tr class="bg-white hover:bg-gray-100">
            <td class="px-4 py-2">000007</td>
            <td class="px-4 py-2">
              <span class="block font-semibold">Metformin</span>
              <span class="block text-sm text-gray-500">Generic</span>
            </td>
            <td class="px-4 py-2">500mg/Tablet</td>
            <td class="px-4 py-2">04/25/2025</td>
            <td class="px-4 py-2">200</td>
            <td class="px-4 py-2">Box</td>
          </tr>
          <tr class="bg-gray-50 hover:bg-gray-100">
            <td class="px-4 py-2">000008</td>
            <td class="px-4 py-2">
              <span class="block font-semibold">Cough Syrup</span>
              <span class="block text-sm text-gray-500">Robitussin</span>
            </td>
            <td class="px-4 py-2">100ml/Bottle</td>
            <td class="px-4 py-2">03/12/2025</td>
            <td class="px-4 py-2">50</td>
            <td class="px-4 py-2">Bottle</td>
          </tr>
          <tr class="bg-white hover:bg-gray-100">
            <td class="px-4 py-2">000009</td>
            <td class="px-4 py-2">
              <span class="block font-semibold">Vitamin C</span>
              <span class="block text-sm text-gray-500">Generic</span>
            </td>
            <td class="px-4 py-2">500mg/Tablet</td>
            <td class="px-4 py-2">08/20/2024</td>
            <td class="px-4 py-2">500</td>
            <td class="px-4 py-2">Pack</td>
          </tr>
          <tr class="bg-gray-50 hover:bg-gray-100">
            <td class="px-4 py-2">000010</td>
            <td class="px-4 py-2">
              <span class="block font-semibold">Antacid</span>
              <span class="block text-sm text-gray-500">Tums</span>
            </td>
            <td class="px-4 py-2">500mg/Chewable</td>
            <td class="px-4 py-2">10/01/2024</td>
            <td class="px-4 py-2">400</td>
            <td class="px-4 py-2">Bottle</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <script>
    function filterTable() {
      const searchInput = document.getElementById("searchInput").value.toLowerCase();
      const table = document.getElementById("medicineTable");
      const rows = table.querySelectorAll("tbody tr");

      rows.forEach((row) => {
        const cells = row.querySelectorAll("td");
        let isVisible = false;

        cells.forEach((cell) => {
          if (cell.textContent.toLowerCase().includes(searchInput)) {
            isVisible = true;
          }
        });

        if (isVisible) {
          row.style.display = "";
        } else {
          row.style.display = "none";
        }
      });
    }
  </script>
</x-app-layout>
