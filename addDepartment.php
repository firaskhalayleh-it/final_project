<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Add New Department</title>
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container mt-4">
        <h2>Add New Department</h2>

        <!-- Form to add a new department -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <div class="form-group">
                <label for="departmentName">Department Name:</label>
                <input type="text" id="departmentName" name="departmentName" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="departmentLocation">Department Location:</label>
                <input type="text" id="departmentLocation" name="departmentLocation" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Add Department</button>
        </form>
    </div>

    <!-- Add Bootstrap JS and Popper.js scripts (required for some Bootstrap features) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
<?php
include 'datasource.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $departmentName = $_POST["departmentName"];
    $departmentLocation = $_POST["departmentLocation"];

    // Insert the new department into the departments table
    $insertQuery = "INSERT INTO departments (dname, dlocation) VALUES ('$departmentName', '$departmentLocation')";
    $insertResult = $conn->query($insertQuery);

    if ($insertResult) {
        // Redirect to a success page or display a success message
        echo '<div class="alert alert-success mt-3" role="alert">';
        echo 'Department added successfully.';
        echo '</div>';
    } else {
        // Display an error message
        echo '<div class="alert alert-danger mt-3" role="alert">';
        echo 'Error adding department: ' . $conn->error;
        echo '</div>';
    }
}

// Close the database connection
$conn->close();
?>
