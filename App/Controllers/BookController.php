<?php

namespace App\Controllers;

use App\Models\Book;
use PDO;

class BookController
{

    public function books()
    {
        $books = (new Book())->getBooks();
        require_once '../App/Views/admin/admin.php';
    }

    public function booksUser(){
        $books = (new Book())->getBooks();
        require_once '../App/Views/user/index.php';
    }

    public function addBook()
    {
        $categories = (new Book())->getCategories();
        require_once '../App/Views/admin/add_book.php';
    }

    public function addNewBook()
    {
        header('Content-Type: application/json');

        $title = $_POST['title'];
        $author = $_POST['author'];
        $category = $_POST['category'];
        $quantity = $_POST['quantity'];
        $new_book_id = (new Book())->createBook($title, $author, $category, $quantity);

        if ($new_book_id) {
            echo json_encode(['status' => 'success', 'redirect' => '/books/edit/' . $new_book_id]);
            exit;
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Thêm sách thất bại']);
            exit;
        }
    }

    public function editBook($id_book)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $book = (new Book())->getBookByID($id_book);
            $categories = (new Book())->getCategories();
            require_once '../App/Views/admin/edit_book.php';
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            header('Content-Type: application/json');

            $title = $_POST['title'];
            $author = $_POST['author'];
            $category = $_POST['category'];
            $updatequantity = $_POST['updatequantity'];
            $book = (new Book())->updateBook($id_book, $title, $author, $category, $updatequantity);

            if ($book) {
                echo json_encode(['status' => 'success', 'message' => 'Cập nhập thành công']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Đã có lỗi xảy ra']);
            }
        }
    }

    public function deleteBook($id_book)
    {
        (new Book())->delBook($id_book);

        header('Location: /books');
    }
}

?>