<?php

use App\Model\User;

require_once __DIR__ . '/../vendor/autoload.php';

if(session_status() === PHP_SESSION_NONE) {
    session_start();
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
                <div class="checkbox">
                    <label><input type="checkbox" required>
                    I agree to the terms & conditions</label>
                </div>
                <div class="field btn">
                    <div class="btn-layer"></div>
                    <input type="submit" value="Signup">
                </div>
                <?php if (isset($app->msgError)) {echo $app->msgError;} ?>
            </form>

