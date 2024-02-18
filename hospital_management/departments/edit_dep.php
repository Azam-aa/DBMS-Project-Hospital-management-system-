<?php
include('../db_connection.php');

$confirmationMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $departmentID = $_POST['departmentID'];
    $departmentName = mysqli_real_escape_string($conn, $_POST['departmentName']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // Perform update based on the $departmentID
    $sql = "UPDATE Department SET DepartmentName = '$departmentName', Description = '$description' WHERE DepartmentID = $departmentID";

    if ($conn->query($sql) === TRUE) {
        $confirmationMessage = "Department details updated successfully!";
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
    <title>Edit Department Details</title>
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
        <h1>Edit Department Details</h1>
    </header>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="departmentID">Department ID to Edit:</label>
        <input type="text" name="departmentID" required>

        <label for="departmentName">New Department Name:</label>
        <input type="text" name="departmentName" required>

        <label for="description">New Description:</label>
        <textarea name="description" rows="4" required></textarea>

        <button type="submit">Edit Department Details</button>
    </form>

    <?php
    if ($confirmationMessage) {
        echo "<div class='confirmation-message'>$confirmationMessage</div>";
    }
    ?>
</body>
</html>
