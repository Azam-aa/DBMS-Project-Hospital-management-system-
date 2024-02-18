<?php
include('../db_connection.php');

$doctorID = "";
$confirmationMessage = "";
$doctorData = array(); // Initialize $doctorData as an empty array

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $doctorID = mysqli_real_escape_string($conn, $_POST['doctorID']);

    // Fetch the existing doctor data based on DoctorID
    $query = "SELECT * FROM Doctor WHERE DoctorID = $doctorID";
    $result = $conn->query($query);

    if ($result) {
        $doctorData = $result->fetch_assoc();

        if (!$doctorData) {
            $confirmationMessage = "Doctor with ID $doctorID does not exist.";
        }
    } else {
        $confirmationMessage = "Error fetching doctor data: " . $conn->error;
    }
}

// Check if the form is submitted for updating doctor data
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
    $specialty = mysqli_real_escape_string($conn, $_POST['specialty']);
    $contactNumber = mysqli_real_escape_string($conn, $_POST['contactNumber']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Update doctor data in the database
    $updateQuery = "UPDATE Doctor 
                    SET FirstName='$firstName', LastName='$lastName', Specialty='$specialty', 
                        ContactNumber='$contactNumber', Email='$email'
                    WHERE DoctorID = $doctorID";

    if ($conn->query($updateQuery) === TRUE) {
        $confirmationMessage = "Doctor data updated successfully!";
    } else {
        $confirmationMessage = "Error updating doctor data: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Doctor Data</title>
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
        input, textarea {
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
        <h1>Edit Doctor Data</h1>
    </header>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="doctorID">Doctor ID:</label>
        <input type="text" name="doctorID" value="<?php echo $doctorID; ?>" required>

        <label for="firstName">First Name:</label>
        <input type="text" name="firstName" value="<?php echo isset($doctorData['FirstName']) ? $doctorData['FirstName'] : ''; ?>" required>

        <label for="lastName">Last Name:</label>
        <input type="text" name="lastName" value="<?php echo isset($doctorData['LastName']) ? $doctorData['LastName'] : ''; ?>" required>

        <label for="specialty">Specialty:</label>
        <input type="text" name="specialty" value="<?php echo isset($doctorData['Specialty']) ? $doctorData['Specialty'] : ''; ?>" required>

        <label for="contactNumber">Contact Number:</label>
        <input type="tel" name="contactNumber" value="<?php echo isset($doctorData['ContactNumber']) ? $doctorData['ContactNumber'] : ''; ?>" required>

        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo isset($doctorData['Email']) ? $doctorData['Email'] : ''; ?>" required>

        <button type="submit" name="update">Update Doctor Data</button>
    </form>

    <?php
    if ($confirmationMessage) {
        echo "<div class='confirmation-message'>$confirmationMessage</div>";
    }
    ?>
</body>
</html>
