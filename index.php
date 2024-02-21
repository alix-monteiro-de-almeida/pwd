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


$router->map('GET', '/', function(){
    require_once 'View/home.php';
    echo "Hello Homepage";
}, 'home');

$router->map('GET', '/product', function(){
    require_once 'View/product.php';
    echo "Hello Products list";
}, 'product');

$router->map('GET', '/product/[i:id_product]', function($id_product){
    require_once 'View/product.php';
    echo "Hello Product ID: $id_product";
}, 'productId');

$router->map('GET', '/register', function(){
    require_once 'View/register.php';
}, 'register');

$router->map('POST', '/register', function(){
    $auth = new AuthentificationController();
    $auth->register($_POST['fullname'], $_POST['email'], $_POST['password']);
}, 'register_post');





$match = $router->match();
var_dump($match);
// call closure or throw 404 status
if( is_array($match) && is_callable( $match['target'] ) ) {
	call_user_func_array( $match['target'], $match['params'] );
} else {
	// no route was matched
	header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}

?>