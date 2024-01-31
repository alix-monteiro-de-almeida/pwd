<?php

use App\Model\User;
use App\Controller\AuthentificationController;

require_once __DIR__ . '/../vendor/autoload.php';

$auth = new AuthentificationController();

if (isset($_POST['fullname'], $_POST['email'], $_POST['password'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $auth->register($fullname, $email, $password);
}

?>

<form action="" method="post" class="signup">
                <div class="field">
                    <input type="text" placeholder="Fullname" name="fullname" required>
                </div>  
                <div class="field">
                    <input type="text" placeholder="Email" name="email" required>
                </div>
                <div class="field">
                    <input type="password" placeholder="Password" name="password" required>
                </div>
                <!-- <div class="checkbox">
                    <label><input type="checkbox" required>
                    I agree to the terms & conditions</label>
                </div> -->
                <div class="field btn">
                    <div class="btn-layer"></div>
                    <input type="submit" value="Signup">
                </div>
            </form>

