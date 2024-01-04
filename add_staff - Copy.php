<?php
// Include database connection code here
require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process the submitted form data and insert into the staff table
    $FullName= $_POST['FullName'];
    $designation = $_POST['designation'];
    $contact_number = $_POST['contact_number'];
    $address = $_POST['address'];
    $date_of_birth = $_POST['date_of_birth'];
    $ni_number = $_POST['ni_number'];
    $next_of_kin = $_POST['next_of_kin'];
    $nok_contact_number = $_POST['nok_contact_number'];
    $username = $_POST['username'];
    $password = $_POST["password"];
    $additional_info = $_POST["additional_info"];

    // Check the database connection
    if ($mysqli === null || $mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Insert data into the staff table here
    $sql = "INSERT INTO staff (FullName, designation, contact_number, address, date_of_birth, ni_number, next_of_kin, nok_contact_number,username, password,additional_info) 
        VALUES (' $FullName', '$designation', '$contact_number', '$address', '$date_of_birth', '$ni_number', '$next_of_kin', '$nok_contact_number', '$username','$password','$additional_info')";

    if ($mysqli->query($sql) === true) {
        // Data was successfully inserted
        echo "Data inserted successfully.";
    } else {
        // An error occurred
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Staff</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('images/staff.jpg'); /* Replace 'your-background-image.jpg' with the actual path to your image */
            background-size: cover;
            background-position: center;
             background-repeat: no-repeat;
            margin: 0;
            padding: 0;
            color:black;
            text-align: center;
            display:inherit;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 120vh;
        }

        h1 {
            font-size: 2em;
            margin-bottom: 2px;
   
        }

        form {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 350px;
            margin: auto;
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

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Add Staff</h1>
    <form method="POST" action="add_staff.php">
        <label for="FullName">Full Name:</label>
        <input type="text" name="FullName" required>
        <br>
        <label for="designation">Designation:</label>
        <input type="text" name="designation" required>
        <br>
        <label for="contact_number">Contact Number:</label>
        <input type="text" name="contact_number" required>
        <br>
        <label for="address">Address:</label>
        <input type="text" name="address" required>
        <br>
        <label for="date_of_birth">Date of Birth:</label>
        <input type="date" name="date_of_birth" required>
        <br>
        <label for="ni_number">NI Number:</label>
        <input type="text" name="ni_number" required>
        <br>
        <label for="next_of_kin">Next of Kin:</label>
        <input type="text" name="next_of_kin" required>
        <br>
        <label for="nok_contact_number">NOK Contact Number:</label>
        <input type="text" name="nok_contact_number" required>
        <br>
        <label for="username">Username:</label>
        <input type="text" name="username" required>
        <br>
        <label for="password">password:</label>
        <input type="text" name="password" required>
        <br>
        
        <label for="additional_info">Additional Information:</label>
        <textarea name="additional_info" rows="4" required></textarea>
        <br>
        <input type="submit" value="Add Staff">
        <button onclick="window.location.href='admin_panel.php'" style="background-color: #f44336; color: #fff; padding: 10px 20px; font-size: 1.2em; cursor: pointer; margin-top: 10px;">Back</button> 
        <button onclick="window.location.href='logout.php'" style="background-color: #f44336; color: #fff; padding: 10px 20px; font-size: 1.2em; cursor: pointer; margin-top: 10px;">Logout</button> 
    </form>
</body>
</html>
