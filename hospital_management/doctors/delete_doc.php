<?php
include('../db_connection.php');

$confirmationMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $doctorID = mysqli_real_escape_string($conn, $_POST['doctorID']);

    // Check if the doctorID exists before attempting to delete
    $checkIfExists = "SELECT * FROM Doctor WHERE DoctorID = $doctorID";
    $result = $conn->query($checkIfExists);

    if ($result->num_rows > 0) {
        // Doctor exists, proceed with deletion
        $deleteQuery = "DELETE FROM Doctor WHERE DoctorID = $doctorID";

        if ($conn->query($deleteQuery) === TRUE) {
            $confirmationMessage = "Doctor data deleted successfully!";
        } else {
            $confirmationMessage = "Error deleting doctor data: " . $conn->error;
        }
    } else {
        $confirmationMessage = "Doctor with ID $doctorID does not exist.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Doctor Data</title>
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
        input {
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
        <h1>Delete Doctor Data</h1>
    </header>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="doctorID">Doctor ID:</label>
        <input type="text" name="doctorID" required>

        <button type="submit">Delete Doctor Data</button>
    </form>

    <?php
    if ($confirmationMessage) {
        echo "<div class='confirmation-message'>$confirmationMessage</div>";
    }
    ?>
</body>
</html>
