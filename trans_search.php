<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Transactions by Transaction ID</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-image: url('trans.jpg'); /* Ensure the image path is correct */
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
        input[type="text"], input[type="submit"] {
            border: 2px solid #fff;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 12px;
            margin: 10px;
            border-radius: 10px;
            font-size: 16px;
            color: white;
        }
        input[type="submit"] {
            background-color: #007bff;
            cursor: pointer;
        }
        .return-link a {
            color: white;
            background-color: #28a745;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 10px;
        }
        form {
            width: 80%;
            max-width: 500px;
        }
    </style>
</head>
<body>
    <?php
    require 'vendor/autoload.php'; // Include Composer's autoloader for MongoDB

    $servername = "localhost:27017"; // MongoDB server with port
    $dbname = "SAVOUR_MANAGEMENT"; // Database name
    $collectionName = "TRANSACTION"; // Updated collection name to TRANSACTION

    // Create MongoDB client connection
    $client = new MongoDB\Client("mongodb://$servername"); // No authentication
    $collection = $client->selectDatabase($dbname)->selectCollection($collectionName);

    // Check if the form is submitted for searching
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $search_trans_id = $_POST["search_trans_id"] ?? ""; // Get the transaction ID from POST request

        // Search for transactions based on the provided Transaction ID
        $query = ['TRANS_ID' => (int) $search_trans_id]; // Convert to integer if transaction ID is numeric
        $options = ['projection' => ['_id' => 0]]; // Exclude MongoDB's default _id field
        $cursor = $collection->find($query, $options);
        $results = iterator_to_array($cursor); // Convert cursor to array to prevent rewinding issues

        echo "<h2>Search Results</h2>";
        if (count($results) > 0) { // Check if there are any results
            echo "<table>";
            echo "<tr><th>Transaction ID</th><th>Employee ID</th><th>Customer ID</th><th>Transaction Time</th><th>Order ID</th></tr>";
            foreach ($results as $doc) { // Iterate over the array of results
                echo "<tr>";
                echo "<td>" . $doc['TRANS_ID'] . "</td>";
                echo "<td>" . $doc['EMP_ID'] . "</td>";
                echo "<td>" . $doc['CUST_ID'] . "</td>";
                echo "<td>" . $doc['TRANS_TIME'] . "</td>";
                echo "<td>" . $doc['ORDER_ID'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<h2>No results found for the given Transaction ID.</h2>";
        }
    }
    ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="search_trans_id">Search by Transaction ID:</label>
        <input type="text" id="search_trans_id" name="search_trans_id" required>
        <input type="submit" value="Search">
    </form>
    <div class="return-link">
        <a href="trans.php">Return to Home</a>
    </div>
</body>
</html>
