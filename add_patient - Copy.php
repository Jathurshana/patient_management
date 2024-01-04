<?php
require_once('config.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Include database connection code here
  
    $name = $_POST['name'];
    $nhs_number = $_POST['nhs_number'];
    $contact_number = $_POST['contact_number'];
    $address = $_POST['address'];
    $date_of_birth = $_POST['date_of_birth'];
    $gp_name = $_POST['gp_name'];
    $next_of_kin = $_POST['next_of_kin'];
    $nok_contact_number = $_POST['nok_contact_number'];
    $additional_info = $_POST['additional_info'];
    

    // Insert data into the patient table here
    $sql = "INSERT INTO patient (name, nhs_number, contact_number, address, date_of_birth, gp_name, next_of_kin, nok_contact_number,additional_info) 
            VALUES ('$name', '$nhs_number', '$contact_number', '$address', '$date_of_birth', '$gp_name', '$next_of_kin', '$nok_contact_number','$additional_info')";

    if ($mysqli->query($sql) === true) {
        // Data was successfully inserted
        echo "Patient data inserted successfully.";
    } else {
        // An error occurred
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }

    // Close the database connection
    $mysqli->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Patient</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('images/patient.jpg'); /* Replace 'your-background-image.jpg' with the actual path to your image */
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
            height: 100vh;
        }

        h1 {
            font-size: 2em;
            margin-bottom: 20px;
        }

        form {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
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
    <h1>Add Patient</h1>
    <form method="POST" action="add_patient.php">
        <label for="name">Name:</label>
        <input type="text" name="name" required>
        <br>
        <label for="nhs_number">NHS Number:</label>
        <input type="text" name="nhs_number" required>
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
        <label for="gp_name">GP Name:</label>
        <input type="text" name="gp_name" required>
        <br>
        <label for="next_of_kin">Next of Kin:</label>
        <input type="text" name="next_of_kin" required>
        <br>
        <label for="nok_contact_number">NOK Contact Number:</label>
        <input type="text" name="nok_contact_number" required>
        <br>
        
        <label for="additional_info">Additional Information:</label>
        <textarea name="additional_info" rows="4" required></textarea>
        <br>

        <input type="submit" value="Add Patient">
        <button onclick="window.location.href='admin_panel.php'" style="background-color: #f44336; color: #fff; padding: 10px 20px; font-size: 1.2em; cursor: pointer; margin-top: 10px;">Back</button> 
         </form>
</body>
</html>