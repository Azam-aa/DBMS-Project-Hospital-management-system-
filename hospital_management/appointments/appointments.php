<?php
include('../db_connection.php');

$sql = "SELECT * FROM Appointment";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h2 {
            color: #333;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #333;
            color: white;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .container {
            text-align: center;
            margin-top: 10px;
        }

        button {
            padding: 10px;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #555;
        }
    </style>
</head>

<body>

    <h2>Appointment Information</h2>
    <table border="1">
        <tr>
            <th>AppointmentID</th>
            <th>PatientID</th>
            <th>DoctorID</th>
            <th>AppointmentDate</th>
            <th>AppointmentTime</th>
            <th>Status</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["AppointmentID"] . "</td>";
                echo "<td>" . $row["PatientID"] . "</td>";
                echo "<td>" . $row["DoctorID"] . "</td>";
                echo "<td>" . $row["AppointmentDate"] . "</td>";
                echo "<td>" . $row["AppointmentTime"] . "</td>";
                echo "<td>" . $row["Status"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No records found</td></tr>";
        }
        ?>
    </table>
    <br>
    <div class="container">
        <!-- Button to insert data in patients -->
        <button onclick="location.href='insert_app.php'">Insert</button>
    </div>
    <br>
    <div class="container">
        <!-- Button to insert data in patients -->
        <button onclick="location.href='delete_app.php'">Delete</button>
    </div>
    <br>
    <div class="container">
        <!-- Button to insert data in patients -->
        <button onclick="location.href='edit_app.php'">Edit</button>
    </div>
    <?php
    $conn->close();
    ?>
</body>

</html>
