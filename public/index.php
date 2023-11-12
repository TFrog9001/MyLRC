<?php

@session_start();

require_once '../vendor/autoload.php';

$router = new \Bramus\Router\Router();
// Định nghĩa các route
$router->get('/', '\App\Controllers\HomeController@index');
$router->get('/home', '\App\Controllers\HomeController@index');

// $router->get('/admin','\App\Controllers\HomeController@admin');


$router->get('/login', '\App\Controllers\AuthController@login');
$router->post('/login', '\App\Controllers\AuthController@handleLogin');

$router->get('/register', '\App\Controllers\AuthController@register');
$router->post('/register', '\App\Controllers\AuthController@handleRegister');

if (isset($_SESSION['user_name']) && isset($_SESSION['user_admin']) && $_SESSION['user_admin'] == 'True') {
    $router->get('/admin','\App\Controllers\BookController@books');
    $router->get('/books','\App\Controllers\BookController@books');
    $router->get('/books/add','\App\Controllers\BookController@addBook');
    $router->post('/books/add','\App\Controllers\BookController@addNewBook');
    $router->get('/books/edit/(\d+)','\App\Controllers\BookController@editBook');
    $router->post('/books/edit/(\d+)','\App\Controllers\BookController@editBook');
    $router->post('/books/delete/(\d+)','\App\Controllers\BookController@deleteBook');
    $router->get('/borrows','\App\Controllers\BorrowController@borrows');
    $router->post('/borrows/return/(\d+)','\App\Controllers\BorrowController@returnBook');
    
}
if (isset($_SESSION['user_name']) && !isset($_SESSION['user_admin'])) {
    $router->get('/home','\App\Controllers\BookController@booksUser');
    $router->get('/books','\App\Controllers\BookController@booksUser');
    $router->get('/infor','\App\Controllers\AuthController@infor');
    $router->post('/borrows/borrow/(\d+)','\App\Controllers\BorrowController@borrowBook');
    $router->get('/history','\App\Controllers\BorrowController@myHistory');
}
$router->get('/logout','\App\Controllers\AuthController@logout');
// $router->get('/test','\App\Models\Book@createBookTest');
// $router->post('/test','\App\Controllers\BookController@addNewBook');

$router->run();