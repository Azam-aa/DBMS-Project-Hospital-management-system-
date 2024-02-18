<?php
include('../db_connection.php');

$confirmationMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patientData = $_POST['patients'];

    foreach ($patientData as $patient) {
        $patientID = mysqli_real_escape_string($conn, $patient['patientID']);
        $firstName = mysqli_real_escape_string($conn, $patient['firstName']);
        $lastName = mysqli_real_escape_string($conn, $patient['lastName']);
        $dob = mysqli_real_escape_string($conn, $patient['dob']);
        $gender = mysqli_real_escape_string($conn, $patient['gender']);
        $contactNumber = mysqli_real_escape_string($conn, $patient['contactNumber']);
        $address = mysqli_real_escape_string($conn, $patient['address']);

        $sql = "INSERT INTO Patient (PatientID, FirstName, LastName, DateOfBirth, Gender, ContactNumber, Address) 
                VALUES ('$patientID', '$firstName', '$lastName', '$dob', '$gender', '$contactNumber', '$address')";

        if ($conn->query($sql) !== TRUE) {
            $confirmationMessage = "Error: " . $sql . "<br>" . $conn->error;
            break;
        }
    }

    if (empty($confirmationMessage)) {
        $confirmationMessage = "Data inserted successfully!";
    }
}
?>

<!-- Rest of the HTML form remains the same -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Patient Data</title>
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
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            box-sizing: border-box;
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
        <h1>Insert Patient Data</h1>
    </header>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <!-- Multiple patient inputs -->
        <div id="patients-container">
            <div class="patient-input">
                <label for="patientID">Patient ID:</label>
                <input type="text" name="patients[0][patientID]" required>

                <label for="firstName">First Name:</label>
                <input type="text" name="patients[0][firstName]" required>

                <label for="lastName">Last Name:</label>
                <input type="text" name="patients[0][lastName]" required>

                <label for="dob">Date of Birth:</label>
                <input type="date" name="patients[0][dob]" required>

                <label for="gender">Gender:</label>
                <select name="patients[0][gender]" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>

                <label for="contactNumber">Contact Number:</label>
                <input type="tel" name="patients[0][contactNumber]" required>

                <label for="address">Address:</label>
                <textarea name="patients[0][address]" rows="4" required></textarea>
            </div>
        </div>

        <button type="button" onclick="addPatientInput()">Add Another Patient</button>
        <button type="submit">Submit</button>
    </form>

    <?php
    if ($confirmationMessage) {
        echo "<div class='confirmation-message'>$confirmationMessage</div>";
    }
    ?>

    <script>
        // JavaScript function to add another patient input dynamically
        function addPatientInput() {
            const patientsContainer = document.getElementById('patients-container');
            const newPatientInput = patientsContainer.children[0].cloneNode(true);
            patientsContainer.appendChild(newPatientInput);
        }
    </script>
</body>
</html>
