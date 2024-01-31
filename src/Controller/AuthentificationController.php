<?php

namespace App\Controller;

use App\Model\User;


class AuthentificationController {
    
    
    function register($email, $password, $fullname) {

        if (!isset($_SESSION)) {
            session_start();
        } else {
            session_destroy();
        }
        
        $regexPassword = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/";
        $fullname = trim($_POST['fullname']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $role = ['ROLE_USER'];
        
        if(
            !empty($fullname) &&
            !empty($email) &&
            !empty($password) &&
            preg_match($regexPassword, $password)
        ) {
            $user = new User();
            $user->setFullname($fullname);
            $user->setEmail($email);
            $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
            $user->setRole($role);
            $user->create();
            // header('Location: /');

            echo "Votre compte a bien été créé";

        } else {
            echo "Veuillez remplir tous les champs correctement";
        }
    }
}