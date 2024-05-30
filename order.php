<?php
require 'vendor/autoload.php'; // Include Composer's autoloader for MongoDB

// MongoDB connection settings
$servername = "localhost:27017"; // MongoDB server with port
$dbname = "SAVOUR_MANAGEMENT"; // Database name
$collectionName = "ORDER"; // Collection name

// Create MongoDB client connection
$client = new MongoDB\Client("mongodb://$servername");
$collection = $client->selectDatabase($dbname)->selectCollection($collectionName);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_order'])) {
    // Check if all required fields are set and not empty
    if (!empty($_POST['emp_id']) && !empty($_POST['cust_id']) && !empty($_POST['order_status']) && !empty($_POST['order_type']) && !empty($_POST['item_id'])) {
        
        // Calculate the next Order ID based on the maximum Order ID present
        $maxOrder = $collection->find([], ['sort' => ['ORDER_ID' => -1], 'limit' => 1]);
        $maxId = $maxOrder->toArray()[0]['ORDER_ID'] ?? 0;
        $order_id = $maxId + 1;

        $emp_id = $_POST['emp_id'];
        $cust_id = $_POST['cust_id'];
        $order_status = $_POST['order_status'];
        $order_type = $_POST['order_type'];
        $item_id = $_POST['item_id'];

        // Generate a human-readable current timestamp
        $order_time = date('Y-m-d H:i:s');

        // Insert data into the MongoDB collection
        $result = $collection->insertOne([
            'ORDER_ID' => $order_id,
            'EMP_ID' => $emp_id,
            'CUST_ID' => $cust_id,
            'ORDER_STATUS' => $order_status,
            'ORDER_TIME' => $order_time,
            'ORDER_TYPE' => $order_type,
            'ITEM_ID' => $item_id
        ]);

        if ($result->getInsertedCount() == 1) {
            echo "<p class='success'>New record created successfully. Order ID: " . $order_id . "</p>";
        } else {
            echo "<p class='error'>Error: Document was not inserted</p>";
        }
    } else {
        echo "<p class='error'>Error: All fields are required. Please enter the required data.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Form</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-image: url('order.avif');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
            font-family: 'Roboto', sans-serif;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            overflow: hidden;
        }
        .form-container {
            background-color: rgba(0, 0, 0, 0.8);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
            margin: auto;
            animation: fadeIn 1s ease-in-out;
            position: relative;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .form-container h2 {
            text-align: center;
            font-size: 28px;
            margin-bottom: 25px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: 500;
        }
        input[type="text"], select, input[type="submit"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: none;
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            font-size: 16px;
        }
        input[type="text"]:focus, select:focus {
            background-color: rgba(255, 255, 255, 0.3);
            outline: none;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        select {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
        }
        select option {
            background-color: black;
            color: white;
        }
        .return-link a {
            color: white;
            background-color: #4CAF50;
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
            display: inline-block;
            margin-top: 20px;
            text-align: center;
            width: 100%;
        }
        .return-link a:hover {
            background-color: #45a049;
        }
        .error {
            color: #ff6666;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }
        .success {
            color: #66ff66;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Order Form</h2>
        <?php if (isset($errorMessage)): ?>
            <p class='error'><?= $errorMessage ?></p>
        <?php endif; ?>
        <form action="" method="post">
            <label for="emp_id">Employee ID:</label>
            <input type="text" id="emp_id" name="emp_id" required>

            <label for="cust_id">Customer ID:</label>
            <input type="text" id="cust_id" name="cust_id" required>

            <label for="order_status">Order Status:</label>
            <select id="order_status" name="order_status" required>
                <option value="Pending">Pending</option>
                <option value="Deliver">Deliver</option>
                <option value="Not Available">Not Available</option>
                <option value="Confirmed">Confirmed</option>
                <option value="Shipped">Shipped</option>
                <option value="Cancelled">Cancelled</option>
                <option value="Completed">Completed</option>
            </select>

            <label for="order_type">Order Type:</label>
            <input type="text" id="order_type" name="order_type" required>

            <label for="item_id">Item ID:</label>
            <input type="text" id="item_id" name="item_id" required>

            <input type="submit" name="submit_order" value="Submit Order">
        </form>
        <div class="return-link">
            <a href="savour.php">Return to Home</a>
        </div>
    </div>
</body>
</html>
