<?php
require '../function.php';
session_start();
$title = "";
$banner = "";
$login = check_login($_SESSION['name']);
if (!isset($_SESSION['error_verify'])) {
    $_SESSION['error_verify'] = '';
}
require 'partials/header.php';
require 'partials/navigation.php';
$email = $_GET['email'];
?>
<div class="reset-pwd">
    <form action="/Datn/controllers/verify-pwd.controller.php?email=<?= $email ?>" method="POST" id="forgetPassword">
        <h3>Xác nhận bằng email</h3>
        <div>Vui lòng nhập mã xác được gửi tới email</div>
        <div class="form-floating">
            <input type="text" class="form-control" name="verification_code">
            <label for="floatingInput">Mã xác nhận</label>
        </div>
        <button class="btn-confirm" type="submit">Xác nhận</button>
        <h5 class="mt-2 text-success">Mã có hiệu lực trong 1 phút</h5>
        <div>
            <a href="/Datn/controllers/confirm-email.controller.php?email=<?= $email ?>"><i class="fa-solid fa-envelope"></i> Gửi lại mã xác nhận</a>
        </div>
        <div>
            <a href="/Datn/views/login.view.php"><i class="fa-solid fa-arrow-left"></i> Quay lại đăng nhập</a>
        </div>
        <div class="text-danger fw-semibold lh-1 fs-5 mt-3"><?= $_SESSION['error_verify'] ?></div>
    </form>
</div>
<?php $_SESSION['error_verify']  = '' ?>