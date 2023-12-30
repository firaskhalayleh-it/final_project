<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body class="bg-light"  >
    <?php include "header.php"; ?>
    <div class="card container mt-5 border-0 shadow-lg">

    <div class="card-body">
   
    <h2>Login Form</h2>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <div class="input-group">
                <input type="password" id="password" name="password" class="form-control" required>
                <div class="input-group-append">
                    <span class="btn btn-outline-secondary">
                        <input type="checkbox" id="showPassword"> Show
                    </span>
                </div>
            </div>
        </div>

        <center>
        <button type="submit" class="btn btn-outline-info">Login</button>
        </center>


    </form>

</div>
</div>
<?php if(isset($_COOKIE['error'])): ?>
    <div class="card container mt-5 border-0 shadow-lg">
    <div class="card-body">
        <h5 class="card-title">Welcome!</h5>
        <p class="card-text">If you don't have an account, you can <a href="signup.php">sign up here</a>.</p>
    </div>
</div>
<?php endif; ?>



<script>
    document.addEventListener('DOMContentLoaded', function () {
        var passwordInput = document.getElementById('password');
        var showPasswordCheckbox = document.getElementById('showPassword');

        showPasswordCheckbox.addEventListener('change', function () {
            passwordInput.type = showPasswordCheckbox.checked ? 'text' : 'password';
        });
    });
</script>
</body>
</html>
<?php
// Include the database connection file
include 'datasource.php';


// Check if the user is already logged in based on the cookie

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = isset($_POST["username"]) ? $_POST["username"] : '';
    $password = isset($_POST["password"]) ? $_POST["password"] : '';

    // Validate the login
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Successful login, set a cookie and redirect to employees page
        $user = $result->fetch_assoc();
        setcookie('user_id',$username , time() + 3600, '/'); // Set a cookie that expires in 1 hour
        setcookie('error', '', time() - 3600, '/');
        header("Location: index.php");
        exit(); // Ensure that no other code is executed after the header redirect
    } else {
        // Invalid login, handle accordingly
        echo '<script>alert("Invalid login")</script>';
        setcookie('error', 'Invalid login', time() + 3600, '/');
        header("Location: login.php");
        exit();
    }
}

// Close the database connection
$conn->close();
?>
