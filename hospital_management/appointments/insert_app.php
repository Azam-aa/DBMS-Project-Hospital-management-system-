<?php
include('../db_connection.php');

$confirmationMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $appointmentData = $_POST['appointments'];

    foreach ($appointmentData as $appointment) {
        $appointmentID = mysqli_real_escape_string($conn, $appointment['appointmentID']);
        $patientID = mysqli_real_escape_string($conn, $appointment['patientID']);
        $doctorID = mysqli_real_escape_string($conn, $appointment['doctorID']);
        $appointmentDate = mysqli_real_escape_string($conn, $appointment['appointmentDate']);
        $appointmentTime = mysqli_real_escape_string($conn, $appointment['appointmentTime']);
        $status = mysqli_real_escape_string($conn, $appointment['status']);

        $sql = "INSERT INTO Appointment (AppointmentID, PatientID, DoctorID, AppointmentDate, AppointmentTime, Status)
                VALUES ('$appointmentID', '$patientID', '$doctorID', '$appointmentDate', '$appointmentTime', '$status')";

        if ($conn->query($sql) !== TRUE) {
            $confirmationMessage = "Error: " . $sql . "<br>" . $conn->error;
            break; // Exit the loop on the first error
        }
    }

    if (empty($confirmationMessage)) {
        $confirmationMessage = "Data inserted successfully!";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Appointment Data</title>
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
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        input, select {
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
    </style>
</head>
<body>
    <header>
        <h1>Insert Appointment Data</h1>
    </header>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="appointmentID">Appointment ID:</label>
        <input type="text" name="appointments[0][appointmentID]" required>

        <label for="patientID">Patient ID:</label>
        <input type="text" name="appointments[0][patientID]" required>

        <label for="doctorID">Doctor ID:</label>
        <input type="text" name="appointments[0][doctorID]" required>

        <label for="appointmentDate">Appointment Date:</label>
        <input type="date" name="appointments[0][appointmentDate]" required>

        <label for="appointmentTime">Appointment Time:</label>
        <input type="time" name="appointments[0][appointmentTime]" required>

        <label for="status">Status:</label>
        <select name="appointments[0][status]" required>
            <option value="Scheduled">Scheduled</option>
            <option value="Completed">Completed</option>
            <option value="Canceled">Canceled</option>
        </select>

        <button type="button" onclick="addAppointmentInput()">Add Another Appointment</button>
        <button type="submit">Submit</button>
    </form>

    <?php
    if ($confirmationMessage) {
        echo "<div class='confirmation-message'>$confirmationMessage</div>";
    }
    ?>

    <script>
        // JavaScript function to add another appointment input dynamically
        function addAppointmentInput() {
            const appointmentsContainer = document.querySelector('#appointments-container');
            const newAppointmentInput = appointmentsContainer.firstElementChild.cloneNode(true);
            appointmentsContainer.appendChild(newAppointmentInput);
        }
    </script>
</body>
</html>
