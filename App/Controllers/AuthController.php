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
        include "../App/Views/login.php";
    }

    public function handleLogin()
    {   
        header('Content-Type: application/json');
        // Sử dụng kết nối cơ sở dữ liệu
        $db = $this->db->getConnection();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sử dụng toán tử null coalescing để tránh cảnh báo nếu các khóa không tồn tại
            $username = $_POST['username'];
            $password = $_POST['password'];
            
            $query = $db->prepare("SELECT * FROM users WHERE username = :username;");
            $query->bindParam(':username', $username);
            $query->execute();
            $user = $query->fetch(\PDO::FETCH_ASSOC);

            // Kiểm tra xem username và password có được set không
            if ($user && $password === $user['password']) {
                $_SESSION['user_id'] = $user['id'];
            } else {
                // Trả về thông báo lỗi nếu username hoặc password không được cung cấp
                echo json_encode(['status' => 'error', 'message' => 'Tên đăng nhập và mật khẩu là bắt buộc.']);
                exit;
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
            exit;
        }
    
    }
}
