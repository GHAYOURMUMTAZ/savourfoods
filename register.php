<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Management</title>
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
            background-color: rgba(0, 0, 0, 0.7);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
            margin: auto;
            animation: fadeIn 1s ease-in-out;
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
        input[type="text"], input[type="submit"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: none;
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            font-size: 16px;
        }
        input[type="text"]:focus {
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
        <h2>Add Menu Item</h2>
        <?php
        require 'vendor/autoload.php';
        $servername = "localhost:27017";
        $dbname = "SAVOUR_MANAGEMENT";
        $collectionName = "MENU";

        $client = new MongoDB\Client("mongodb://$servername");
        $collection = $client->selectDatabase($dbname)->selectCollection($collectionName);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (!empty($_POST['item_id']) && !empty($_POST['details'])) {
                $maxMenu = $collection->find([], ['sort' => ['MENU_ID' => -1], 'limit' => 1]);
                $maxId = $maxMenu->toArray()[0]['MENU_ID'] ?? 0;
                $menu_id = $maxId + 1;
                
                $item_id = $_POST['item_id'];
                $details = $_POST['details'];
                
                $result = $collection->insertOne([
                    'MENU_ID' => $menu_id,
                    'ITEM_ID' => $item_id,
                    'DETAILS' => $details
                ]);
                
                if ($result->getInsertedCount() == 1) {
                    echo "<p class='success'>New menu item added successfully. Menu ID: " . $menu_id . "</p>";
                } else {
                    echo "<p class='error'>Error: Document was not inserted</p>";
                }
            } else {
                echo "<p class='error'>Error: All fields are required. Please enter the required data.</p>";
            }
        }
        ?>
        <form action="" method="post">
            <label for="item_id">Item ID:</label>
            <input type="text" id="item_id" name="item_id" required>
            <label for="details">Details:</label>
            <input type="text" id="details" name="details" required>
            <input type="submit" value="Submit New Item">
        </form>
        <div class="return-link">
            <a href="menu_manage.php">Return to Menu</a>
        </div>
    </div>
</body>
</html>




