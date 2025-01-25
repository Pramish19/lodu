<?php


session_start();



if (isset($_SESSION['user_id'])) {
    $user = $_SESSION['user_id'];
    $username = $_SESSION['username'];
    $role = $_SESSION['role'];
}

$isLoggedIn = false;

// isset checks if the variable is set or not
if (isset($_SESSION['user_id'])) {
    if ($role === 'admin') {
        header('Location: admin.php');
    } else {

        header('Location: index2.php');
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Hotel Digital Menu</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="login-container">

        <form id="login-form">
            <h1>Login</h1>
            <label for="email">Email:</label>
            <input type="email" id="email" placeholder="Enter your email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" placeholder="Enter your password" required>

            <button type="submit">Login</button>
            <button type="button" id="signup-button">Signup</button>
        </form>
    </div>

    <script src="js/auth.js"></script>


</body>

</html>