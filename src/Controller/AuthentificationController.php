<?php

namespace App\Controller;

use App\Model\User;


class AuthentificationController {
    
    
    function register($fullname, $email, $password) {

        if (!isset($_SESSION)) {
            session_start();
        } else {
            session_destroy();
        }
        
        if(
            !empty($fullname) &&
            !empty($email) &&
            !empty($password) 
        ) {
            $fullname = isset($_POST['fullname']) ? trim($_POST['fullname']) : '';
            $email = isset($_POST['email']) ? trim($_POST['email']) : '';
            $password = isset($_POST['password']) ? trim($_POST['password']) : '';
            $role = ['ROLE_USER'];

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

    function login($email, $password) {

        if(
            !empty($email) &&
            !empty($password)
        ) {
            $email = isset($_POST['email']) ? trim($_POST['email']) : '';
            $password = isset($_POST['password']) ? trim($_POST['password']) : '';

            $user = new User();
            $userConnected = $user->findOneByEmail($email);

            if($userConnected && password_verify($password, $userConnected->getPassword())) {

                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }

                $_SESSION['user'] = $userConnected;
                // header('Location: /shop');
                var_dump($userConnected);
            } else {
                echo "Les identifiants fournis ne correspondent à aucun utilisateur";
            }
        }
    }
}