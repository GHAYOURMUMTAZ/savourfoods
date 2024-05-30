<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Savour Database</title>
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
        .menu-container {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        .basmala {
            font-size: 48px;
            margin-bottom: 5px;
            font-family: 'Amiri', serif; /* This is a font that supports Arabic script */
            font-weight: normal;
        }
        .menu-container h1 {
            font-size: 36px;
            margin-bottom: 5px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }
        .menu-container h2 {
            font-size: 24px;
            margin-top: 5px;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }
        .menu-button {
            display: block;
            width: 200px;
            padding: 15px;
            margin: 20px auto;
            border: none;
            border-radius: 5px;
            background-color: #4CAF50;
            color: white;
            font-size: 18px;
            font-weight: 500;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .menu-button:hover {
            background-color: #45a049;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Amiri&display=swap" rel="stylesheet">
</head>
<body>
    <div class="menu-container">
        <p class="basmala">﷽</p>
        <h1>Welcome to</h1>
        <h2>Savour Database</h2>
        <a href="savour.php" class="menu-button">Order</a>
        <a href="trans.php" class="menu-button">Transaction Details</a>
        <a href="menu_manage.php" class="menu-button">Manage Menu</a>
        <a href="workermanage.php" class="menu-button">Employee Management</a> <!-- New Button for Employee Management -->
    </div>
</body>
</html>
