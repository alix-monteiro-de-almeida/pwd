<?php

require_once 'vendor/autoload.php';
session_start();

$router = new AltoRouter();
$router-> setBasePath('/pwd');

use App\Controller;
use App\Model;
use App\View;
use App\Controller\AuthentificationController;
use App\Controller\ShopController;
use App\Model\User;

$router->map('GET', '/', function() {
    require_once 'view/home.php';
});



?>