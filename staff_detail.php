<?php
// Include your database connection code (e.g., config.php)
require_once('config.php');

// Check if the form is submitted for filtering
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selected_staff'])) {
    $selectedStaff = $_POST['selected_staff'];

    // Fetch the staff details based on the selected staff username
    $staffQuery = "SELECT * FROM staff WHERE FullName = '$selectedStaff'";
    $staffResult = $mysqli->query($staffQuery);

    if ($staffResult) {
        $staffDetails = $staffResult->fetch_assoc();
    } else {
        echo "Error: " . $mysqli->error;
    }
}

// Fetch all staff usernames for the dropdown
$allStaffQuery = "SELECT FullName FROM staff";
$allStaffResult = $mysqli->query($allStaffQuery);

// Close the database connection
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Details</title>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Get the select element
            var selectElement = document.querySelector('select[name="selected_staff"]');

            // Check if there is a stored value for the selected option
            var storedValue = localStorage.getItem('selected_staff');
            if (storedValue) {
                // Set the stored value as the selected option
                selectElement.value = storedValue;
            }

            // Add an event listener to the form to store the selected option before submission
            var formElement = document.querySelector('form');
            formElement.addEventListener('submit', function () {
                localStorage.setItem('selected_staff', selectElement.value);
            });
        });
    </script>
    <!-- Add your styles if needed -->
</head>
<body>
    <h1>Staff Details</h1>
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
            background-color: grey;
        }

        th {
            background-color: grey;
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
        <label for="selected_staff">Select Staff:</label>
        <select name="selected_staff" required>
            <?php
            if ($allStaffResult) {
                while ($staff = $allStaffResult->fetch_assoc()) {
                    $FullName= $staff['FullName'];
                    $selected = ($FullName == $selectedStaff) ? 'selected' : ''; // Check if it's the previously selected option
                    echo "<option value='$FullName' $selected>$FullName</option>";
                }
                $allStaffResult->free_result();
            } else {
                echo "Error: " . $mysqli->error;
            }
            ?>
        </select>
        <input type="submit" value="Go">
    </form>

    <!-- Display Staff Details -->
    <?php if (isset($staffDetails)) : ?>
        <table border="1">
            <tr>
                <th>FullName</th>
                <td><?php echo $staffDetails['FullName']; ?></td>
                
            </tr>
            <tr>
                <th>designation</th>
                <td><?php echo $staffDetails['designation']; ?></td>
                
            </tr>
            <tr>
                <th>contact_number</th>
                <td><?php echo $staffDetails['contact_number']; ?></td>
                
            </tr>
            <tr>
                <th>address</th>
                <td><?php echo $staffDetails['address']; ?></td>
                
            </tr>
            <tr>
                <th>date_of_birth</th>
                <td><?php echo $staffDetails['date_of_birth']; ?></td>
                
            </tr>
            <tr>
                <th>NI_number</th>
                <td><?php echo $staffDetails['ni_number']; ?></td>
                
            </tr>
            <tr>
                <th>next_of_kin</th>
                <td><?php echo $staffDetails['next_of_kin']; ?></td>
                
            </tr>
            <tr>
                <th>nok_contact_number</th>
                <td><?php echo $staffDetails['nok_contact_number']; ?></td>
                
            </tr>
            <tr>
                <th>password</th>
                <td><?php echo $staffDetails['password']; ?></td>
                
            </tr>
            <!-- Add other staff details here -->

            <tr>
                <td colspan="2">
                    <form method="GET" action="edit_staff.php">
                        <input type="hidden" name="FullName" value="<?php echo $staffDetails['FullName']; ?>">
                        <button type="submit">Edit</button>
                    </form>
                    <button onclick="window.location.href='admin_panel.php'" style="background-color: #f44336; color: #fff; padding: 10px 20px; font-size: 1.2em; cursor: pointer; margin-top: 10px;">Back</button> 
                   
                </td>
          
            </tr>
        </table>

    <?php endif; ?>
</body>
</html>
