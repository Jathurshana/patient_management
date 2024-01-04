<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('images/patient.jpg');
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
            position: relative;
        }
         
        img {
            max-width: 80px;
            height:auto;
            position: absolute;
            top:20px;
            right: 40px;
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
            width: 200px;
        }

        button:hover {
            background-color: black;
        }

        @media only screen and (max-width: 600px) {
            button {
                width: 100%;
                padding: 15px;
                font-size: 1.5em;
            }
        }
    </style>
</head>
<body>
<img src="images/logo.jpeg" alt="Hospital Logo">
    <h1>Welcome to the Admin Panel</h1>
    <button onclick="window.location.href='patient_records.php'">View Patient's Daily Records</button>
    <button onclick="window.location.href='patient_detail.php'">View Patient's Details</button>
    <button onclick="window.location.href='staff_detail.php'">View Staff Details</button>
    <button onclick="window.location.href='report.php'">Generate Report</button>
    <button onclick="window.location.href='add_staff.php'">Create Staff</button>
    <button onclick="window.location.href='add_patient.php'">Create Patient</button>
    <button onclick="window.location.href='logout.php'">Logout</button>
</body>
</html>
