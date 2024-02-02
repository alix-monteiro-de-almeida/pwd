<?php

namespace App\Controller;

use App\Model\User;


class AuthentificationController {

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
    
    
    function register($fullname, $email, $password) {
        
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
            header('Location: login.php');
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

                $_SESSION['user'] = $userConnected;
                header('Location: shop.php');
                var_dump($userConnected);
            } else {
                echo "Les identifiants fournis ne correspondent à aucun utilisateur";
            }
        }
    }

    function updateProfile($email, $password, $fullname) {

        if (!empty($email) && !empty($password) && !empty($fullname)) {
            
            $user = new User();
            
            $id = $_SESSION['user']->getId();
            $userConnected = $user->findOneById($id);
    
            if ($userConnected) {
    
                $_SESSION['user']->setEmail($email);
                $_SESSION['user']->setFullname($fullname);

                $_SESSION['user']->setPassword(password_hash($password, PASSWORD_DEFAULT));
                $_SESSION['user']->update();
    
                echo "Profil mis à jour avec succès!";
            } else {
                echo "Les identifiants fournis ne correspondent à aucun utilisateur";
            }
        } else {
            echo "Veuillez fournir toutes les informations nécessaires";
        }
    }
    
    
}