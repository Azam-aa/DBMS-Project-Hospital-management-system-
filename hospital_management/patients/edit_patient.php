<?php
// Include the database connection file
include('../db_connection.php');

// Define variables
$confirmationMessage = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if a record is selected
    if (isset($_POST['recordId']) && is_numeric($_POST['recordId'])) {
        // Retrieve values from the form
        $recordId = $_POST['recordId'];
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $contactNumber = $_POST['contactNumber'];
        $address = $_POST['address'];

        // Update data in the Patient table
        $sql = "UPDATE Patient 
                SET FirstName='$firstName', LastName='$lastName', DateOfBirth='$dob', 
                Gender='$gender', ContactNumber='$contactNumber', Address='$address' 
                WHERE PatientID=$recordId";

        if ($conn->query($sql) === TRUE) {
            $confirmationMessage = "Data updated successfully!";
        } else {
            $confirmationMessage = "Error updating record: " . $conn->error;
        }
    } else {
        $confirmationMessage = "Please select a record to edit.";
    }
}

// Retrieve all records from the Patient table
$sqlSelectAll = "SELECT * FROM Patient";
$resultSelectAll = $conn->query($sqlSelectAll);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Patient Data</title>
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
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
        }
        button {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            width: 100%;
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <header>
        <h1>Edit Patient Data</h1>
    </header>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <table>
            <tr>
                <th>Select</th>
                <th>Patient ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Date of Birth</th>
                <th>Gender</th>
                <th>Contact Number</th>
                <th>Address</th>
            </tr>
            <?php
            if ($resultSelectAll->num_rows > 0) {
                while ($row = $resultSelectAll->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td><input type='radio' name='recordId' value='" . $row['PatientID'] . "'></td>";
                    echo "<td>" . $row['PatientID'] . "</td>";
                    echo "<td>" . $row['FirstName'] . "</td>";
                    echo "<td>" . $row['LastName'] . "</td>";
                    echo "<td>" . $row['DateOfBirth'] . "</td>";
                    echo "<td>" . $row['Gender'] . "</td>";
                    echo "<td>" . $row['ContactNumber'] . "</td>";
                    echo "<td>" . $row['Address'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No records found</td></tr>";
            }
            ?>
        </table>

        <label for="firstName">First Name:</label>
        <input type="text" name="firstName" required>

        <label for="lastName">Last Name:</label>
        <input type="text" name="lastName" required>

        <label for="dob">Date of Birth:</label>
        <input type="date" name="dob" required>

        <label for="gender">Gender:</label>
        <select name="gender" required>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select>

        <label for="contactNumber">Contact Number:</label>
        <input type="tel" name="contactNumber" required>

        <label for="address">Address:</label>
        <textarea name="address" rows="4" required></textarea>

        <button type="submit">Edit Record</button>
    </form>

    <?php
    if ($confirmationMessage) {
        echo "<div class='confirmation-message'>$confirmationMessage</div>";
    }
    ?>
</body>
</html>
