<?php
require_once('config.php');

session_start();

error_reporting(0);

function validateStaff($conn, $username, $password) {
    // Assuming your staff table has columns 'username' and 'password'
    $sql = "SELECT * FROM staff WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        return true; // Valid user
    } else {
        return false; // Invalid user
    }
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // For admin login
    if ($username == "admin" && $password == "12345") {
        header("Location: admin_panel.php");
        exit(); // Make sure to exit after redirection
    } elseif ($username == "admin2" && $password == "00000") {
        header("Location: dashboard.php");
        exit(); // Make sure to exit after redirection
    } 
    
    else {
        // For staff login, validate against the database
        if (validateStaff($mysqli, $username, $password)) {
            // Assuming 'name' is the column in your staff table that stores staff names
            $query = "SELECT username FROM staff WHERE username = '$username'";
            $result = $mysqli->query($query);

            if ($result && $row = $result->fetch_assoc()) {
                $staff_name = $row['username'];
                $_SESSION['staff_name'] = $staff_name;
                header("Location: staff_menu.php");
                exit();
            } else {
                echo "Error fetching staff name.";
            }
        } else {
            echo "Invalid username or password.";
        }
    }
}
// Close the database connection
$mysqli->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
 
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image:url('images/login.png'); /* Replace 'your-background-image.jpg' with the actual path to your image */
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            flex-direction: column;
        }

        h2 {
            text-align: center;
            color:dodgerblue;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px; /* Added max-width for better mobile responsiveness */
            width: 100%;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 8px;
            text-align: left;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        img {
            max-width: 50%;
            height: auto;
            margin-bottom: 20px;
            margin: 0 auto;
        }

        input[type="submit"] {
            background-color:seagreen;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color:darkgreen;
        }
         /* Media query for mobile optimization */
         @media only screen and (max-width: 600px) {
            body {
                background-size: auto; /* Adjust background size for smaller screens */
            }

            form {
                max-width: none; /* Remove max-width for full-width on smaller screens */
            }
        }
    </style>
</head>
<body>
  
    <form action="" method="POST" >
    <img src="images/logo.jpeg" alt="Hospital Logo">
    <h2> Hospital Management System </h2>
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <input type="submit" value="Login">
      
</body>
</html>
