<?php

namespace App\Controllers;

class HomeController {
    public function index() {
        echo "Hello home";
        include "../views/home.php";
    }
}


?>