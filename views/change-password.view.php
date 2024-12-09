<?php
session_start();
require '../function.php';

$title = "Quản lí bài đăng";
$banner = "";
$login = check_login($_SESSION['name']);
if (empty($_SESSION['error_change_password'])) {
    $_SESSION['error_change_password'] = "";
}

require 'partials/header.php';

require 'partials/navigation.php';

require 'partials/banner.php';

?>

<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">THAY ĐỔI MẬT KHẨU</h3>
                    </div>
                    <div class="card-body">
                        <form id="passwordChangeForm" action="/Datn/controllers/change-password.controller.php" method="post">
                            <div class="mb-3 password-container">
                                <label for="currentPassword" class="form-label">Mật khẩu hiện tại</label>
                                <input type="password" class="form-control" id="currentPassword" name="current_password" required minlength="8">
                                <span class="toggle-password" onclick="togglePassword('currentPassword')"><i class="fa-solid fa-eye"></i></span>
                            </div>
                            <div class="mb-3 password-container">
                                <label for="newPassword" class="form-label">Mật khẩu mới</label>
                                <input type="password" class="form-control" id="newPassword" name="new_password" required minlength="8">
                                <span class="toggle-password" onclick="togglePassword('newPassword')"><i class="fa-solid fa-eye"></i></span>
                            </div>
                            <div class="mb-3 password-container">
                                <label for="confirmPassword" class="form-label">Xác nhận mật khẩu mới</label>
                                <input type="password" class="form-control" id="confirmPassword" name="confirm_password" required minlength="8">
                                <span class="toggle-password" onclick="togglePassword('confirmPassword')"><i class="fa-solid fa-eye"></i></span>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
                            </div>
                        </form>
                        <div class="text-danger fw-semibold lh-1 fs-5 mt-3"><?= $_SESSION['error_change_password'] ?></div>
                    </div>
                </div>
                <div class="mt-3">
                    <form action="/Datn/" method="post">
                        <button type="submit" class="btn btn-dark"><i class="fa-solid fa-arrow-left-long text-light"></i> Quay về trang chủ</button>
                    </form>
                </div>
                <?= $_SESSION['error_change_password'] = ""?>
            </div>
        </div>
    </div>
    <script>
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            input.type = input.type === 'password' ? 'text' : 'password';
        }
    </script>
</body>
<?php
require 'partials/footer.php';
