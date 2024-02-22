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

$router->map('GET', '/login', function(){
    require_once 'View/login.php';
}, 'login');

$router->map('POST', '/login', function(){
    $auth = new AuthentificationController();
    $auth->login($_POST['email'], $_POST['password']);
}, 'login_post');

$router->map('GET', '/shop', function(){
    require_once 'View/shop.php';
}, 'shop');


$router->map('GET', '/profile', function(){
    require_once 'View/profile.php';
}, 'profile');

$router->map('POST', '/profile', function(){
    $auth = new AuthentificationController();
    $auth->updateProfile($_POST['fullname'], $_POST['email'], $_POST['oldPassword'], $_POST['newPassword']);
}, 'profile_post');

$router->map('GET', '/admin/users/list', function(){
    $user = new User();
    $findUsers = $user->findAll();
    require_once 'View/admin.php';
}, 'users_list');

$router->map('GET', '/admin/users/show/[i:id]', function($id){
    $findUserById = new User();
    $findUserById->findOneById($id);
    require_once 'View/admin.php';
}, 'user_by_id');

$router->map('GET', '/admin/users/edit/[i:id]', function($id){
    $updateUserById = new User();
    $updateUserById->update($id);
    require_once 'View/admin.php';
}, 'update_user_by_id');

$router->map('GET', '/admin/users/delete/[i:id]', function($id){
    $deleteUserById = new User();
    $deleteUserById->delete($id);
    require_once 'View/admin.php';
    echo 'user delete with success :)';
}, 'delete_user_by_id');

$match = $router->match();

// call closure or throw 404 status
if( is_array($match) && is_callable( $match['target'] ) ) {
	call_user_func_array( $match['target'], $match['params'] );
} else {
	// no route was matched
	header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}