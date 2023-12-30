<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Add New Employee</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container mt-4">
        <h2>Add New Employee</h2>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="essn">Employee SSN:</label>
                <input type="text" id="essn" name="essn" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="ename">Employee Name:</label>
                <input type="text" id="ename" name="ename" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="hiredate">Hire Date:</label>
                <input type="date" id="hiredate" name="hiredate" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="department">Department:</label>
                <input type="text" id="department" name="department" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="picture">Picture:</label>
                <input type="file" id="picture" name="picture" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Add Employee</button>
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
    $essn = $_POST["essn"];
    $ename = $_POST["ename"];
    $hiredate = $_POST["hiredate"];
    $department = $_POST["department"];

    // Check if the employee with the given SSN already exists
    $checkQuery = "SELECT * FROM employees WHERE ESSN = '$essn'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        echo "Employee with SSN $essn already exists.";
    } else {
        // File upload handling
        $picture = $_FILES["picture"];
        $pictureName = $picture["name"];
        $pictureTmpName = $picture["tmp_name"];

        // Move the uploaded file to the desired directory (adjust the directory path accordingly)
        $uploadPath = "uploads/"; // You need to create this directory
        $targetPath = $uploadPath . $pictureName;

        if (move_uploaded_file($pictureTmpName, $targetPath)) {
            // File uploaded successfully, proceed with database insertion
            $addQuery = "INSERT INTO employees (ESSN, ename, hiredate, department, picture) VALUES ('$essn', '$ename', '$hiredate', '$department', '$targetPath')";
            $addResult = $conn->query($addQuery);

            if ($addResult) {
                echo "Employee added successfully.";
                header("Location: employees.php");
                exit(); // Ensure that no other code is executed after the header redirect
            } else {
                echo "Error adding employee: " . $conn->error;
            }
        } else {
            echo "Error uploading file.";
        }
    }
}

// Close the database connection
$conn->close();
?>
