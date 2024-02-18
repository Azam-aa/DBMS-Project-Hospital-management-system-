<?php
include('../db_connection.php');

$sql = "SELECT * FROM Doctor";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Information</title>
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

    <h2>Doctor Information</h2>
    <table border="1">
        <tr>
            <th>DoctorID</th>
            <th>FirstName</th>
            <th>LastName</th>
            <th>Specialty</th>
            <th>ContactNumber</th>
            <th>Email</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["DoctorID"]."</td>";
                echo "<td>".$row["FirstName"]."</td>";
                echo "<td>".$row["LastName"]."</td>";
                echo "<td>".$row["Specialty"]."</td>";
                echo "<td>".$row["ContactNumber"]."</td>";
                echo "<td>".$row["Email"]."</td>";
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
        <button onclick="location.href='insert_doc.php'">Insert</button>
    </div>
    <br>
    <div class="container">
        <!-- Button to insert data in patients -->
        <button onclick="location.href='delete_doc.php'">Delete</button>
    </div>
    <br>
    <div class="container">
        <!-- Button to insert data in patients -->
        <button onclick="location.href='edit_doc.php'">Edit</button>
    </div>
    <?php
    $conn->close();
    ?>
</body>

</html>
