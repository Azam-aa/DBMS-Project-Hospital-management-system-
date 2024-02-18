<?php
include('../db_connection.php');

$sql = "SELECT * FROM Department";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department Information</title>
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

    <h2>Department Information</h2>
    <table border="1">
        <tr>
            <th>DepartmentID</th>
            <th>DepartmentName</th>
            <th>Description</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["DepartmentID"]."</td>";
                echo "<td>".$row["DepartmentName"]."</td>";
                echo "<td>".$row["Description"]."</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No records found</td></tr>";
        }
        ?>
    </table>
    <br>
    <div class="container">
        <!-- Button to insert data in patients -->
        <button onclick="location.href='insert_dep.php'">Insert</button>
    </div>
    <br>
    <div class="container">
        <!-- Button to insert data in patients -->
        <button onclick="location.href='delete_dep.php'">Delete</button>
    </div>
    <br>
    <div class="container">
        <!-- Button to insert data in patients -->
        <button onclick="location.href='edit_dep.php'">Edit</button>
    </div>
    <?php
    $conn->close();
    ?>
</body>

</html>
