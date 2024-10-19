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
$uuid = $_GET['uuid'];
$verification_code = $_GET['verification_code'];
?>
<script>
    function errorMessage() {
        let message = document.getElementById('error');
        if (phoneInput.value === 1) {
            return "Sai tài khoản hoặc mật khẩu";
        } else {
            return "Bạn đang để trống tài khoản hoặc mật khẩu";
        }
    }

    function handleSubmit() {
        let emailInput = document.getElementById('phone');
        if (emailInput.value) {
            Swal.fire({
                title: "Xác thực thành công",
                text: "Vui lòng kiểm tra email để lấy mật khẩu",
                icon: "success",
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                customClass: {
                    timerProgressBar: '#progress-bar'
                }
            }).then(() => {
                // if (result.isConfirmed) {
                document.getElementById('forgetPassword').submit();
                // }
            });
        } else {
            Swal.fire({
                title: console.log(errorMessage()),
                text: "Sai Email",
                icon: "error",
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
            });
        }
    }
</script>

<div class="reset-pwd">
        <form action="/Datn/controllers/reset-pwd.controller.php?uuid=<?=$uuid?>&verification_code=<?=$verification_code?>" method="POST" id="resetPassword">
            <h3>Quên mật khẩu</h3>
            <div>Vui lòng nhập email để gửi mã xác thực</div>
            <div class="form-floating">
                <input type="password" class="form-control" name="password" placeholder="">
                <label for="floatingInput">Mật khẩu</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" name="confirm_password" placeholder="">
                <label for="floatingInput">Xác nhận mật khẩu</label>
            </div>
            <button class="btn-confirm" type="submit">Xác nhận</button>
            <div>
                <a href="/Datn/views/login.view.php"><i class="fa-solid fa-arrow-left"></i> Quay lại đăng nhập</a>
            </div>
            <div class="text-danger fw-semibold lh-1 fs-5 mt-3"><?= $_SESSION['error-reset'] ?></div>
        </form>
</div>