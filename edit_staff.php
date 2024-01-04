<?php
// Include your database connection code (e.g., config.php)
require_once('config.php');

// Check if the name parameter is set in the URL
if (isset($_GET['username'])) {
    $selectedStaff = $_GET['username'];

    // Fetch the patient details based on the selected patient name
    $staffQuery = "SELECT * FROM staff WHERE username = '$selectedStaff'";
    $staffResult = $mysqli->query($staffQuery);


    if ($staffResult) {
        $staffDetails = $staffResult->fetch_assoc();
    } else {
        echo "Error: " . $mysqli->error;
    }
}

// Check if the form is submitted for saving changes
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_staff'])) {
    // Handle the logic for updating patient details in the database
    $updatedName = $_POST['updated_username'];
    $updatedDesignation = $_POST['updated_designation'];
    $updatedContactNumber = $_POST['updated_contact_number'];
    $updatedAddress = $_POST['updated_address'];
    $updatedDateOfBirth = $_POST['updated_date_of_birth'];
    $updatedNicNumber = $_POST['updated_ni_number'];
    $updatedNextOfKin = $_POST['updated_next_of_kin'];
    $updatedNOKContactNumber = $_POST['updated_nok_contact_number'];
    $updatedPassword = $_POST['updated_password'];

    // Assuming you have a patient ID to identify the specific patient in the database
    $staffID = $staffDetails['id'];

    // Update the patient details in the database
    $updateQuery = "UPDATE staff SET 
                    username = '$updatedName', 
                    designation = ' $updatedDesignation', 
                    contact_number = '$updatedContactNumber', 
                    address = '$updatedAddress', 
                    date_of_birth = '$updatedDateOfBirth', 
                    ni_number = '$updatedNicNumber', 
                    next_of_kin = '$updatedNextOfKin', 
                    nok_contact_number = '$updatedNOKContactNumber',
                    password = '$updatedPassword'
                    WHERE id = $staffID";

    $updateResult = $mysqli->query($updateQuery);

    if ($updateResult) {
        // Successfully updated, redirect to patient_detail.php
        header("Location: patient_detail.php?name=$updatedName");
        exit(); // Ensure that no further code is executed after the redirect
    } else {
        // Error updating
        echo "Error: " . $mysqli->error;
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
    <title>Edit Patient Details</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        background-image: url('images/patient_detail.jpg'); /* Replace 'your-background-image.jpg' with the actual path to your image */
        background-size: cover;
        background-position: center;
        margin: 0;
        padding: 0;
        color: #333;
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

    form {
        width: 60%;
        max-width: 600px;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
    }

    input {
        width: 100%;
        padding: 10px;
        margin-bottom: 16px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    input[type="submit"] {
        background-color: #4caf50;
        color: #fff;
        border: none;
        padding: 12px 20px;
        font-size: 1em;
        cursor: pointer;
        border-radius: 4px;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }

    /* Add more styling as needed */
</style>
    <!-- Add your styles if needed -->
</head>
<body>
    <h1>Edit staff Details</h1>

    <?php if (isset($staffDetails)) : ?>
        <!-- Form for Editing -->
        <form method="POST" action="">
            <!-- Display current patient details -->

            <label for="updated_username">Updated Name:</label>
            <input type="text" name="updated_username" value="<?php echo $staffDetails['username']; ?>" required>
            <br>

            <label for="updated_designation">Updated Designation:</label>
            <input type="text" name="updated_designation" value="<?php echo $staffDetails['designation']; ?>" required>
            <br>

           

            <label for="updated_contact_number">Updated Contact Number:</label>
            <input type="text" name="updated_contact_number" value="<?php echo $staffDetails['contact_number']; ?>" required>
            <br>

            <label for="updated_address">Updated Address:</label>
            <input type="text" name="updated_address" value="<?php echo $staffDetails['address']; ?>" required>
            <br>

            <label for="updated_date_of_birth">Updated Date of Birth:</label>
            <input type="date" name="updated_date_of_birth" value="<?php echo $staffDetails['date_of_birth']; ?>" required>
            <br>

            <label for="updated_ni_number">Updated Nic_Number:</label>
            <input type="text" name="updated_ni_number" value="<?php echo $staffDetails['ni_number']; ?>" required>
            <br>

            <label for="updated_next_of_kin">Updated Next of Kin:</label>
            <input type="text" name="updated_next_of_kin" value="<?php echo $staffDetails['next_of_kin']; ?>" required>
            <br>

            <label for="updated_nok_contact_number">Updated NOK Contact Number:</label>
            <input type="text" name="updated_nok_contact_number" value="<?php echo $staffDetails['nok_contact_number']; ?>" required>
            <br>
            <label for="updated_password">Updated Password:</label>
            <input type="text" name="updated_password" value="<?php echo $staffDetails['password']; ?>" required>
            <br>
            

            <input type="submit" name="edit_staff" value="Save Changes">
           
        </form>
    <?php endif; ?>
</body>
</html>
