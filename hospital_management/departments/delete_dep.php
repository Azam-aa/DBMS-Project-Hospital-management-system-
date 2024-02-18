<?php
include('../db_connection.php');

$confirmationMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $departmentID = $_POST['departmentID'];

    // Perform deletion based on the $departmentID
    $sql = "DELETE FROM Department WHERE DepartmentID = $departmentID";

    if ($conn->query($sql) === TRUE) {
        $confirmationMessage = "Department deleted successfully!";
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
    <title>Delete Department</title>
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
        <h1>Delete Department</h1>
    </header>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="departmentID">Department ID to Delete:</label>
        <input type="text" name="departmentID" required>

        <button type="submit">Delete Department</button>
    </form>

    <?php
    if ($confirmationMessage) {
        echo "<div class='confirmation-message'>$confirmationMessage</div>";
    }
    ?>
</body>
</html>
