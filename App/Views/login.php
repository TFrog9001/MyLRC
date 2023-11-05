<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header fs-3">Đăng Nhập</div>
                    <div class="card-body">
                        <form id="loginForm">
                            <div class="form-group">
                                <label for="username">Tên đăng nhập:</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                                <p id="usernameError" class="text-danger"></p>
                            </div>
                            <div class="form-group">
                                <label for="password">Mật khẩu:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                                <p id="passwordError" class="text-danger"></p>
                            </div>
                            <input name="login" type="submit" class="btn btn-primary" value="Đăng Nhập">
                            <a class="ms-2 btn btn-success" href="/register">Đăng ký</a>
                            <p id="loginMessage" class="text-danger"></p>
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
            $('#loginForm').submit(function (e) {
                e.preventDefault(); // Ngăn chặn gửi mặc định

                clearErrors();
                let username = $('#username').val();
                let password = $('#password').val();

                // Kiểm tra validate tên đăng nhập
                if (username.length < 6 || !/\d/.test(username)) {
                    $('#usernameError').text('Tên đăng nhập phải có ít nhất 6 kí tự và chứa ít nhất một kí tự số.');
                    return;
                }

                // Kiểm tra validate mật khẩu
                if (password.length < 6) {
                    $('#passwordError').text('Mật khẩu phải có ít nhất 6 kí tự.');
                    return;
                }

                // Dùng Ajax để gửi dữ liệu đăng nhập
                $.ajax({
                    type: 'POST',
                    url: '/login', // Đặt địa chỉ xử lý đăng nhập của bạn
                    data: {
                        username: username,
                        password: password
                    },
                    success: function (response) {
                        if (response.status === 'success') {
                            // Chuyển hướng người dùng sau đăng nhập thành công
                            window.location.href = response.redirect;
                        } else {
                            $('#loginMessage').text(response.message);
                        }
                    }
                });
            });

            function clearErrors() {
                $('#usernameError').text('');
                $('#passwordError').text('');
                $('#loginMessage').text('');
            }
        });
    </script>

</body>

</html>