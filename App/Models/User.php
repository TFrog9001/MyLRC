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

    public function getUserByID($id)
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
        $db = $this->db->getConnection();

        $role = 'Member';

        $stmt = $db->prepare("CALL AddUser(:username, :password, :fullname, :email, :role)");
        $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, \PDO::PARAM_STR);
        $stmt->bindParam(':fullname', $fullname, \PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, \PDO::PARAM_STR);
        $stmt->bindParam(':role', $role, \PDO::PARAM_STR);

        $stmt->execute();

        return $user = $this->getUserByUsername($username);
    }

}

?>