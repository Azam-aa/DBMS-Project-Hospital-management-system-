<?php
include('../db_connection.php');

$appointmentID = "";
$patientID = "";
$doctorID = "";
$appointmentDate = "";
$appointmentTime = "";
$status = "";
$confirmationMessage = "";

// Check if Appointment ID is provided in the URL
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['appointmentID'])) {
    $appointmentID = intval($_GET['appointmentID']);

    // Fetch existing appointment data for the given Appointment ID
    $fetchQuery = "SELECT * FROM Appointment WHERE AppointmentID = $appointmentID";
    $result = $conn->query($fetchQuery);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $patientID = $row['PatientID'];
        $doctorID = $row['DoctorID'];
        $appointmentDate = $row['AppointmentDate'];
        $appointmentTime = $row['AppointmentTime'];
        $status = $row['Status'];
    } else {
        $confirmationMessage = "Error: Appointment record not found.";
    }
}

// Check if the form is submitted for updating
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $appointmentID = mysqli_real_escape_string($conn, $_POST['appointmentID']);
    $patientID = mysqli_real_escape_string($conn, $_POST['patientID']);
    $doctorID = mysqli_real_escape_string($conn, $_POST['doctorID']);
    $appointmentDate = mysqli_real_escape_string($conn, $_POST['appointmentDate']);
    $appointmentTime = mysqli_real_escape_string($conn, $_POST['appointmentTime']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    // Update the record in the Appointment table
    $updateQuery = "UPDATE Appointment 
                    SET PatientID = '$patientID', DoctorID = '$doctorID', 
                        AppointmentDate = '$appointmentDate', 
                        AppointmentTime = '$appointmentTime', 
                        Status = '$status' 
                    WHERE AppointmentID = $appointmentID";

    if ($conn->query($updateQuery) === TRUE) {
        $confirmationMessage = "Appointment data updated successfully!";
    } else {
        $confirmationMessage = "Error updating appointment data: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Appointment Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        header {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            text-align: center;
        }
        form {
            max-width: 500px;
            margin: 20px auto;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        p {
            margin-top: 10px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .confirmation-message {
            color: #4CAF50;
            margin-top: 10px;
        }
        .error-message {
            color: red;
            margin-top: 10px;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <header>
        <h1>Edit Appointment Data</h1>
    </header>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="appointmentID">Appointment ID:</label>
        <input type="text" name="appointmentID" value="<?php echo $appointmentID; ?>" required>

        <label for="patientID">Patient ID:</label>
        <input type="text" name="patientID" value="<?php echo $patientID; ?>" required>

        <label for="doctorID">Doctor ID:</label>
        <input type="text" name="doctorID" value="<?php echo $doctorID; ?>" required>

        <label for="appointmentDate">Appointment Date:</label>
        <input type="date" name="appointmentDate" value="<?php echo $appointmentDate; ?>" required>

        <label for="appointmentTime">Appointment Time:</label>
        <input type="time" name="appointmentTime" value="<?php echo $appointmentTime; ?>" required>

        <label for="status">Status:</label>
        <select name="status" required>
            <option value="Scheduled" <?php echo ($status === 'Scheduled') ? 'selected' : ''; ?>>Scheduled</option>
            <option value="Completed" <?php echo ($status === 'Completed') ? 'selected' : ''; ?>>Completed</option>
            <option value="Cancelled" <?php echo ($status === 'Cancelled') ? 'selected' : ''; ?>>Cancelled</option>
        </select>

        <button type="submit">Update Appointment Data</button>
    </form>

    <?php
    if ($confirmationMessage) {
        echo "<p class='confirmation-message'>$confirmationMessage</p>";
    }
    ?>

</body>
</html>
