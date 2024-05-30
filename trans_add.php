<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Form</title>
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
            background-color: rgba(0, 0, 0, 0.9); /* More opaque for better readability */
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
        <h2>Transaction Form</h2>
        <?php
        require 'vendor/autoload.php';
        $servername = "localhost:27017";
        $dbname = "SAVOUR_MANAGEMENT";
        $collectionName = "TRANSACTION";
        $client = new MongoDB\Client("mongodb://$servername");
        $collection = $client->selectDatabase($dbname)->selectCollection($collectionName);
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (!empty($_POST['emp_id']) && !empty($_POST['cust_id']) && !empty($_POST['order_id'])) {
                $maxTrans = $collection->find([], ['sort' => ['TRANS_ID' => -1], 'limit' => 1]);
                $maxId = $maxTrans->toArray()[0]['TRANS_ID'] ?? 0;
                $trans_id = $maxId + 1;
                
                $emp_id = $_POST['emp_id'];
                $cust_id = $_POST['cust_id'];
                $order_id = $_POST['order_id'];
                $trans_time = date('Y-m-d H:i:s');
                
                $result = $collection->insertOne([
                    'TRANS_ID' => $trans_id,
                    'EMP_ID' => $emp_id,
                    'CUST_ID' => $cust_id,
                    'ORDER_ID' => $order_id,
                    'TRANS_TIME' => $trans_time
                ]);
                
                if ($result->getInsertedCount() == 1) {
                    echo "<p class='success'>New transaction record created successfully. Transaction ID: " . $trans_id . "</p>";
                } else {
                    echo "<p class='error'>Error: Document was not inserted</p>";
                }
            } else {
                echo "<p class='error'>Error: All fields are required. Please enter the required data.</p>";
            }
        }
        ?>
        <form action="" method="post">
            <label for="emp_id">Employee ID:</label>
            <input type="text" id="emp_id" name="emp_id" required>
            <label for="cust_id">Customer ID:</label>
            <input type="text" id="cust_id" name="cust_id" required>
            <label for="order_id">Order ID:</label>
            <input type="text" id="order_id" name="order_id" required>
            <input type="submit" name="submit_order" value="Submit Transaction">
        </form>
        <div class="return-link">
            <a href="trans.php">Return to Home</a>
        </div>
    </div>
</body>
</html>

