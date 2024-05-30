<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Employees</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-image: url('workingstaff.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
            font-family: 'Roboto', sans-serif;
            color: white;
            display: flex;
            flex-direction: column; /* Adjust body to use column layout */
            align-items: center;
            height: 100%;
            margin: 0;
            padding: 20px;
            overflow: auto;
        }
        .table-container {
            background-color: rgba(0, 0, 0, 0.85);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            width: 90%;
            margin: 20px 0; /* Space above and below table container */
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:hover {
            background-color: #666;
        }
        .return-link {
            text-align: center;
            width: 100%; /* Full width for better control */
            margin-top: auto; /* Pushes to the bottom of the viewport */
        }
        .return-link a {
            color: white;
            background-color: #4CAF50;
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
            display: inline-block;
        }
        .return-link a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="table-container">
        <h2 style="text-align: center;">Employee List</h2>
        <table>
            <thead>
                <tr>
                    <th>Employee ID</th>
                    <th>Role ID</th>
                    <th>Role Name</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require 'vendor/autoload.php';
                $servername = "localhost:27017";
                $dbname = "SAVOUR_MANAGEMENT";
                $collectionName = "employee";

                $client = new MongoDB\Client("mongodb://$servername");
                $collection = $client->selectDatabase($dbname)->selectCollection($collectionName);
                
                $employees = $collection->find();
                foreach ($employees as $employee) {
                    echo "<tr>";
                    echo "<td>" . $employee['EMP_ID'] . "</td>";
                    echo "<td>" . $employee['ROLE_ID'] . "</td>";
                    echo "<td>" . $employee['ROLE_NAME'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="return-link">
        <a href="workermanage.php">Return to Main Menu</a>
    </div>
</body>
</html>
