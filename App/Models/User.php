<?php

namespace App\Models;

use App\Config\Database;

class User
{
    public $db;
    public function __construct()
    {
        // Thực hiện kết nối cơ sở dữ liệu trong constructor
        $this->db = new Database();
    }


    public function getUserByUsername(string $username)
    {
        $db = $this->db->getConnection();
        $query = $db->prepare("SELECT * FROM users WHERE Username = :username;");
        $query->bindParam(':username', $username);
        $query->execute();
        $user = $query->fetch(\PDO::FETCH_ASSOC);

        return $user;
    }

    public function getUserByID(string $id)
    {
        $db = $this->db->getConnection();
        $query = $db->prepare("SELECT * FROM users WHERE UserID = :id;");
        $query->bindParam(':id', $id);
        $query->execute();
        $user = $query->fetch(\PDO::FETCH_ASSOC);

        return $user;
    }

    public function getUserByEmail(string $email)
    {
        $db = $this->db->getConnection();
        $query = $db->prepare("SELECT * FROM users WHERE Email = :email");
        $query->bindParam(':email', $email, \PDO::PARAM_STR);
        $query->execute();
        $user = $query->fetch(\PDO::FETCH_ASSOC);

        return $user;
    }

    public function addUser(string $username, string $password, string $fullname, string $email)
    {
        $role = 'Member';

        $db = $this->db->getConnection();
        $sql = "INSERT INTO users (Username, Password, Fullname, Email, Role) VALUES (?, ?, ?, ?, ?)";
        $stmt = $db->prepare($sql);

        $params = [$username, $password, $fullname, $email, $role];

        $stmt->execute($params);

        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

}

?>