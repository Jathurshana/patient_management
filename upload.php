<?php
// Assuming you have a database connection in your config.php file
require_once('config.php');
session_start();

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process the submitted form data and insert into the data table
    $name = $_POST['name'];
    $working_shift = $_POST['working_shift'];
    $shift_time = $_POST['shift_time'];
    $medicine_intake = $_POST['medicine_intake'];
    $blood_sugar = $_POST['blood_sugar'];
    $blood_pressure = $_POST['blood_pressure'];
    $temperature = $_POST['temperature'];
    $food_intake = $_POST['food_intake'];
    $daily_activities = $_POST['daily_activities'];
    $additional_info = $_POST['additional_info'];
    $file_path = $_FILES['file_path']['name'];
    $targetDir = "photos/";
    $targetFile = $targetDir . basename($_FILES["file_path"]["name"]);
    move_uploaded_file($_FILES["file_path"]["tmp_name"], $targetFile);

    // Get patient_id based on the selected patient name
    $patientQuery = "SELECT id FROM patient WHERE name = '$name'";
    $patientResult = $mysqli->query($patientQuery);

    if ($patientResult) {
        $patientRow = $patientResult->fetch_assoc();

        if ($patientRow !== null) {
            $patient_id = $patientRow['id'];

            $staff_name = isset($_SESSION['staff_name']) ? $_SESSION['staff_name'] : 'Unknown Staff';

            // Check for previous MySQL errors
            echo $mysqli->error;

            // Use prepared statements to prevent SQL injection
            $sql = "INSERT INTO data (patient_id, staff_name, working_shift,shift_time,
            medicine_intake,blood_sugar,blood_pressure,temperature,food_intake,daily_activities,additional_info,
            file_path) VALUES ('$patient_id', '$staff_name', '$working_shift','$shift_time','$medicine_intake',
            '$blood_sugar','$blood_pressure','$temperature','$food_intake','$daily_activities','$additional_info','$file_path')";
    
    $stmt = $mysqli->prepare($sql);
    
    if ($stmt === false) {
        die("Error in SQL query: " . $mysqli->error);
    }
    
    // $stmt->bind_param("isssssssssss", $patient_id, $staff_name, $working_shift, $shift_time, $medicine_intake, 
    //     $blood_sugar, $blood_pressure, $temperature, $food_intake, $daily_activities, $additional_info, $file_path);

            // Handle file upload for patient photo
            if (move_uploaded_file($tempname, $folder)) {
                $msg = "Image uploaded successfully";
            } else {
                $msg = "Failed to upload image";
            }

            // Execute the prepared statement
            if ($stmt->execute()) {
                // Data was successfully inserted
                // No need to echo here, as we are redirecting immediately
            } else {
                // An error occurred
                echo "Error: " . $stmt->error;
            }

            // Close the prepared statement
            $stmt->close();

        } else {
            // No patient data found
            echo "Error: Patient data not found.";
        }
    } else {
        // Error in the query
        echo "Error: " . $mysqli->error;
    }

    $mysqli->close();

    // Redirect to staff_menu.php
    header("Location: staff_menu.php");
    exit();
}
?>