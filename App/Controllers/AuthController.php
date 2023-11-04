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



    public function login()
    {
        include "../App/Views/login.php";
    }

    public function handleLogin()
    {
        header('Content-Type: application/json');
        // Sử dụng kết nối cơ sở dữ liệu
        $db = $this->db->getConnection();

        // Sử dụng toán tử null coalescing để tránh cảnh báo nếu các khóa không tồn tại
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        if (isset($_POST['login'])) {
            echo json_encode(['status' => 'error', 'message' => 'Cos len.']);
        }

        // Kiểm tra xem username và password có được cung cấp không
        if (empty($username) || empty($password)) {
            echo json_encode(['status' => 'error', 'message' => 'Tên đăng nhập và mật khẩu là bắt buộc.']);
            exit;
        }

        $query = $db->prepare("SELECT * FROM users WHERE username = :username;");
        $query->bindParam(':username', $username);
        $query->execute();
        $user = $query->fetch(\PDO::FETCH_ASSOC);

        // Kiểm tra xem người dùng có tồn tại và mật khẩu có khớp không
        if ($user && $password == $user['password']) {
            // Đăng nhập thành công, thiết lập session hoặc token ở đây
            $_SESSION['user_id'] = $user['id'];
            echo json_encode(['status' => 'success', 'message' => 'Đăng nhập thành công.']);
        } else {
            // Trả về thông báo lỗi nếu username hoặc password không đúng
            echo json_encode(['status' => 'error', 'message' => 'Tên đăng nhập hoặc mật khẩu không đúng.']);
        }
    }

}
