<?php
include('../db_connection.php');

$confirmationMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $appointmentID = mysqli_real_escape_string($conn, $_POST['appointmentID']);

    // Delete the record from the Appointment table
    $sql = "DELETE FROM Appointment WHERE AppointmentID = $appointmentID";

    if ($conn->query($sql) === TRUE) {
        $confirmationMessage = "Appointment record has been successfully deleted from the database.";
    } else {
        $confirmationMessage = "Error deleting record: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Appointment</title>
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
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin: 10px 0;
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
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
    </style>
</head>
<body>
    <header>
        <h1>Delete Appointment</h1>
    </header>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="appointmentID">Appointment ID:</label>
        <input type="text" name="appointmentID" required>

        <button type="submit">Delete Appointment</button>
    </form>

    <div class="confirmation-message"><?php echo $confirmationMessage; ?></div>

</body>
</html>
