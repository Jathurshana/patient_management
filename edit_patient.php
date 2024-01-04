<?php
// Include your database connection code (e.g., config.php)
require_once('config.php');

// Check if the name parameter is set in the URL
if (isset($_GET['name'])) {
    $selectedPatient = $_GET['name'];

    // Fetch the patient details based on the selected patient name
    $patientQuery = "SELECT * FROM patient WHERE name = '$selectedPatient'";
    $patientResult = $mysqli->query($patientQuery);

    if ($patientResult) {
        $patientDetails = $patientResult->fetch_assoc();
    } else {
        echo "Error: " . $mysqli->error;
    }
}

// Check if the form is submitted for saving changes
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_patient'])) {
    // Handle the logic for updating patient details in the database
    $updatedName = $_POST['updated_name'];
    $updatedNHSNumber = $_POST['updated_nhs_number'];
    $updatedContactNumber = $_POST['updated_contact_number'];
    $updatedAddress = $_POST['updated_address'];
    $updatedDateOfBirth = $_POST['updated_date_of_birth'];
    $updatedGPName = $_POST['updated_gp_name'];
    $updatedNextOfKin = $_POST['updated_next_of_kin'];
    $updatedNOKContactNumber = $_POST['updated_nok_contact_number'];

    // Assuming you have a patient ID to identify the specific patient in the database
    $patientID = $patientDetails['id'];

    // Update the patient details in the database
    $updateQuery = "UPDATE patient SET 
                    name = '$updatedName', 
                    nhs_number = '$updatedNHSNumber', 
                    contact_number = '$updatedContactNumber', 
                    address = '$updatedAddress', 
                    date_of_birth = '$updatedDateOfBirth', 
                    gp_name = '$updatedGPName', 
                    next_of_kin = '$updatedNextOfKin', 
                    nok_contact_number = '$updatedNOKContactNumber' 
                    WHERE id = $patientID";

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
    <h1>Edit Patient Details</h1>

    <?php if (isset($patientDetails)) : ?>
        <!-- Form for Editing -->
        <form method="POST" action="">
            <!-- Display current patient details -->

            <label for="updated_name">Updated Name:</label>
            <input type="text" name="updated_name" value="<?php echo $patientDetails['name']; ?>" required>
            <br>

            <label for="updated_nhs_number">Updated NHS Number:</label>
            <input type="text" name="updated_nhs_number" value="<?php echo $patientDetails['nhs_number']; ?>" required>
            <br>

            <label for="updated_contact_number">Updated Contact Number:</label>
            <input type="text" name="updated_contact_number" value="<?php echo $patientDetails['contact_number']; ?>" required>
            <br>

            <label for="updated_address">Updated Address:</label>
            <input type="text" name="updated_address" value="<?php echo $patientDetails['address']; ?>" required>
            <br>

            <label for="updated_date_of_birth">Updated Date of Birth:</label>
            <input type="date" name="updated_date_of_birth" value="<?php echo $patientDetails['date_of_birth']; ?>" required>
            <br>

            <label for="updated_gp_name">Updated GP Name:</label>
            <input type="text" name="updated_gp_name" value="<?php echo $patientDetails['gp_name']; ?>" required>
            <br>

            <label for="updated_next_of_kin">Updated Next of Kin:</label>
            <input type="text" name="updated_next_of_kin" value="<?php echo $patientDetails['next_of_kin']; ?>" required>
            <br>

            <label for="updated_nok_contact_number">Updated NOK Contact Number:</label>
            <input type="text" name="updated_nok_contact_number" value="<?php echo $patientDetails['nok_contact_number']; ?>" required>
            <br>

            <input type="submit" name="edit_patient" value="Save Changes">
            
        </form>
    <?php endif; ?>
</body>
</html>
