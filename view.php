<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View All Orders</title>
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
        h2 {
            text-align: center;
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }
        table {
            width: 90%;
            max-width: 1000px;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            background-color: rgba(0, 0, 0, 0.7);
            border-radius: 10px;
            overflow: hidden;
        }
        th, td {
            padding: 15px;
            text-align: left;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        th {
            background-color: rgba(0, 123, 255, 0.7);
        }
        tr:nth-child(even) {
            background-color: rgba(255, 255, 255, 0.1);
        }
        .return-link a {
            color: white;
            background-color: #28a745;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <?php
    require 'vendor/autoload.php'; // Include Composer's autoloader for MongoDB

    $servername = "mongodb://localhost:27017"; // MongoDB server with port
    $dbname = "SAVOUR_MANAGEMENT"; // Database name
    $collectionName = "ORDER"; // Collection name

    // Create MongoDB client connection
    $client = new MongoDB\Client($servername);
    $collection = $client->selectDatabase($dbname)->selectCollection($collectionName);

    // Fetch all orders from MongoDB
    $cursor = $collection->find([]); // Finds all documents in the collection

    echo "<h2>All Orders</h2>";
    if ($cursor->isDead()) {
        echo "<h2>No orders found.</h2>";
    } else {
        echo "<table>";
        echo "<tr><th>Order ID</th><th>Employee ID</th><th>Customer ID</th><th>Order Status</th><th>Order Time</th><th>Order Type</th><th>Item ID</th></tr>";
        foreach ($cursor as $doc) {
            echo "<tr>";
            echo "<td>" . $doc['ORDER_ID'] . "</td>";
            echo "<td>" . $doc['EMP_ID'] . "</td>";
            echo "<td>" . $doc['CUST_ID'] . "</td>";
            echo "<td>" . $doc['ORDER_STATUS'] . "</td>";
            echo "<td>" . $doc['ORDER_TIME'] . "</td>";
            echo "<td>" . $doc['ORDER_TYPE'] . "</td>";
            echo "<td>" . $doc['ITEM_ID'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    ?>
    <div class="return-link">
        <a href="savour.php">Return to Home</a>
    </div>
</body>
</html>

