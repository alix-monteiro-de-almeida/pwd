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

$router->map('GET', '/', 'home', 'home');

$router->map('GET', '/product', 'product', 'product');

$router->map('GET', '/product/[i:id_product]', 'productId', 'productId');

$match = $router->match();

if ($match){
    $routeName = $match['target'];

    switch($routeName) {
        case 'home':
            require_once 'View/home.php';
            echo "Hello Homepage";
            break;

        case 'product':
            require_once 'View/product.php';
            echo "Hello Products list";
            break;

        case 'productId':
            $productId = $match['params']['id_product'];
            require_once 'View/product.php';
            echo "Hello Product ID: $productId";
            break;

        default:
            echo "404";
        break;
    } 
} else {
    echo "404";
}

?>