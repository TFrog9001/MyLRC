<?php

namespace App\Controllers;

use App\Models\Book;

class BookController
{

    public function books()
    {
        $books = (new Book())->getBooks();
        require_once '../App/Views/admin/admin.php';
    }

    public function addBook(){
        require_once '../App/Views/admin/add_book.php';
    }

    public function editBook($id_book)
    {   
        $editBook = (new Book())->getBookByID($id_book);
        require_once '../App/Views/admin/edit_book.php';
    }

    public function deleteBook($id_book)
    {
        echo $id_book;
    }
}

?>