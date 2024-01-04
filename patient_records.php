<?php 
require_once('config.php');
session_start(); // Make sure to start the session on the view_data.php page
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['selected_patient_name'] = $_POST['name'];
    $_SESSION['selected_date'] = $_POST['date'];
}
// Retrieve the staff name from the session
$staff_name = isset($_SESSION['staff_name']) ? $_SESSION['staff_name'] : 'Unknown Staff';

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <title>View Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('images/view.jpg');
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

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        label {
            width: 100%;
            margin-bottom: 8px;
            text-align: left;
        }

        select,
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
            color: black;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        table {
            width: 80%;
            margin-top: 20px;
            border-collapse: collapse;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            overflow-x: auto;
        }

        th, td {
            padding: 10px;
            text-align: center;
            border: 3px solid #ddd;
        }

        th {
            background-color: #4caf50;
            color: black;
        }

        p {
            font-size: 1.2em;
            margin: 10px 0;
        }

        button {
            background-color: #f44336;
            color: #fff;
            padding: 10px 20px;
            font-size: 1.2em;
            cursor: pointer;
            margin-top: 10px;
        }
        
    </style>


</head>
<body>
    <h1>View Data</h1>

    <!-- Filter Form -->
    <form method="POST" action="">
        <label for="name">Patient Name:</label>
        <select name="name" required>
            <?php
            // Fetch patient names from the database and populate the dropdown
            $query = "SELECT * FROM patient";
            $result = $mysqli->query($query);

            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    $name = $row['name'];
                    $selected = (isset($_SESSION['selected_patient_name']) && $name == $_SESSION['selected_patient_name']) ? 'selected' : '';
                    echo "<option value='$name' $selected>$name</option>";
                }

                // Free result set
                $result->free_result();
            } else {
                echo "Error: " . $mysqli->error;
            }
            ?>
        </select>
        <br>

        <label for="date">Date:</label>
        <input type="date" name="date" required value="<?php echo isset($_SESSION['selected_date']) ? $_SESSION['selected_date'] : ''; ?>">
        <br>

        <input type="submit" value="Filter">
        <button type="button" onclick="goTo('admin_panel.php')" style="background-color: #f44336; color: #fff; padding: 10px 20px; font-size: 1.2em; cursor: pointer; margin-top: 10px;">Back</button>
       

    </form>
    <?php
    // Display filtered data
    // Display filtered data
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $patient_name = $_POST['name'];  // Fix the field name here
        $date = $_POST['date'];
      
    
        // Fetch data based on filter criteria
        $dataQuery = "SELECT data.*, patient.name AS patient_name
        FROM data 
        INNER JOIN patient ON data.patient_id = patient.id 
        WHERE patient.name = '$patient_name' 
        AND DATE(data.timestamp) = '$date'
        ORDER BY CASE WHEN data.working_shift = 'Morning' THEN 1
                      WHEN data.working_shift = 'Evening' THEN 2
                      WHEN data.working_shift = 'Night' THEN 3
                      ELSE 4
                 END, data.shift_time ASC";
    
    
    
        $dataResult = $mysqli->query($dataQuery);
       
    
    
        if ($dataResult) {
            echo "<table border='1'>";
            
            // Display table headers with column names
            echo "<tr>";
             echo "<th>Staff Name</th>";
            echo "<th>Working Shift</th>";
            echo "<th>Shift Time</th>";
            echo "<th>Medicine Intake</th>";
            echo "<th>Blood Sugar</th>";
            echo "<th>Blood Pressure</th>";
            echo "<th>Temperature</th>";
            echo "<th>Food Intake</th>";
            echo "<th>Daily Activities</th>";
            echo "<th>Date & Time</th>";
            echo "</tr>";
        
            // Display data rows
            while ($dataRow = $dataResult->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $dataRow['staff_name'] . "</td>";
                echo "<td>" . $dataRow['working_shift'] . "</td>";
                echo "<td>" . $dataRow['shift_time'] . "</td>";
                echo "<td>" . $dataRow['medicine_intake'] . "</td>";
                echo "<td>" . $dataRow['blood_sugar'] . "</td>";
                echo "<td>" . $dataRow['blood_pressure'] . "</td>";
                echo "<td>" . $dataRow['temperature'] . "</td>";
                echo "<td>" . $dataRow['food_intake'] . "</td>";
                echo "<td>" . $dataRow['daily_activities'] . "</td>";
                echo "<td>" . $dataRow['timestamp'] . "</td>";
                echo "<td><a href='edit_data.php?id=" . $dataRow['id'] . "'>Edit</a></td>";
                echo "</tr>";
        }
    
        echo "</table>";


        // Free result set
        $dataResult->free_result();
    } else {
        echo "Error: " . $mysqli->error;
    }
}

// Close the database connection
unset($_SESSION['selected_patient_name']);
unset($_SESSION['selected_date']);



    // Close the database connection
    $mysqli->close();
    ?>
     <script>
        function goTo(url) {
            window.location.href = url;
        }
    </script>
</body>
</html>
