<?php

namespace App\Controllers;


use App\Config\Database;

class AuthController
{
    private $db;

    public function __construct()
    {
        // Thực hiện kết nối cơ sở dữ liệu trong constructor
        $this->db = new Database();
    }



    public function login(){
        echo "1";
        include "../App/Views/login.php";
    }

    public function handleLogin()
    {
        // Sử dụng kết nối cơ sở dữ liệu
        $db = $this->db->getConnection();

        // Xử lý đăng nhập
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $query = $db->prepare("SELECT * FROM users WHERE username = :username");
            $query->bindParam(':username', $username);
            $query->execute();
            $user = $query->fetch(\PDO::FETCH_ASSOC);

            // Các thao tác xử lý đăng nhập tiếp theo
            if ($user && password_verify($password, $user['password'])) {
                // Đăng nhập thành công, thực hiện thao tác cần thiết
                // Ví dụ: Lưu trạng thái đăng nhập vào session và chuyển hướng
                $_SESSION['user_id'] = $user['id'];
                header('Location: /Home');
            } else {
                // Đăng nhập thất bại, hiển thị thông báo lỗi
                include 'views/login.php';
                echo "Tên đăng nhập hoặc mật khẩu không đúng.";
            }
        }
    }
}
