<?php

namespace App\Models;

use App\Config\Database;
use PDO;

class Book
{

    public $db;
    public function __construct()
    {
        // Thực hiện kết nối cơ sở dữ liệu trong constructor
        $this->db = new Database();
    }

    public function createBook($title, $author, $category, $quantity)
    {
        $db = $this->db->getConnection();
        $query = $db->prepare("SELECT AddBook(:title, :author, :category, :quantity) AS new_book_id");

        $query->bindParam(':title', $title, PDO::PARAM_STR);
        $query->bindParam(':author', $author, PDO::PARAM_STR);
        $query->bindParam(':category', $category, PDO::PARAM_INT);
        $query->bindParam(':quantity', $quantity, PDO::PARAM_INT);

        $query->execute();

        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result['new_book_id'];
    }

    public function updateBook($id_book, $title, $author, $category, $quantity)
    {
        $db = $this->db->getConnection();


        $db = $this->db->getConnection();
        $query = $db->prepare("CALL UpdateBook(:id_book, :title, :author, :category, :updatequantity)");
        $query->execute([
            'id_book' => $id_book,
            'title' => $title,
            'author' => $author,
            'category' => $category,
            'updatequantity' => $quantity
        ]);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getBooks()
    {
        $db = $this->db->getConnection();
        $query = $db->prepare("SELECT * FROM books JOIN categories ON books.CategoryID = categories.CategoryID ;");
        $query->execute();
        $books = $query->fetchAll();

        return $books;
    }
    public function getCategories()
    {
        $db = $this->db->getConnection();
        $query = $db->prepare("SELECT * FROM categories");
        $query->execute();
        $categories = $query->fetchAll();

        return $categories;
    }
    public function getBookByID($id_book)
    {
        $db = $this->db->getConnection();
        $query = $db->prepare("SELECT * FROM books WHERE BookID = :id_book");
        $query->bindParam(':id_book', $id_book);
        $query->execute();
        $book = $query->fetch(PDO::FETCH_ASSOC);

        return $book;
    }

    public function delBook($id_book)
    {   
        $db = $this->db->getConnection();
        $sql = "DELETE FROM books WHERE BookID = :id_book";
        $query = $db->prepare($sql);
        $query->bindParam(':id_book', $id_book, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() > 0) {
            return 1;
        }
        return 0;
    }
}

?>