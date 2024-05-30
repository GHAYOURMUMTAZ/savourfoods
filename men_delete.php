<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Menu Item</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-image: url('food2.jpg'); /* Ensure this file exists and path is correct */
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
    <h1>Delete Menu Item</h1>
    <?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    require 'vendor/autoload.php'; // Ensure Composer's autoloader for MongoDB is correctly specified

    $servername = "mongodb://localhost:27017";
    $dbname = "SAVOUR_MANAGEMENT";
    $collectionName = "MENU";

    try {
        $client = new MongoDB\Client($servername);
        $collection = $client->selectDatabase($dbname)->selectCollection($collectionName);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $menu_id = filter_input(INPUT_POST, 'menu_id', FILTER_SANITIZE_NUMBER_INT);

            if ($menu_id) {
                $deleteResult = $collection->deleteOne(['MENU_ID' => (int)$menu_id]);

                if ($deleteResult->getDeletedCount() > 0) {
                    echo "<p>Menu item deleted successfully.</p>";
                } else {
                    echo "<p>No menu item found with the given ID or unable to delete.</p>";
                }
            } else {
                echo "<p>Error: Invalid Menu ID provided.</p>";
            }
        }
    } catch (Exception $e) {
        echo "Error connecting to MongoDB: " . $e->getMessage();
    }
    ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="menu_id">Menu ID:</label>
        <input type="text" id="menu_id" name="menu_id" required>
        <button type="submit">Delete Menu Item</button>
    </form>
    <div class="return-link">
        <a href="menu_manage.php">Return to Home</a>
    </div>
</body>
</html>
