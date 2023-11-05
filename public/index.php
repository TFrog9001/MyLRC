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

$router->get('/logout','\App\Controllers\AuthController@logout');

$router->run();