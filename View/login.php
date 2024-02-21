<?php

use App\Model\User;
use App\Controller\AuthentificationController;

require_once __DIR__ . '/../vendor/autoload.php';

if (!isset ($_SESSION)){
    session_start();
}

?>

<form action="" method="post" class="login">
    <div class="field">
        <input type="text" placeholder="Email" name="email" required>
    </div>
    <div class="field">
        <input type="password" placeholder="Password" name="password" required>
    </div>
    <div class="field btn">
        <div class="btn-layer"></div>
        <input type="submit" value="Login">
    </div>
    <div class="signup-link">
        Not a member? <button onclick="window.location.href='register'">Signup now</button>
    </div>
</form>