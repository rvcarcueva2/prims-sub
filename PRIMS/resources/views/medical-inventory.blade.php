<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Medicine Inventory</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
  <div class="flex min-h-screen">

    <!-- Left Side Bar -->
    <div class="bg-gray-300 text-white w-64 p-4">
      <h1 class="text-2xl font-bold mb-6">PRIMS | APC CLINIC</h1>
      <nav>
        <ul>
          <li class="mb-4"><a href="#" class="hover:text-blue-900">Dashboard</a></li>
          <li class="mb-4"><a href="#" class="hover:text-blue-900">Medical Records</a></li>
          <li class="mb-4"><a href="#" class="hover:text-blue-900">Inventory / Supplies</a></li>
          <li class="mb-4"><a href="#" class="hover:text-blue-900">Calendar</a></li>
          <li class="mb-4"><a href="#" class="hover:text-blue-900">Summary Reports</a></li>
        </ul>
      </nav>
    </div>

    <!-- List -->
    <div class="flex-1 p-6">
      <header class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold">Medicine Inventory</h2>
        <div>
          <button class="bg-gray-200 px-4 py-2 rounded hover:bg-gray-300">Sort</button>
          <button class="bg-gray-200 px-4 py-2 rounded hover:bg-gray-300">Filter</button>
        </div>
      </header>

      <!-- Table -->
      <div class="overflow-x-auto bg-white rounded shadow">
        <table class="w-full text-left border-collapse">
          <thead>
            <tr class="bg-yellow-200 text-sm">
              <th class="p-3 border-b">Item ID</th>
              <th class="p-3 border-b">Name</th>
              <th class="p-3 border-b">Dosage/Form</th>
              <th class="p-3 border-b">Expiration Date</th>
              <th class="p-3 border-b">Quantity</th>
              <th class="p-3 border-b">Unit of Measurement</th>
              <th class="p-3 border-b"></th>
            </tr>
          </thead>
          <tbody>
            <!-- Row -->
            <tr class="text-sm hover:bg-gray-100">
              <td class="p-3 border-b">000000</td>
              <td class="p-3 border-b">Ibuprofen <br><span class="text-gray-500 text-xs">Advil</span></td>
              <td class="p-3 border-b">200mg/Capsule</td>
              <td class="p-3 border-b">MM/DD/YYYY</td>
              <td class="p-3 border-b">100</td>
              <td class="p-3 border-b">Each/Pack/Bottle</td>
              <td class="p-3 border-b">
                <button class="text-gray-500 hover:text-gray-700">
                  ...
                </button>
              </td>
            </tr>
            <!-- Repeat Rows -->
            <tr class="text-sm hover:bg-gray-100">
              <td class="p-3 border-b">000000</td>
              <td class="p-3 border-b">Ibuprofen <br><span class="text-gray-500 text-xs">Advil</span></td>
              <td class="p-3 border-b">200mg/Capsule</td>
              <td class="p-3 border-b">MM/DD/YYYY</td>
              <td class="p-3 border-b">100</td>
              <td class="p-3 border-b">Each/Pack/Bottle</td>
              <td class="p-3 border-b">
                <button class="text-gray-500 hover:text-gray-700">
                  ...
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
</html>
