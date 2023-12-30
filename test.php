<?php
session_start();

// Sample user data (replace this with actual user authentication logic)
$users = [
    "Ahmad" => "ahmad123",
    "Ali"   => "ali123",
    "Huda"  => "huda123"
];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $login = isset($_POST["login"]) ? $_POST["login"] : "";
    $pass = isset($_POST["pass"]) ? $_POST["pass"] : "";

    // Check if login credentials are valid
    foreach ($users as $username => $password) {
        if ($login === $username && $pass === $password) {
            $_SESSION['login'] = $login;
            $_SESSION['pass'] = $pass;
            header("location: log.php");
            exit();
        }
    }

    $error_message = "Your login name and/or password is incorrect";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #C0C0C0;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        nav {
            margin-top: 10px;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            margin: 0 10px;
        }

        .login-container {
            background-color: #0acece;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 10%;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;

            
        }

        .login-container fieldset {
            border: none;
        }

        .login-container legend {
            font-size: 1.2em;
            font-weight: bold;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="password"],
        button {
            width: 100%;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 3px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        button {
            background-color: #C0C0C0;
            color: #fff;
            cursor: pointer;
        }

        .error-message {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <header>
        <nav>
            <a href="displayDrinks.php">Display Drinks</a> |
            <a href="insertform.html">Insert Drinks</a> |
            <a href="updateDrinks.php">Update Drinks</a> |
            <a href="deleteDrinks.php">Delete Drinks</a>
        </nav>
    </header>

    <div class="login-container">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <fieldset>
                <legend>Login Form</legend>
                <br>
                Login Name: <input type="text" name="login" placeholder="Enter Your Login" required><br><br>
                Password: <input type="password" name="pass" placeholder="Enter Your Password" required><br><br>
                <input type="submit" name="submit" value="Login"><br>
            </fieldset>
        </form>

        <?php
        if (isset($error_message)) {
            echo '<p class="error-message">' . $error_message . '</p>';
        }
        ?>
    </div>

</body>

</html>
