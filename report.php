<!-- report_form.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        h1 {
            color: #333;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input,
        select {
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
    <h1>Generate Report</h1>
    <form action="generate_report.php" method="POST" target="_blank">
        <label for="from_date">From Date:</label>
        <input type="date" id="from_date" name="from_date" required>

        <label for="to_date">To Date:</label>
        <input type="date" id="to_date" name="to_date" required>

        <label for="name">Patient Name:</label>
        <select name="name" required>
        <?php
           require_once('config.php');
           session_start();
           
           // Enable error reporting for debugging
           error_reporting(E_ALL);
           ini_set('display_errors', 1);
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

        <input type="submit" value="Generate Report">
    </form>
</body>
</html>
