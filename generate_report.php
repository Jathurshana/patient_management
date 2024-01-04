<?php
require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate form data
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];
    $patient_name = $_POST['name'];

    // Use the form data to query the database and fetch the patient details
    $query = "SELECT * FROM patient WHERE name = '$patient_name'";
    $result = $mysqli->query($query);

    if ($result) {
        if ($result->num_rows > 0) {
            $dataRow = $result->fetch_assoc(); // Fetch patient details

            // Display or process patient details
            echo "<h1>Patient Report for $patient_name</h1>";
            echo "<table border='1'>";

            // Display table headers with column names
            echo "<tr>";
            echo "<th>Staff Name</th>";
            echo "<th>Medicine Intake</th>";
            echo "<th>Blood Sugar</th>";
            echo "<th>Blood Pressure</th>";
            echo "<th>Temperature</th>";
            echo "<th>Food Intake</th>";
            echo "<th>Daily Activities</th>";
            echo "<th>Additional Info</th>";
            echo "<th>Patient_photo</th>";
            echo "</tr>";

            // Display data row
            echo "<tr>";
            echo "<td>" . (isset($dataRow['staff_name']) ? $dataRow['staff_name'] : 'N/A') . "</td>";
            echo "<td>" . (isset($dataRow['working_shift']) ? $dataRow['working_shift'] : 'N/A') . "</td>";
            echo "<td>" . (isset($dataRow['shift_time']) ? $dataRow['shift_time'] : 'N/A') . "</td>";
            echo "<td>" . (isset($dataRow['medicine_intake']) ? $dataRow['medicine_intake'] : 'N/A') . "</td>";
            echo "<td>" . (isset($dataRow['blood_sugar']) ? $dataRow['blood_sugar'] : 'N/A') . "</td>";
            echo "<td>" . (isset($dataRow['blood_pressure']) ? $dataRow['blood_pressure'] : 'N/A') . "</td>";
            echo "<td>" . (isset($dataRow['temperature']) ? $dataRow['temperature'] : 'N/A') . "</td>";
            echo "<td>" . (isset($dataRow['food_intake']) ? $dataRow['food_intake'] : 'N/A') . "</td>";
            echo "<td>" . (isset($dataRow['daily_activities']) ? $dataRow['daily_activities'] : 'N/A') . "</td>";
            echo "<td>" . (isset($dataRow['additional_info']) ? $dataRow['additional_info'] : 'N/A') . "</td>";
            echo "</tr>";
            echo "</table>";
        } else {
            echo "No data found for the selected patient.";
        }

        // Free result set
        $result->free_result();
    } else {
        echo "Error: " . $mysqli->error;
    }
}
?>
