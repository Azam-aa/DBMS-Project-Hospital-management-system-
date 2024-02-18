<?php
include('../db_connection.php');

$sql = "SELECT * FROM MedicalRecord";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Record Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #3498db;
            color: white;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .container {
            text-align: center;
            margin-top: 20px;
        }

        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    
    <h2>Medical Record Information</h2>
    <table border="1">
        <tr>
            <th>RecordID</th>
            <th>PatientID</th>
            <th>DoctorID</th>
            <th>Diagnosis</th>
            <th>Prescription</th>
            <th>DateRecorded</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["RecordID"]."</td>";
                echo "<td>".$row["PatientID"]."</td>";
                echo "<td>".$row["DoctorID"]."</td>";
                echo "<td>".$row["Diagnosis"]."</td>";
                echo "<td>".$row["Prescription"]."</td>";
                echo "<td>".$row["DateRecorded"]."</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No records found</td></tr>";
        }
        ?>
    </table>
    <div class="container">
        <!-- Button to insert data in patients -->
        <button onclick="location.href='insert_med.php'">Insert</button>
    </div>
    <div class="container">
        <!-- Button to insert data in patients -->
        <button onclick="location.href='delete_med.php'">Delete</button>
    </div>
    <div class="container">
        <!-- Button to insert data in patients -->
        <button onclick="location.href='edit_med.php'">Edit</button>
    </div>
    <?php
    $conn->close();
    ?>
</body>
</html>
