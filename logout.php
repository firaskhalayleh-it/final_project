<?php
// Check if the user is already logged in based on the cookie
if (isset($_COOKIE['user_id'])) {
    // Expire the user_id cookie by setting its expiration time to the past
    setcookie('user_id', '', time() - 3600, '/');
}

// Redirect to the login page after logout
header("Location: index.php");
exit();
?>
