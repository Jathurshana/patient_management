

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter Data</title>
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

        select,
        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
            padding: 10px 20px;
            font-size: 1.2em;
            border: none;
            border-radius: 4px;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
   
</head>
<body>
    <h1>Enter Data</h1>
    <form method="POST" action="upload.php" enctype="multipart/form-data">
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
                    echo "<option value='$name'>$name</option>";
                }

                // Free result set
                $result->free_result();
            } else {
                echo "Error: " . $mysqli->error;
            }

            // Close the database connection
            $mysqli->close();
            ?>
        </select>
        <br>

        <label for="working_shift">Working Shift:</label>
        <select name="working_shift" required>
            <option value="morning">Morning</option>
            <option value="evening">Evening</option>
            <option value="night">Night</option>
        </select>
        <br>
        <label for="shift_time">Shift Time:</label>
        <input type="text" name="shift_time" required>
        <br>
      

        <label for="medicine_intake">Medicine Intake:</label>
        <input type="text" name="medicine_intake" required>
        <br>
        <label for="sats_record">S.A.T.S Record:</label><br>
        <label for="blood_sugar">Blood Sugar:</label>
        <input type="text" name="blood_sugar" required><br>
        <label for="blood_pressure">Blood Pressure:</label>
        <input type="text" name="blood_pressure" required><br>
        <label for="temperature">Temperature:</label>
        <input type="text" name="temperature" required><br>

        <label for="food_intake">Food Intake:</label>
        <input type="text" name="food_intake" required>
        <br>

        <label for="daily_activities">Daily Activities:</label>
        <input type="text" name="daily_activities" required>
        <br>

        <label for="file_path">Patient Photo:</label>
        <input type="file" name="file_path" id="file_path" required>
        <br>
        

        <label for="additional_info">Additional Information:</label>
        <textarea name="additional_info" rows="4" ></textarea>
        <br>

        <button type="submit">Submit</button>
        <button onclick="window.location.href='staff_menu.php'" style="background-color: #f44336; color: #fff; padding: 10px 20px; font-size: 1.2em; cursor: pointer; margin-top: 10px;">Cancel</button> 
        
    </form>
    
</body>
</html>