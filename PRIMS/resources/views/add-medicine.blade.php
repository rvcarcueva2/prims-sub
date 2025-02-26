<x-app-layout>
<head>
<div class="flex-1 p-6">
    <title>Add Medicine</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            text-align: center;
        }
        .header {
            background-color: #1f3a93;
            color: white;
            padding: 10px;
            font-size: 18px;
            margin-bottom: 40px;
            width: 50%;
            margin-left: auto;
            margin-right: auto;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .container {
            width: 50%;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        .form-section {
            background-color: #f4b042;
            padding: 20px;
            border-radius: 8px;
            position: relative;
        }
        .form-header {
            background-color: #f4c067;
            padding: 10px;
            font-weight: bold;
            border-radius: 8px;
            width: 100%;
            display: inline-block;
        }
        .form-group {
            margin: 10px 0;
            text-align: left;
        }
        .form-group label {
            display: block;
            font-weight: bold;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .button-container {
            margin-top: 15px;
        }
        .button {
            background-color: #1f3a93;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .cancel {
            background-color: #666;
        }
    </style>
</head>
<body>
    <div class="header">Add Medicine Sheet</div>
    <div class="container">
        <form action="{{ route('inventory.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" placeholder="Medicine Name" required>
            </div>
            <div class="form-group">
                <label for="brand">Brand:</label>
                <input type="text" id="brand" name="brand" placeholder="e.g., Biogesic">
            </div>
            <div class="form-group">
                <label for="category">Category:</label>
                <input type="text" id="category" name="category" placeholder="e.g., Pain Reliever" required>
            </div>
            <div class="form-group">
                <label for="unit">Unit of Measurement:</label>
                <input type="text" id="unit" name="unit" placeholder="Each/Pack/Bottle" required>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity Received:</label>
                <input type="number" id="quantity" name="quantity_received" value="100" required>
            </div>
            <div class="form-group">
                <label for="date_supplied">Date Supplied:</label>
                <input type="date" id="date_supplied" name="date_supplied" required>
            </div>
            <div class="form-group">
                <label for="expiration">Expiration Date (Optional):</label>
                <input type="date" id="expiration" name="expiration_date">
            </div>
            <div class="button-container">
                <button class="button cancel" onclick="window.location.href='{{ route('medical-inventory') }}';">
                    Cancel
                </button>
                <button type="submit" class="button">Submit</button>
            </div>
        </form>

    </div>
</body>
</html>
</x-app-layout>