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

        if(User::emailExists($email)) {
            echo "Cet email est déjà utilisé. Veuillez en choisir un autre.";
            return;
        }
        
        if(
            !empty($fullname) &&
            !empty($email) &&
            !empty($password) 
        ) {
            $fullname = isset($_POST['fullname']) ? trim($_POST['fullname']) : ''; 
            // condition ternaire 

            $email = isset($_POST['email']) ? trim($_POST['email']) : '';
            $password = isset($_POST['password']) ? trim($_POST['password']) : '';
            $role = ['ROLE_USER'];

            // $toto = true ?: false; 

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
            var_dump ($userConnected);
            if($userConnected && password_verify($password, $userConnected->getPassword())) {

                $_SESSION['user'] = $userConnected;
                header('Location: shop.php');
                var_dump($userConnected);
            } else {
                echo "Les identifiants fournis ne correspondent à aucun utilisateur";
            }
        }
    }

    function updateProfile($fullname,$email,$oldPassword,$newPassword) {

        if (!empty($fullname) && !empty($email) && !empty($oldPassword) && !empty ($newPassword)) {
            
            $user = new User(); // model 
            
            $id = $_SESSION['user']->getId();
            $userFetch = $user->findOneById($id);
    
            if ($userFetch) 
            {
    
                // if $oldPassword == $userFetch ($password)
                if(password_verify($oldPassword, $userFetch->getPassword())){
                    
                    $_SESSION['user']->setEmail($email);
                    $_SESSION['user']->setFullname($fullname);
    
                    $_SESSION['user']->setPassword(password_hash($newPassword, PASSWORD_DEFAULT));
                    $_SESSION['user']->update();
        
                    echo "Profil mis à jour avec succès!";
                }
                else {
                  echo "Ancien mot de passe incorrect";
                }

            } else {
                echo "Les identifiants fournis ne correspondent à aucun utilisateur";
            }
        } else {
            echo "Veuillez fournir toutes les informations nécessaires";
        }
    }
    
    
}