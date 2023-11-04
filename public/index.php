<?php

require_once '../vendor/autoload.php';

$router = new \Bramus\Router\Router();

// Define the home route to use HomeController
$router->get('/', function() {
    (new \App\Controllers\HomeController())->index();
});

// Define the login route to use AuthController
$router->get('/login', function() {
    (new \App\Controllers\AuthController())->login();
});

// Other routes definitions...

$router->run();

?>