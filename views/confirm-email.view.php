<?php
require '../function.php';
session_start();
$title = "";
$banner = "Danh sách việc cần làm";
$login = check_login($_SESSION['name']);
if (!isset($_SESSION['error-reset'])) {
    $_SESSION['error-reset'] = '';
}
require 'partials/header.php';

require 'partials/navigation.php';
?>
<div class="reset-pwd">
        <form action="/Datn/controllers/confirm-email.controller.php" method="GET" id="forgetPassword">
            <h3>Quên mật khẩu</h3>
            <div>Vui lòng nhập email để gửi mã xác thực</div>
            <div class="form-floating">
                <input type="email" class="form-control" name="email" placeholder="nguyenvana@gmail.com" required>
                <label for="floatingInput">Email</label>
            </div>
            <button class="btn-confirm" type="submit">Gửi mã xác nhận</button>
            <div>
                <a href="/Datn/views/login.view.php"><i class="fa-solid fa-arrow-left"></i> Quay lại đăng nhập</a>
            </div>
            <div class="text-danger fw-semibold lh-1 fs-5 mt-3"><?= $_SESSION['error-reset'] ?></div>
        </form>
</div>
<?php $_SESSION['error-reset']  = ''?>