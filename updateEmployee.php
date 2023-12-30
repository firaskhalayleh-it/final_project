<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Update Employee Data</title>
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container mt-4">
        <h2>Update Employee Data</h2>

        <!-- Form to update employee data -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="essn">Employee SSN:</label>
                <input type="text" id="essn" name="essn" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="ename">New Employee Name:</label>
                <input type="text" id="ename" name="ename" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="hiredate">New Hire Date:</label>
                <input type="date" id="hiredate" name="hiredate" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="department">New Department:</label>
                <input type="text" id="department" name="department" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="picture">New Picture:</label>
                <input type="file" id="picture" name="picture" class="form-control" accept="image/*">
            </div>

            <button type="submit" class="btn btn-primary">Update Employee Data</button>
        </form>

        <?php
        // Include the database connection file
        include 'datasource.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve form data
            $essn = $_POST["essn"];
            $newEname = $_POST["ename"];
            $newHiredate = $_POST["hiredate"];
            $newDepartment = $_POST["department"];

            // Validate and handle file upload
            if ($_FILES["picture"]["error"] == UPLOAD_ERR_OK) {
                $uploadDir = "uploads/";
                $uploadPath = $uploadDir . basename($_FILES["picture"]["name"]);

                if (move_uploaded_file($_FILES["picture"]["tmp_name"], $uploadPath)) {
                    // File uploaded successfully, update the database
                    $updateQuery = "UPDATE employees SET ename=?, hiredate=?, department=?, picture=? WHERE essn=?";
                    $stmt = $conn->prepare($updateQuery);
                    if ($stmt) {
                        $stmt->bind_param("sssss", $newEname, $newHiredate, $newDepartment, $uploadPath, $essn);
                        $stmt->execute();

                        echo '<div class="alert alert-success mt-3" role="alert">';
                        echo 'Employee data updated successfully.';
                        echo '</div>';
                        
                        // Display the updated employee information, including the new picture
                        // You can customize this part based on your needs
                        echo '<div class="mt-3">';
                        echo '<h4>Updated Employee Information</h4>';
                        echo '<p>Name: ' . $newEname . '</p>';
                        echo '<p>Hire Date: ' . $newHiredate . '</p>';
                        echo '<p>Department: ' . $newDepartment . '</p>';
                        echo '<img src="' . $uploadPath . '" alt="Employee Picture" style="max-width: 300px;">';
                        echo '</div>';
                    } else {
                        echo '<div class="alert alert-danger mt-3" role="alert">';
                        echo 'Error preparing statement: ' . $stmt->error;
                        echo '</div>';
                    }
                } else {
                    echo '<div class="alert alert-danger mt-3" role="alert">';
                    echo 'Error uploading file.';
                    echo '</div>';
                }
            } else {
                echo '<div class="alert alert-warning mt-3" role="alert">';
                echo 'File upload error: ' . $_FILES["picture"]["error"];
                echo '</div>';
            }
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>

    <!-- Add Bootstrap JS and Popper.js scripts (required for some Bootstrap features) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
