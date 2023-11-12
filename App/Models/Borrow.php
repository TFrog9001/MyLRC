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

    public function getBorrowByUser($id_user)
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
                JOIN Books B ON BH.BookID = B.BookID
                WHERE U.UserID = :id_user;';
        $query = $db->prepare($sql);
        $query->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function return ($id)
    {
        $db = $this->db->getConnection();
        $sql = 'DELETE FROM borrowhistory WHERE BorrowID = :id_borrow';
        $query = $db->prepare($sql);
        $query->bindParam(':id_borrow', $id, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() > 0) {
            return 1;
        }
        return 0;
    }
    public function borrow($id_user, $id_book)
    {
        $db = $this->db->getConnection();
        $query = $db->prepare("CALL BorrowBook(:UserID, :BookID)");
        $query->execute([
            "UserID" => $id_user,
            "BookID" => $id_book
        ]);
        if ($query->rowCount() > 0) {
            return 1;
        }
        return 0;
    }
}


?>