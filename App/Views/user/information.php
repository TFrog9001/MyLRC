<?php require_once '../App/Views/menu/header.php'; ?>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom"><i
                    class="fas fa-book-open me-2"></i></i>My LRC</div>
            <div class="list-group list-group-flush my-3">
                <a href="/books" class="list-group-item list-group-item-action bg-transparent second-text active"><i
                        class="fas fa-book me-2"></i>Books</a>
                <a href="/history" class="list-group-item list-group-item-action bg-transparent second-text active"><i
                        class="fas fa-address-book me-2"></i>Borrow History</a>
                <a href="/logout" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i
                        class="fas fa-power-off me-2"></i>Logout</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0">Home</h2>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle second-text fw-bold" href="#" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user me-2"></i>
                                <?php echo $_SESSION['user_name'] ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="/infor">Profile</a></li>
                                <li><a class="dropdown-item" href="/history">History Borrow</a></li>
                                <li><a class="dropdown-item" href="/logout">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="row m-4">
                <h3>Thông tin người dùng</h3>
                <form class="col-5">
                    <div class="form-group mb-3">
                        <label for="user-id"><i class="fas fa-id-badge"></i> UserID:</label>
                        <input type="text" class="form-control" id="user-id" name="user-id"
                            value="<?= $user['UserID'] ?>">
                    </div>
                    <div class="form-group mb-3">
                        <label for="username"><i class="fas fa-user-circle"></i> Username:</label>
                        <input type="text" class="form-control" id="username" name="username"
                            value="<?= $user['Username'] ?>">
                    </div>
                    <div class="form-group mb-3">
                        <label for="full-name"><i class="fas fa-user"></i> Họ tên:</label>
                        <input type="text" class="form-control text-capitalize" id="full-name" name="full-name"
                            value="<?= $user['FullName'] ?>">
                    </div>
                    <div class="form-group mb-3">
                        <label for="email"><i class="fas fa-envelope"></i> Email:</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= $user['Email'] ?>">
                    </div>
                </form>

            </div>

        </div>
    </div>
    </div>
    <!-- /#page-content-wrapper -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs4/dt-1.13.6/datatables.min.js"></script>
    <script>
        $('#books_table').DataTable();
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };
    </script>
</body>

</html>