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
        <div class="form-section">
            <h3>Medicine Information</h3>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" placeholder="Medicine Name">
            </div>
            <div class="form-group">
                <label for="dosage">Dosage/Form:</label>
                <input type="text" id="dosage" placeholder="200mg/Tablet">
            </div>
            <div class="form-group">
                <label for="expiration">Expiration Date:</label>
                <input type="date" id="expiration">
            </div>
            <div class="form-group">
                <label for="dateAdded">Date Added:</label>
                <input type="date" id="dateAdded">
            </div>
            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" value="100">
            </div>
            <div class="form-group">
                <label for="unit">Unit of Measurement:</label>
                <input type="text" id="unit" placeholder="Each/Pack/Bottle">
            </div>
            <div class="button-container">
                <button class="button cancel">Cancel</button>
                <button class="button">Submit</button>
            </div>
        </div>
    </div>
</body>
</html>
</x-app-layout>