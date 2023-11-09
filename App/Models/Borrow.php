<?php

namespace App\Models;

use App\Config\Database;
use PDO;

class Borrow
{

    public $db;
    public function __construct()
    {
        // Thực hiện kết nối cơ sở dữ liệu trong constructor
        $this->db = new Database();
    }

    public function getAllBorrow()
    {
        $db = $this->db->getConnection();

        $sql = 'SELECT
                    U.UserID,
                    U.Username,
                    U.FullName,
                    U.Email,
                    B.BookID,
                    B.Title,
                    BH.BorrowID,
                    BH.BorrowDate,
                    BH.ReturnDate
                FROM Users U
                JOIN BorrowHistory BH ON U.UserID = BH.UserID
                JOIN Books B ON BH.BookID = B.BookID;';

        $query = $db->prepare("$sql");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


}


?>