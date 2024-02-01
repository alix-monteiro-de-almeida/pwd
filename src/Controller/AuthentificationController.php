<?php

namespace App\Controller;

use App\Model\User;


class AuthentificationController {
    
    
    function register() {

        if (!isset($_SESSION)) {
            session_start();
        } else {
            session_destroy();
        }
        $fullname = isset($_POST['fullname']) ? trim($_POST['fullname']) : '';
        $email = isset($_POST['email']) ? trim($_POST['email']) : '';
        $password = isset($_POST['password']) ? trim($_POST['password']) : '';
        $role = ['ROLE_USER'];
        if(
            !empty($fullname) &&
            !empty($email) &&
            !empty($password) 
        ) {
            $user = new User();
            $user->setFullname($fullname);
            $user->setEmail($email);
            $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
            $user->setRole($role);
            $user->create();

            echo "Votre compte a bien été créé";

        } else {
            echo "Veuillez remplir tous les champs correctement";
        }
    }

    function login() {

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $email = isset($_POST['email']) ? trim($_POST['email']) : '';
        $password = isset($_POST['password']) ? trim($_POST['password']) : '';

        if(
            !empty($email) &&
            !empty($password)
        ) {
    
            $user = new User();
            $user->setEmail($email);
            $user->setPassword($password);
            $user->findOneByEmail($email);

            if(password_verify($password, $user->getPassword())) {

                $_SESSION['user'] = $user;
                var_dump($user);
                header('Location: /shop');
            } else {
                echo "Les identifiants fournis ne correspondent à aucun utilisateur";
            }
        }
    }
}