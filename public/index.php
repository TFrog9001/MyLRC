<?php

@session_start();

require_once '../vendor/autoload.php';

$router = new \Bramus\Router\Router();
// Định nghĩa các route
$router->get('/', '\App\Controllers\HomeController@index');
$router->get('/home', '\App\Controllers\HomeController@index');

$router->get('/admin','\App\Controllers\HomeController@admin');


$router->get('/login', '\App\Controllers\AuthController@login');
$router->post('/login', '\App\Controllers\AuthController@handleLogin');

$router->get('/register', '\App\Controllers\AuthController@register');
$router->post('/register', '\App\Controllers\AuthController@handleRegister');

if (isset($_SESSION['user_name'])) {
    $router->get('/books','\App\Controllers\BookController@getBooks');
    $router->get('/books/edit/(\d+)','\App\Controllers\BookController@editBook');
}

// $router->get('/contacts/edit/(\d+)', '\App\Controllers\ContactsController@edit');


$router->get('/logout','\App\Controllers\AuthController@logout');

$router->run();