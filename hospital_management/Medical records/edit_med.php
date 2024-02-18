<?php
include('../db_connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve values from the form
    $recordID = $_POST['recordID'];
    $patientID = $_POST['patientID'];
    $doctorID = $_POST['doctorID'];
    $diagnosis = $_POST['diagnosis'];
    $prescription = $_POST['prescription'];
    $dateRecorded = $_POST['dateRecorded'];

    // Validate and update data in the MedicalRecord table
    $sql = "UPDATE MedicalRecord 
            SET PatientID = '$patientID', DoctorID = '$doctorID', Diagnosis = '$diagnosis', Prescription = '$prescription', DateRecorded = '$dateRecorded'
            WHERE RecordID = '$recordID'";

    if ($conn->query($sql) === TRUE) {
        $message = "Data updated successfully!";
    } else {
        $error_message = "Error: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Medical Record</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 400px;
            margin: 50px auto;
            background-color: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            width: 100%;
        }
        .message {
            color: green;
            text-align: center;
            margin-top: 10px;
        }
        .error-message {
            color: red;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Medical Record</h2>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="recordID">Record ID:</label>
            <input type="text" name="recordID" required>

            <label for="patientID">Patient ID:</label>
            <input type="text" name="patientID" required>

            <label for="doctorID">Doctor ID:</label>
            <input type="text" name="doctorID" required>

            <label for="diagnosis">Diagnosis:</label>
            <input type="text" name="diagnosis" required>

            <label for="prescription">Prescription:</label>
            <input type="text" name="prescription" required>

            <label for="dateRecorded">Date Recorded:</label>
            <input type="date" name="dateRecorded" required>

            <button type="submit">Submit</button>
        </form>

        <?php
        if (isset($message)) {
            echo "<p class='message'>$message</p>";
        }

        if (isset($error_message)) {
            echo "<p class='error-message'>$error_message</p>";
        }
        ?>
    </div>
</body>
</html>
