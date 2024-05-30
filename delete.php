<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Order</title>
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
            flex-direction: column;
            height: 100vh;
            margin: 0;
        }
        h1 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 30px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }
        form {
            background: rgba(0, 0, 0, 0.7);
            border-radius: 10px;
            padding: 20px;
            width: 300px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        input[type="text"], button {
            border: none;
            border-radius: 8px;
            padding: 12px;
            margin: 10px 0;
            width: 100%;
            display: block;
            font-size: 16px;
            color: white;
        }
        input[type="text"] {
            background-color: rgba(255, 255, 255, 0.5);
        }
        button {
            background-color: #dc3545;
            cursor: pointer;
            font-weight: 500;
        }
        button:hover {
            background-color: #c82333;
        }
        .return-link a {
            color: white;
            background-color: #28a745;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 10px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Delete Order</h1>
    <?php
    require 'vendor/autoload.php'; // Include Composer's autoloader for MongoDB

    $servername = "localhost:27017"; // MongoDB server with port
    $dbname = "SAVOUR_MANAGEMENT"; // Database name
    $collectionName = "ORDER"; // Collection name

    // Create MongoDB client connection
    $client = new MongoDB\Client("mongodb://$servername"); // No authentication
    $collection = $client->selectDatabase($dbname)->selectCollection($collectionName);

    // Check if the form is submitted for deletion
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $order_id = $_POST["order_id"] ?? ""; // Get the order ID from POST request

        // Delete the order based on the provided Order ID
        $deleteResult = $collection->deleteOne(['ORDER_ID' => (int) $order_id]);

        if ($deleteResult->getDeletedCount() > 0) {
            echo "<p>Order deleted successfully.</p>";
        } else {
            echo "<p>No order found with the given ID or unable to delete.</p>";
        }
    }
    ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="order_id">Order ID:</label>
        <input type="text" id="order_id" name="order_id" required>
        <button type="submit">Delete Order</button>
    </form>
    <div class="return-link">
        <a href="savour.php">Return to Home</a>
    </div>
</body>
</html>
