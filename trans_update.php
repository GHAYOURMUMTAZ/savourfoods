<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Transaction Details</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-image: url('trans.jpg');
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
        input {
            border: none;
            border-radius: 8px;
            padding: 12px;
            margin: 10px 0;
            width: 100%;
            display: block;
            font-size: 16px;
        }
        input[type="submit"] {
            background-color: #007bff;
            cursor: pointer;
            font-weight: 500;
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
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Update Transaction Details</h1>
    <?php
    require 'vendor/autoload.php';
    $servername = "localhost:27017";
    $dbname = "SAVOUR_MANAGEMENT";
    $collectionName = "TRANSACTION";
    $client = new MongoDB\Client("mongodb://$servername");
    $collection = $client->selectDatabase($dbname)->selectCollection($collectionName);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $trans_id = $_POST["trans_id"] ?? "";
        $new_emp_id = $_POST["new_emp_id"] ?? null;
        $new_cust_id = $_POST["new_cust_id"] ?? null;
        $new_order_id = $_POST["new_order_id"] ?? null;

        $updateFields = [];
        if ($new_emp_id) $updateFields['EMP_ID'] = $new_emp_id;
        if ($new_cust_id) $updateFields['CUST_ID'] = $new_cust_id;
        if ($new_order_id) $updateFields['ORDER_ID'] = $new_order_id;

        if (!empty($updateFields)) {
            $updateResult = $collection->updateOne(
                ['TRANS_ID' => (int) $trans_id],
                ['$set' => $updateFields]
            );

            if ($updateResult->getModifiedCount() > 0) {
                echo "<p>Transaction details updated successfully.</p>";
            } else {
                echo "<p>No transaction found with the given ID or no changes made.</p>";
            }
        } else {
            echo "<p>Please fill out at least one field to update.</p>";
        }
    }
    ?>
    <form method="post" action="">
        <label for="trans_id">Transaction ID:</label>
        <input type="text" id="trans_id" name="trans_id" required>
        
        <label for="new_emp_id">New Employee ID (optional):</label>
        <input type="text" id="new_emp_id" name="new_emp_id">
        
        <label for="new_cust_id">New Customer ID (optional):</label>
        <input type="text" id="new_cust_id" name="new_cust_id">
        
        <label for="new_order_id">New Order ID (optional):</label>
        <input type="text" id="new_order_id" name="new_order_id">
        
        <input type="submit" value="Update Transaction">
    </form>
    <div class="return-link">
        <a href="trans.php">Return to Home</a>
    </div>
</body>
</html>
