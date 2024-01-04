
<!DOCTYPE html>
<html>
<head>
    <title>Staff Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('images/menu.jpg');
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 0;
            color: black;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        h1 {
            font-size: 2em;
            margin-bottom: 20px;
        }

        button {
            background-color: darkslategrey;
            color: #fff;
            border: none;
            padding: 15px 30px;
            font-size: 1.2em;
            cursor: pointer;
            margin: 5px;
            text-decoration: none;
        }

        button:hover {
            background-color: black;
        }
    </style>
</head>
<body>
    <h1>Staff Panel</h1>
    <button onclick="window.location.href='Enter_data.php'">Enter Data</button>
    <button onclick="window.location.href='view_data.php'">View Data</button>
    <button onclick="window.location.href='logout.php'" style="background-color: #f44336; color: #fff; padding: 10px 20px; font-size: 1.2em; cursor: pointer; margin-top: 10px;">Logout</button> 
</body>
</html>
