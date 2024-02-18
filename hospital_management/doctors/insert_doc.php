<?php
include('../db_connection.php');

$confirmationMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $doctorID = mysqli_real_escape_string($conn, $_POST['doctorID']);
    $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
    $specialty = mysqli_real_escape_string($conn, $_POST['specialty']);
    $contactNumber = mysqli_real_escape_string($conn, $_POST['contactNumber']);
    $email = mysqli_real_escape_string($conn, $_POST['email']); // Added email attribute

    $sql = "INSERT INTO Doctor (DoctorID, FirstName, LastName, Specialty, ContactNumber, Email) 
            VALUES ('$doctorID', '$firstName', '$lastName', '$specialty', '$contactNumber', '$email')";

    if ($conn->query($sql) === TRUE) {
        $confirmationMessage = "Data inserted successfully!";
    } else {
        $confirmationMessage = "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Doctor Data</title>
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
        <h1>Insert Doctor Data</h1>
    </header>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="doctorID">Doctor ID:</label>
        <input type="text" name="doctorID" required>

        <label for="firstName">First Name:</label>
        <input type="text" name="firstName" required>

        <label for="lastName">Last Name:</label>
        <input type="text" name="lastName" required>

        <label for="specialty">Specialty:</label>
        <input type="text" name="specialty" required>

        <label for="contactNumber">Contact Number:</label>
        <input type="tel" name="contactNumber" required>

        <label for="email">Email:</label>
        <input type="email" name="email" required>

        <button type="submit">Submit</button>
    </form>

    <?php
    if ($confirmationMessage) {
        echo "<div class='confirmation-message'>$confirmationMessage</div>";
    }
    ?>
</body>
</html>
