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
                        <form id="loginForm" method="post" action="/checklogin" enctype="multipart/form-data">
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
                            <p id="loginMessage" class="text-danger"></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="	https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#loginForm').submit(function (e) {
                e.preventDefault();
                clearErrors();
                let username = $('#username').val();
                let password = $('#password').val();

                // Kiểm tra validate tên đăng nhập
                if (username.length < 6) {
                    $('#usernameError').text('Tên đăng nhập phải có ít nhất 6 kí tự.');
                } else if (!/\d/.test(username)) {
                    $('#usernameError').text('Tên đăng nhập phải chứa ít nhất một kí tự số.');
                }

                // Kiểm tra validate mật khẩu
                if (password.length < 8) {
                    $('#passwordError').text('Mật khẩu phải có ít nhất 8 kí tự.');
                }

                if (username.length >= 6 && /\d/.test(username) && password.length >= 8) {
                    $.ajax({
                        type: 'POST',
                        url: '/login',
                        data: {
                            username: username,
                            password: password
                        },
                        success: function (response) {
                            if (response === "success") {
                                window.location.href = "/Home";
                            } else {
                                $('#loginMessage').text('Tên đăng nhập hoặc mật khẩu không đúng.');
                            }
                        }
                    });
                }
            });

            function clearErrors() {
                $('#usernameError').text('');
                $('#passwordError').text('');
            }
        });
    </script>
</body>

</html>