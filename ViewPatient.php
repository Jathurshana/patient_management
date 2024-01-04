<?php
// Include your database connection code (e.g., config.php)
require_once('config.php');

// Check if the form is submitted for filtering
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selected_patient'])) {
    $selectedPatient = $_POST['selected_patient'];

    // Fetch the patient details based on the selected patient name
    $patientQuery = "SELECT * FROM patient WHERE name = '$selectedPatient'";
    $patientResult = $mysqli->query($patientQuery);

    if ($patientResult) {
        $patientDetails = $patientResult->fetch_assoc();
    } else {
        echo "Error: " . $mysqli->error;
    }
}

// Check if the form is submitted for editing


// Fetch all patient names for the dropdown
$allPatientsQuery = "SELECT name FROM patient";
$allPatientsResult = $mysqli->query($allPatientsQuery);

// Close the database connection
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Details</title>
    <!-- Add your styles if needed -->
</head>
<body>
    <h1>Patient Details</h1>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('images/patient_detail.jpg'); /* Replace 'your-background-image.jpg' with the actual path to your image */
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

        table {
            border-collapse: collapse;
            width: 50%;
            margin: 20px;
        }

        th, td {
            border: 3px solid #ddd;
            padding: 8px;
            text-align: left;
            background-color:grey;
        }

        th {
            background-color:grey;
        }

        select, input[type="submit"] {
            padding: 10px;
            margin: 10px;
            font-size: 1em;
          
        }
        button {
        background-color: #4caf50;
        color: #fff;
        border: none;
        padding: 10px 20px;
        font-size: 1em;
        cursor: pointer;
        border-radius: 4px;
    }

    button:hover {
        background-color: #45a049;
    }
    </style>

    <!-- Filter Form -->
    <form method="POST" action="">
        <label for="selected_patient">Select Patient:</label>
        <select name="selected_patient" required>
            <?php
            if ($allPatientsResult) {
                while ($patient = $allPatientsResult->fetch_assoc()) {
                    $name = $patient['name'];
                    echo "<option value='$name'>$name</option>";
                }
                $allPatientsResult->free_result();
            } else {
                echo "Error: " . $mysqli->error;
            }
            ?>
        </select>
        <input type="submit" value="Go">
      
    </form>

    <!-- Display Patient Details -->
    <?php if (isset($patientDetails)) : ?>
    <table border="1">
        <tr>
            <th>Name</th>
            <td><?php echo $patientDetails['name']; ?></td>
        </tr>
        <tr>
            <th>NHS Number</th>
            <td><?php echo $patientDetails['nhs_number']; ?></td>
        </tr>
        <tr>
            <th>Contact Number</th>
            <td><?php echo $patientDetails['contact_number']; ?></td>
        </tr>
        <tr>
            <th>Address</th>
            <td><?php echo $patientDetails['address']; ?></td>
        </tr>
        <tr>
            <th>Date of Birth</th>
            <td><?php echo $patientDetails['date_of_birth']; ?></td>
        </tr>
        <tr>
            <th>GP Name</th>
            <td><?php echo $patientDetails['gp_name']; ?></td>
        </tr>
        <tr>
            <th>Next of Kin</th>
            <td><?php echo $patientDetails['next_of_kin']; ?></td>
        </tr>
        <tr>
            <th>NOK Contact Number</th>
            <td><?php echo $patientDetails['nok_contact_number']; ?></td>
        </tr>
        <tr>
            <th>Additional Information</th>
            <td><?php echo $patientDetails['additional_info']; ?></td>
        </tr>
        <tr>
                <td colspan="2">
                    <button onclick="window.location.href='admin_panel.php'" style="background-color: #f44336; color: #fff; padding: 10px 20px; font-size: 1.2em; cursor: pointer; margin-top: 10px;">Back</button> 
                    <button onclick="window.location.href='logout.php'" style="background-color: #f44336; color: #fff; padding: 10px 20px; font-size: 1.2em; cursor: pointer; margin-top: 10px;">Logout</button> 
                </td>
            </tr>
    </table>


        <!-- Display other patient details here -->

        <!-- Form for Editing -->
     
    <?php endif; ?>
</body>
</html>