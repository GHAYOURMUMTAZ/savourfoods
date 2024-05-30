<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Menu Items</title>
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
            transition: background-image 1s ease-in-out;
        }
        .form-container, .update-container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            padding: 40px 50px;
            max-width: 600px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        h2 {
            font-size: 32px;
            color: #007bff;
            font-weight: bold;
            margin-bottom: 20px;
        }
        input[type="text"], input[type="submit"], input[type="number"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
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
            margin-top: 20px;
        }
        .return-link a:hover {
            background-color: #45a049;
        }
        .highlight {
            background-color: yellow;
            color: black;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let images = ['url(food1.jpg)', 'url(food2.jpg)', 'url(food3.avif)', 'url(food4.jpg)', 'url(food5.jpg)'];
            let current = 0;

            function nextBackground() {
                current = (current + 1) % images.length;
                document.body.style.backgroundImage = images[current];
            }
            
            setInterval(nextBackground, 2000);
            document.body.style.backgroundImage = images[0]; // Set initial background
        });
    </script>
</head>
<body>
    <div class="form-container">
        <h2>Update Menu Item</h2>
        <form action="menu_update.php" method="get">
            <input type="number" name="menu_id" placeholder="Enter Menu ID" required>
            <input type="submit" value="Search">
        </form>
    </div>

    <?php
    if (isset($_GET['menu_id'])) {
        require 'vendor/autoload.php';
        $servername = "mongodb://localhost:27017";
        $dbname = "SAVOUR_MANAGEMENT";
        $collectionName = "MENU";

        $client = new MongoDB\Client($servername);
        $collection = $client->selectDatabase($dbname)->selectCollection($collectionName);

        $menu_id = (int)$_GET['menu_id'];
        $menu_item = $collection->findOne(['MENU_ID' => $menu_id]);

        if ($menu_item) {
            echo '<div class="update-container">';
            echo '<h2>Edit Menu Item</h2>';
            echo '<form action="menu_update.php" method="post">';
            echo '<input type="hidden" name="menu_id" value="' . $menu_id . '">';
            echo '<input type="text" name="item_id" value="' . $menu_item['ITEM_ID'] . '" required>';
            echo '<input type="text" name="details" value="' . $menu_item['DETAILS'] . '" required>';
            echo '<input type="submit" value="Update">';
            echo '</form>';
            echo '</div>';
        } else {
            echo '<h2>No menu item found with Menu ID ' . $menu_id . '</h2>';
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        require 'vendor/autoload.php';
        $servername = "mongodb://localhost:27017";
        $dbname = "SAVOUR_MANAGEMENT";
        $collectionName = "MENU";

        $client = new MongoDB\Client($servername);
        $collection = $client->selectDatabase($dbname)->selectCollection($collectionName);

        $menu_id = (int)$_POST['menu_id'];
        $item_id = $_POST['item_id'];
        $details = $_POST['details'];

        $result = $collection->updateOne(
            ['MENU_ID' => $menu_id],
            ['$set' => ['ITEM_ID' => $item_id, 'DETAILS' => $details]]
        );

        if ($result->getModifiedCount() == 1) {
            echo '<h2>Menu item updated successfully.</h2>';
        } else {
            echo '<h2>Error updating menu item.</h2>';
        }
    }
    ?>

    <div class="return-link">
        <a href="menu_manage.php">Return to Home</a>
    </div>
</body>
</html>
