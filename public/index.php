<?php

@session_start();

require_once '../vendor/autoload.php';

$router = new \Bramus\Router\Router();
// Định nghĩa các route
$router->get('/', '\App\Controllers\HomeController@index');
$router->get('/Home', '\App\Controllers\HomeController@index');

$router->get('/login', '\App\Controllers\AuthController@login');
$router->post('/login', '\App\Controllers\AuthController@handleLogin');

$router->get('/register', 'AuthController@register');
$router->post('/register', 'AuthController@handleRegister');

$router->run();