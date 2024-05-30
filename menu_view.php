<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Menu Items</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
            transition: background-image 0.5s ease-in-out;
            color: white;
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
            max-width: 800px;
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
            transition: background-color 0.3s;
            display: inline-block;
            text-align: center;
        }
        .return-link a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Menu Items</h2>
    <?php
    require 'vendor/autoload.php'; // Make sure this path is correct and the autoload file is present
    $servername = "mongodb://localhost:27017";
    $dbname = "SAVOUR_MANAGEMENT";
    $collectionName = "MENU";

    $client = new MongoDB\Client($servername);
    $collection = $client->selectDatabase($dbname)->selectCollection($collectionName);

    $cursor = $collection->find([]);

    if ($cursor->isDead()) {
        echo "<h2>No menu items found.</h2>";
    } else {
        echo "<table>";
        echo "<tr><th>Menu ID</th><th>Item ID</th><th>Details</th></tr>";
        foreach ($cursor as $doc) {
            echo "<tr>";
            echo "<td>" . $doc['MENU_ID'] . "</td>";
            echo "<td>" . $doc['ITEM_ID'] . "</td>";
            echo "<td>" . $doc['DETAILS'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    ?>
    <div class="return-link">
        <a href="menu_manage.php">Return to Home</a>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let images = [
                'url(food1.jpg)', 
                'url(food2.jpg)', 
                'url(food3.avif)', 
                'url(food4.jpg)', 
                'url(food5.jpg)'
            ];
            let current = 0;

            function changeBackground() {
                current = (current + 1) % images.length;
                document.body.style.backgroundImage = images[current];
            }

            setInterval(changeBackground, 2000); // Change background every 2 seconds
            document.body.style.backgroundImage = images[0]; // Set initial background
        });
    </script>
</body>
</html>
