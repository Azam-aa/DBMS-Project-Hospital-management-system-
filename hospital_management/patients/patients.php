<?php
include('../db_connection.php');

$sql = "SELECT * FROM Patient";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
            margin: 10px 0;
            
        }

        button {
            padding: 10px;
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
    <h2>Patient Information</h2>
    <table border="1">
        <tr>
            <th>PatientID</th>
            <th>FirstName</th>
            <th>LastName</th>
            <th>DateOfBirth</th>
            <th>Gender</th>
            <th>ContactNumber</th>
            <th>Address</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["PatientID"]."</td>";
                echo "<td>".$row["FirstName"]."</td>";
                echo "<td>".$row["LastName"]."</td>";
                echo "<td>".$row["DateOfBirth"]."</td>";
                echo "<td>".$row["Gender"]."</td>";
                echo "<td>".$row["ContactNumber"]."</td>";
                echo "<td>".$row["Address"]."</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No records found</td></tr>";
        }
        ?>
    </table>
    <br>
    <div class="container">
        <!-- Button to insert data in patients -->
        <button onclick="location.href='insert_patient.php'">Insert</button>
    </div>
    <br>
    <div class="container">
        <!-- Button to insert data in patients -->
        <button onclick="location.href='delete_patient.php'">Delete</button>
    </div>
    <br>
    <div class="container">
        <!-- Button to insert data in patients -->
        <button onclick="location.href='edit_patient.php'">Edit</button>
    </div>
    <button></button>

    <?php
    $conn->close();
    ?>
</body>
</html>
