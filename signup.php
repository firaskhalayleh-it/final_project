
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
        <?php include "header.php"; ?>
    <div class="container mt-5">
        <h2>Sign Up</h2>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirm Password:</label>
                <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Sign Up</button>
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
    $username = isset($_POST["username"]) ? $_POST["username"] : '';
    $password = isset($_POST["password"]) ? $_POST["password"] : '';
    $confirmPassword = isset($_POST["confirmPassword"]) ? $_POST["confirmPassword"] : '';
    // Validate the signup
    if ($password != $confirmPassword) {
        // Redirect back to the signup page with an error message
        include 'signup.php';
        exit();
    }else if (strlen($password) < 8) {
        // Redirect back to the signup page with an error message
        echo '<script>alert("Password must be at least 8 characters long")</script>';
        include 'signup.php';
        exit();
    }

    // Check if the username already exists
    $checkQuery = "SELECT * FROM users WHERE username = '$username'";
    $checkResult = $connection->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        // Redirect back to the signup page with an error message
        echo '<script>alert("Username already exists")</script>';
        exit();
    }

    // Hash the password (for security, always hash passwords before storing them)
   

    // Insert the new user into the users table
    $insertQuery = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    $insertResult = $connection->query($insertQuery);

    if ($insertResult) {
        // Redirect to a success page
        header("Location: login.html");
        exit();
    } else {
        // Redirect back to the signup page with an error message
        echo '<script>alert("Error creating user")</script>';
        exit();
    }
}
?>
