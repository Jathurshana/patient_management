<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('images/admin.jpg'); /* Replace 'your-background-image.jpg' with the actual path to your image */
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

        button {
            background-color: darkslategrey;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 1.2em;
            cursor: pointer;
            margin: 5px;
            text-decoration: none;
            width: 200px; /* Adjust the width as needed */
        }

        button:hover {
            background-color: black;
        }
    </style>
</head>
<body>
    <h1>Welcome to Dashboard</h1>
    <button onclick="window.location.href='patient_records.php'">View Patient's Daily Records</button>
    <button onclick="window.location.href='ViewPatient.php'">View Patient's Details</button>
    <button onclick="window.location.href='ViewStaff.php'">View Staff Details</button>
    <button onclick="window.location.href='add_staff.php'">Generate Report</button>
    <button onclick="window.location.href='add_staff.php'">Create Staff</button>
    <button onclick="window.location.href='add_patient.php'">Create Patient</button>
    <button onclick="window.location.href='logout.php'">Logout</button>
</body>
</html>
