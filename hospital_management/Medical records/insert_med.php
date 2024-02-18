<?php
include('../db_connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve values from the form
    $recordID = mysqli_real_escape_string($conn, $_POST['record_id']);
    $patientID = mysqli_real_escape_string($conn, $_POST['patient_id']);
    $doctorID = mysqli_real_escape_string($conn, $_POST['doctor_id']);
    $diagnosis = mysqli_real_escape_string($conn, $_POST['diagnosis']);
    $prescription = mysqli_real_escape_string($conn, $_POST['prescription']);
    $dateRecorded = mysqli_real_escape_string($conn, $_POST['date_recorded']);

    // Check if the patient exists in the Patient table
    $checkPatientQuery = "SELECT * FROM Patient WHERE PatientID = '$patientID'";
    $result = $conn->query($checkPatientQuery);

    if ($result->num_rows > 0) {
        // Patient exists, proceed to insert into MedicalRecord
        $insertMedicalRecordQuery = "INSERT INTO MedicalRecord (RecordID, PatientID, DoctorID, Diagnosis, Prescription, DateRecorded)
                                     VALUES ('$recordID', '$patientID', '$doctorID', '$diagnosis', '$prescription', '$dateRecorded')";

        if ($conn->query($insertMedicalRecordQuery) === TRUE) {
            $confirmation_message = "Data inserted successfully!";
        } else {
            $error_message = "Error: " . $conn->error;
        }
    } else {
        $error_message = "Error: Patient with ID $patientID does not exist.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Medical Record</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 10px;
        }
        input {
            padding: 10px;
            margin-bottom: 20px;
        }
        button {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        .confirmation {
            color: green;
            margin-top: 20px;
        }
        .error {
            color: red;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Insert Medical Record</h2>

        <?php
        if (isset($confirmation_message)) {
            echo "<p class='confirmation'>$confirmation_message</p>";
        }

        if (isset($error_message)) {
            echo "<p class='error'>$error_message</p>";
        }
        ?>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="record_id">Record ID:</label>
            <input type="text" name="record_id" required>

            <label for="patient_id">Patient ID:</label>
            <input type="text" name="patient_id" required>

            <label for="doctor_id">Doctor ID:</label>
            <input type="text" name="doctor_id" required>

            <label for="diagnosis">Diagnosis:</label>
            <input type="text" name="diagnosis" required>

            <label for="prescription">Prescription:</label>
            <input type="text" name="prescription" required>

            <label for="date_recorded">Date Recorded:</label>
            <input type="date" name="date_recorded" required>

            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
