<?php
if(!isset($_SESSION)){
    session_start();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/home.css">
    <script src="scripts/scriptLogin.js"></script>
    <title>My Little MVC</title>
</head>
<button class="login" onclick="window.location.href='login'">Login</button>
<button class="register" onclick="window.location.href='register'">Register</button>
<button class="shop" onclick="window.location.href='shop'">Shop</button>
<button class="profile" onclick="window.location.href='profile'">Profile</button>

<body>
    <div class="home">
        <?php if (!isset($_SESSION['fullname'])) { ?>
            <h1>Welcome !</h1>

        <?php } else { ?>
            <h1><?php echo 'Welcome back&nbsp;' . $_SESSION['fullname'] ?></h1>
        <?php } ?>
    </div>
</body>
</html>
