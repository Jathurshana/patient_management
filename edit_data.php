<?php
// Include your database connection code (e.g., config.php)
require_once('config.php');

// Check if the ID parameter is set in the URL
if (isset($_GET['id'])) {
    $dataID = $_GET['id'];

    // Fetch the data details based on the selected ID
    $dataQuery = "SELECT * FROM data WHERE id = $dataID";
    $dataResult = $mysqli->query($dataQuery);

    if ($dataResult) {
        $dataDetails = $dataResult->fetch_assoc();
    } else {
        echo "Error: " . $mysqli->error;
    }
}

// Check if the form is submitted for saving changes
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_data'])) {
    // Handle the logic for updating data details in the database
    // Extract other data fields similarly as shown below
    $updatedShiftTime = $_POST['updated_shift_time'];
    $updatedMedicineIntake = $_POST['updated_medicine_intake'];
    $updatedBloodSugar = $_POST['updated_blood_sugar'];
    $updatedBloodPressure = $_POST['updated_blood_pressure'];
    $updatedTemperature = $_POST['updated_temperature'];
    $updatedFoodIntake = $_POST['updated_food_intake'];
    $updatedDailyActivities = $_POST['updated_daily_activities'];

    // Assuming you have a data ID to identify the specific record in the database
    $dataID = $dataDetails['id'];

    // Update the data details in the database
    $updateQuery = "UPDATE data SET 
                    shift_time = '$updatedShiftTime', 
                    medicine_intake = '$updatedMedicineIntake', 
                    blood_sugar = '$updatedBloodSugar', 
                    blood_pressure = '$updatedBloodPressure', 
                    temperature = '$updatedTemperature', 
                    food_intake = '$updatedFoodIntake', 
                    daily_activities = '$updatedDailyActivities'
                    WHERE id = $dataID";

    $updateResult = $mysqli->query($updateQuery);

    if ($updateResult) {
        // Successfully updated
        echo "Successfully changed!";
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
    <title>Edit Data Details</title>
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
    </style>
</head>
<body>
    <h1>Edit Data Details</h1>

    <?php if (isset($dataDetails)) : ?>
        <!-- Form for Editing -->
        <form method="POST" action="">
            <!-- Display current data details -->

            <label for="updated_shift_time">Updated Shift Time:</label>
            <input type="text" name="updated_shift_time" value="<?php echo $dataDetails['shift_time']; ?>" required>
            <br>

            <label for="updated_medicine_intake">Updated Medicine Intake:</label>
            <input type="text" name="updated_medicine_intake" value="<?php echo $dataDetails['medicine_intake']; ?>" required>
            <br>

            <label for="updated_blood_sugar">Updated Blood Sugar:</label>
            <input type="text" name="updated_blood_sugar" value="<?php echo $dataDetails['blood_sugar']; ?>" required>
            <br>

            <label for="updated_blood_pressure">Updated Blood Pressure:</label>
            <input type="text" name="updated_blood_pressure" value="<?php echo $dataDetails['blood_pressure']; ?>" required>
            <br>

            <label for="updated_temperature">Updated Temperature:</label>
            <input type="text" name="updated_temperature" value="<?php echo $dataDetails['temperature']; ?>" required>
            <br>

            <label for="updated_food_intake">Updated Food Intake:</label>
            <input type="text" name="updated_food_intake" value="<?php echo $dataDetails['food_intake']; ?>" required>
            <br>

            <label for="updated_daily_activities">Updated Daily Activities:</label>
            <input type="text" name="updated_daily_activities" value="<?php echo $dataDetails['daily_activities']; ?>" required>
            <br>

            <input type="submit" name="edit_data" value="Save Changes">
            <button onclick="window.location.href='logout.php'" style="background-color: #f44336; color: #fff; padding: 10px 20px; font-size: 1.2em; cursor: pointer; margin-top: 10px;">Logout</button> 
        </form>
    <?php endif; ?>
</body>
</html>
