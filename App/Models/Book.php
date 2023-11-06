<?php

namespace App\Models;
use App\Config\Database;

class Book {

    public $db;
    public function __construct()
    {
        // Thực hiện kết nối cơ sở dữ liệu trong constructor
        $this->db = new Database();
    }

    public function getBooks(){
        $db = $this->db->getConnection();
        $query = $db->prepare("SELECT * FROM books JOIN categories ON books.CategoryID = categories.CategoryID ;");
        $query->execute();
        $books = $query->fetchAll();

        return $books;
    }
    public function getCategories(){
        $db = $this->db->getConnection();
        $query = $db->prepare("SELECT * FROM categories");
        $query->execute();
        $categories = $query->fetchAll();

        return $categories;
    }
    public function getBookByID($id_book){
        $db = $this->db->getConnection();
        $query = $db->prepare("SELECT * FROM books WHERE BookID = :id_book");
        $query->bindParam(':id_book', $id_book);
        $query->execute();
        $book = $query->fetch(\PDO::FETCH_ASSOC);
        $categories = $this->getCategories();
        
        return array('books'=> $book,'categories'=> $categories);;
    }

}

?>