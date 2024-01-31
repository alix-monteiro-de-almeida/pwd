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
        $passwordConfirm = trim($_POST['confirmpwd']);
        $role = ['ROLE_USER'];
        
        if(
            !empty($fullname) &&
            !empty($email) &&
            !empty($password) &&
            !empty($passwordConfirm) &&
            preg_match($regexPassword, $password) &&
            $password === $passwordConfirm
        ) {
            $user = new User();
            $user->setFullname($fullname);
            $user->setEmail($email);
            $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
            $user->setRole($role);
            $user->create();
            header('Location: /');
        } else {
            echo "Veuillez remplir tous les champs correctement";
        }
    }
}