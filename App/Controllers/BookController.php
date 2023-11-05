<?php

namespace App\Controllers;
use App\Models\Book;

class BookController {

    public function books() {
        $books = (new Book())->getBooks();
        require_once '../App/Views/admin.php';
    } 

    public function editBook($id_books) {
        
    }
}

?>