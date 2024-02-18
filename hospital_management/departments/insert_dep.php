<?php
include('../db_connection.php');

// Initialize variables
$departmentId = '';
$departmentName = '';
$description = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve values from the form
    $departmentId = $_POST['departmentId'];
    $departmentName = $_POST['departmentName'];
    $description = $_POST['description'];

    // Insert data into the Department table
    $sql = "INSERT INTO Department (DepartmentID, DepartmentName, Description) VALUES ('$departmentId', '$departmentName', '$description')";

    if ($conn->query($sql) === TRUE) {
        $confirmation_message = "Data inserted successfully!";
    } else {
        $error_message = "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Department Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        form {
            max-width: 300px;
            margin: 50px auto;
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
        .confirmation {
            color: green;
            margin-top: 10px;
        }
        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <h2>Insert Department Data</h2>
        <?php
        if (isset($confirmation_message)) {
            echo "<p class='confirmation'>$confirmation_message</p>";
        }
        if (isset($error_message)) {
            echo "<p class='error'>$error_message</p>";
        }
        ?>
        <label for="departmentId">Department ID:</label>
        <input type="text" name="departmentId" required>

        <label for="departmentName">Department Name:</label>
        <input type="text" name="departmentName" required>

        <label for="description">Description:</label>
        <input type="text" name="description" required>

        <button type="submit">Submit</button>
    </form>
</body>
</html>
