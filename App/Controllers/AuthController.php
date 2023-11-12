<?php

namespace App\Controllers;


use App\Config\Database;
use App\Models\User;

class AuthController
{
    public function login()
    {
        include "../App/Views/login.php";
    }

    public function handleLogin()
    {
        header('Content-Type: application/json');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sử dụng toán tử null coalescing để tránh cảnh báo nếu các khóa không tồn tại
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            // Kiểm tra xem username và password có được cung cấp không
            if (empty($username) || empty($password)) {
                echo json_encode(['status' => 'error', 'message' => 'Tên đăng nhập và mật khẩu là bắt buộc.']);
                exit;
            }

            $user = (new User())->getUserByUsername($username);

            // Kiểm tra xem người dùng có tồn tại và mật khẩu có khớp không
            if ($user && $password == $user['Password'] && $user['Role'] == 'Admin') {
                // Đăng nhập thành công, thiết lập session hoặc token ở đây
                $_SESSION['user_id'] = $user['UserID'];
                $_SESSION['user_name'] = $user['Username'];
                $_SESSION['user_admin'] = 'True';
                echo json_encode(['status' => 'success', 'message' => 'Đăng nhập thành công admin.', 'redirect' => '/admin']);
            } else if ($user && $password == $user['Password'] && $user['Role'] == 'Member') {
                // Đăng nhập thành công, thiết lập session hoặc token ở đây
                $_SESSION['user_id'] = $user['UserID'];
                $_SESSION['user_name'] = $user['Username'];
                echo json_encode(['status' => 'success', 'message' => 'Đăng nhập thành công user.', 'redirect' => '/books']);
            } else {
                // Trả về thông báo lỗi nếu username hoặc password không đúng
                echo json_encode(['status' => 'error', 'message' => 'Tên đăng nhập hoặc mật khẩu không đúng.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
        }
    }


    public function register()
    {
        require_once "../App/Views/register.php";
    }

    public function handleRegister()
    {
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sử dụng toán tử null coalescing để tránh cảnh báo nếu các khóa không tồn tại
            $fullname = $_POST['fullname'] ?? '';
            $username = $_POST['username'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $repassword = $_POST['repassword'] ?? '';

            // Kiểm tra xem các trường bắt buộc có được cung cấp không
            if (empty($fullname) || empty($username) || empty($email) || empty($password) || empty($repassword)) {
                echo json_encode(['status' => 'error', 'message' => 'Vui lòng điền đầy đủ thông tin.']);
                exit;
            }

            // Kiểm tra xem mật khẩu và mật khẩu nhập lại có khớp nhau không
            if ($password !== $repassword) {
                echo json_encode(['status' => 'error', 'message' => 'Mật khẩu và mật khẩu nhập lại không khớp.']);
                exit;
            }

            // Kiểm tra xem username hoặc email đã tồn tại trong cơ sở dữ liệu chưa
            $user = (new User())->getUserByUsername($username);
            if ($user) {
                echo json_encode(['status' => 'error', 'message' => 'Tên đăng nhập đã tồn tại.']);
                exit;
            }

            $user = (new User())->getUserByEmail($email);
            if ($user) {
                echo json_encode(['status' => 'error', 'message' => 'Email đã được sử dụng.']);
                exit;
            }

            // Thêm người dùng mới vào cơ sở dữ liệu
            $user = (new User())->addUser($username, $password, $fullname, $email);

            if ($user) {
                // Đăng ký thành công, bạn có thể thực hiện việc đăng nhập ngay tại đây
                // Hoặc bạn có thể sử dụng mã nguồn để tự đăng nhập người dùng
                echo json_encode(['status' => 'success', 'message' => 'Đăng ký thành công.', 'redirect' => '/login']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Đăng ký không thành công. Vui lòng thử lại sau.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
        }
    }


    public function infor(){
        $user = (new User())->getUserByID($_SESSION['user_id']);
        require_once('../App/Views/user/information.php');
    }

    public function logout()
    {
        session_destroy();
        Header('Location: /login');
    }
}
