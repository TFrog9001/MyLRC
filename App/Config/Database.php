<?php

namespace App\Config;

class Database
{
    private $host = 'localhost';
    private $dbname = 'mylrc';
    private $username = 'root';
    private $password = '';
    private $db;

    public function __construct()
    {
        try {
            $this->db = new \PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
            $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            die("Kết nối cơ sở dữ liệu thất bại: " . $e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->db;
    }
}
