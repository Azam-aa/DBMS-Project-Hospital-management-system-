<?php
// Include the database connection file
include('../db_connection.php');

// Define variables
$updateMessage = $deleteMessage = "";

// Check if the form is submitted for delete operation
if (isset($_POST['delete'])) {
    // Retrieve selected records to delete
    $selectedPatients = $_POST['selectedPatients'];

    // Check if any records are selected
    if (!empty($selectedPatients)) {
        // Convert the array of selected IDs to a comma-separated string
        $selectedPatientsString = implode(",", $selectedPatients);

        // Delete selected records from the Patient table
        $deleteSql = "DELETE FROM Patient WHERE PatientID IN ($selectedPatientsString)";
        if ($conn->query($deleteSql) === TRUE) {
            $deleteMessage = "Selected records deleted successfully!";
        } else {
            $deleteMessage = "Error deleting records: " . $conn->error;
        }
    }
}

// Fetch all patient records
$sql = "SELECT * FROM Patient";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update/Delete Patient Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            text-align: center;
        }
        form {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        button {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        .confirmation-message {
            margin-top: 20px;
            padding: 10px;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
            color: #155724;
        }
    </style>
</head>
<body>
    <header>
        <h1>Delete Patient Data</h1>
    </header>

    <?php
    if ($deleteMessage) {
        echo "<div class='confirmation-message'>$deleteMessage</div>";
    }
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th>PatientID</th>
                    <th>FirstName</th>
                    <th>LastName</th>
                    <th>DateOfBirth</th>
                    <th>Gender</th>
                    <th>ContactNumber</th>
                    <th>Address</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td><input type='checkbox' name='selectedPatients[]' value='".$row["PatientID"]."'></td>";
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
                    echo "<tr><td colspan='8'>No records found</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <button type="submit" name="delete">Delete Selected</button>
    </form>
</body>
</html>
