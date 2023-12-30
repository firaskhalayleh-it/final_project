<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Remove Employee</title>
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container mt-4">
        <h2>Remove Employee</h2>

        <!-- Form to remove an employee -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="essn">Employee SSN:</label>
                <input type="text" id="essn" name="essn" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-danger">Remove Employee</button>
        </form>

        <?php
        // Include the database connection file
        include 'datasource.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve SSN from the form
            $essn = $_POST["essn"];

            // Check if the employee with the given SSN exists
            $checkQuery = "SELECT * FROM employees WHERE essn = '$essn'";
            $checkResult = $conn->query($checkQuery);

            if ($checkResult->num_rows > 0) {
                // Employee found, proceed with removal
                $removeQuery = "DELETE FROM employees WHERE essn = '$essn'";
                $removeResult = $conn->query($removeQuery);

                if ($removeResult) {
                    echo '<div class="alert alert-success mt-3" role="alert">';
                    echo 'Employee removed successfully.';
                    echo '</div>';
                } else {
                    echo '<div class="alert alert-danger mt-3" role="alert">';
                    echo 'Error removing employee: ' . $conn->error;
                    echo '</div>';
                }
            } else {
                // Employee not found
                echo '<div class="alert alert-warning mt-3" role="alert">';
                echo 'Employee with SSN ' . $essn . ' not found.';
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
