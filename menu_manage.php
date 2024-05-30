<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Management System</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
            transition: background-image 1s ease-in-out;
        }

        .welcome-container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            padding: 40px 50px;
            max-width: 600px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .welcome-message {
            font-size: 32px;
            color: #007bff;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .button-container {
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .button {
            flex: 1 1 180px; /* Make each button grow and wrap at less than 180px wide */
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            background: linear-gradient(145deg, #0096ff, #0056b3);
            color: white;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
            transition: background 0.3s, transform 0.3s;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            text-align: center; /* Ensure text is centered */
            min-width: 150px; /* Minimum width for smaller screens */
        }

        .button:hover {
            background: linear-gradient(145deg, #007bff, #003870);
            transform: translateY(-2px);
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
            
            setInterval(nextBackground, 4000);
            document.body.style.backgroundImage = images[0]; // Set initial background
        });
    </script>
</head>
<body>
    <div class="welcome-container">
        <h2 class="welcome-message">Menu Management System</h2>
        <div class="button-container">
            <button class="button" onclick="location.href='menu_add.php';">Add Menu Item</button>
            <button class="button" onclick="location.href='menu_view.php';">View Menu Items</button>
            <button class="button" onclick="location.href='menu_update.php';">Update Menu Item</button>
            <button class="button" onclick="location.href='men_delete.php';">Delete Menu Item</button>
            <button class="button" onclick="location.href='menu_search.php';">Search Menu Item</button> <!-- New Search Button -->
            <button class="button" onclick="location.href='SAVOURDATABASE.php';">Return Home</button>
        </div>
    </div>
</body>
</html>
