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
        $query = $db->prepare("SELECT * FROM books;");
        $query->execute();
        $books = $query->fetch(\PDO::FETCH_ASSOC);

        return $books;
    }

}

?>