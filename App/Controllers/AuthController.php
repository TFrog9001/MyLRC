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
        if ($user && ($password == $user['password'])) {
            // Đăng nhập thành công, thực hiện thao tác cần thiết
            // Ví dụ: Lưu trạng thái đăng nhập vào session
            $_SESSION['user_id'] = $user['id'];

            // Trả về JSON cho AJAX call
            echo json_encode(['status' => 'success', 'message' => 'Đăng nhập thành công']);
        } else {
            // Đăng nhập thất bại, trả về JSON lỗi
            echo json_encode(['status' => 'error', 'message' => 'Tên đăng nhập hoặc mật khẩu không đúng.']);
        }
    } else {
        // Nếu không phải POST request, trả về lỗi
        echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
    }

    exit; // Kết thúc script để không gửi thêm dữ liệu nào khác
}

}
