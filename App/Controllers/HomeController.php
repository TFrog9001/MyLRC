<?php

namespace App\Controllers;

class HomeController
{
    public function index()
    {
        if (isset($_SESSION['user_id'])) {
            require_once "../App/Views/user/index.php";
        } else {
            header("Location: /login");
        }
    }

    public function admin()
    {
        if (isset($_SESSION['user_admin']) && $_SESSION['user_admin'] == 'True') {
            require_once '../App/Views/admin/admin.php';
        } else {
            header("Location: /login");
        }
    }

}


?>