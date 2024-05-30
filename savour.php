<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Savour Food System</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif;
            background-image: url('order.avif');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden; /* Prevent scrolling */
            color: #333;
        }

        .welcome-container {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            padding: 40px 30px;
            max-width: 600px;
            text-align: center;
            animation: fadeInUp 1s ease-out;
        }

        .welcome-message {
            font-size: 30px;
            margin-bottom: 25px;
            color: #007bff;
            font-weight: bold;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
        }

        .button-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 20px;
        }

        .button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background: #007bff;
            color: white;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
            transition: background 0.3s, transform 0.3s;
        }

        .button:hover {
            background: #0056b3;
            transform: scale(1.05);
        }

        .button:active {
            transform: scale(0.95);
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <h2 class="welcome-message">Welcome to Savour Food System</h2>
        <div class="button-container">
            <button class="button" onclick="window.location.href='order.php';">Add Order</button>
            <button class="button" onclick="window.location.href='view.php';">View Orders</button>
            <button class="button" onclick="window.location.href='update_order.php';">Update Order</button>
            <button class="button" onclick="window.location.href='search_order.php';">Search Order</button>
            <button class="button" onclick="window.location.href='delete.php';">Delete Order</button>
            <button class="button" onclick="window.location.href='SAVOURDATABASE.php';">Return Home</button>
        </div>
    </div>
</body>
</html>

