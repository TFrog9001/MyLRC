<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header fs-3">Đăng Ký</div>
                    <div class="card-body">
                        <form id="registerForm">
                            <div class="form-group">
                                <label for="fullname">Họ và tên:</label>
                                <input type="text" class="form-control" id="fullname" name="fullname" required>
                                <p id="fullnameError" class="text-danger"></p>
                            </div>
                            <div class="form-group">
                                <label for="username">Tên đăng nhập:</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                                <p id="usernameError" class="text-danger"></p>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                                <p id="emailError" class="text-danger"></p>
                            </div>
                            <div class="form-group">
                                <label for="password">Mật khẩu:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                                <p id="passwordError" class="text-danger"></p>
                            </div>
                            <div class="form-group">
                                <label for="repassword">Nhập lại mật khẩu:</label>
                                <input type="password" class="form-control" id="repassword" name="repassword" required>
                                <p id="repasswordError" class="text-danger"></p>
                            </div>
                            <input name="register" type="submit" class="btn btn-primary" value="Đăng Ký">
                            <p id="registerMessage" class="text-danger"></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#registerForm').submit(function (e) {
                e.preventDefault(); // Ngăn chặn gửi mặc định

                clearErrors();

                let fullname = $('#fullname').val();
                let username = $('#username').val();
                let email = $('#email').val();
                let password = $('#password').val();
                let repassword = $('#repassword').val();

                // Thực hiện kiểm tra dữ liệu đăng ký ở đây

                // Dùng Ajax để gửi dữ liệu đăng ký
                $.ajax({
                    type: 'POST',
                    url: '/register', // Đặt địa chỉ xử lý đăng ký của bạn
                    data: {
                        fullname: fullname,
                        username: username,
                        email: email,
                        password: password,
                        repassword: repassword
                    },
                    success: function (response) {
                        if (response.status === 'success') {
                            // Chuyển hướng người dùng sau đăng ký thành công
                            window.location.href = response.redirect;
                        } else {
                            // Hiển thị thông báo lỗi
                            $('#registerMessage').text(response.message);
                        }
                    }
                });
            });

            function clearErrors() {
                $('#fullnameError').text('');
                $('#usernameError').text('');
                $('#emailError').text('');
                $('#passwordError').text('');
                $('#repasswordError').text('');
                $('#registerMessage').text('');
            }
        });
    </script>
</body>

</html>
