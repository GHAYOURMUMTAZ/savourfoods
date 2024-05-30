<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Transaction Details</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif;
            background-image: url('order.avif');  /* Ensure the URL to the background image is correct */
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
            background: rgba(255, 255, 255, 0.9); /* Slightly more opacity for better readability */
            border-radius: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5); /* Softer shadow for a modern look */
            padding: 40px 50px;
            max-width: 600px;
            text-align: center;
            animation: fadeInUp 1s ease-out;
            backdrop-filter: blur(5px); /* Adding backdrop filter for glassmorphism effect */
        }

        .welcome-message {
            font-size: 32px;
            margin-bottom: 25px;
            color: #007bff; /* Keeping the blue color for consistency */
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
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
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            background: linear-gradient(145deg, #0096ff, #0056b3);
            color: white;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
            transition: background 0.3s, transform 0.3s, box-shadow 0.3s;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        .button:hover {
            background: linear-gradient(145deg, #007bff, #003870);
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.3);
        }

        .button:active {
            transform: translateY(1px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.25);
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
        <h2 class="welcome-message">Welcome to Transaction Details</h2>
        <div class="button-container">
            <button class="button" onclick="window.location.href='trans_add.php';">Add Details</button>
            <button class="button" onclick="window.location.href='trans_view.php';">View Details</button>
            <button class="button" onclick="window.location.href='trans_update.php';">Update Detail</button>
            <button class="button" onclick="window.location.href='trans_search.php';">Search Detail</button>
            <button class="button" onclick="window.location.href='trans_delete.php';">Delete Detail</button>
            <button class="button" onclick="window.location.href='SAVOURDATABASE.php';">Return Home</button>
        </div>
    </div>
</body>
</html>
