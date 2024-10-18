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
        <form action="/Datn/controllers/confirm-email.controller.php" method="POST" id="forgetPassword">
            <h3>Quên mật khẩu</h3>
            <div>Vui lòng nhập email để gửi mã xác thực</div>
            <div class="form-floating">
                <input type="text" class="form-control" name="email" placeholder="nguyenvana@gmail.com">
                <label for="floatingInput">Email</label>
            </div>
            <button class="btn-confirm" type="submit">Gửi mã xác nhận</button>
            <div>
                <a href="/Datn/views/login.view.php"><i class="fa-solid fa-arrow-left"></i> Quay lại đăng nhập</a>
            </div>
            <div class="text-danger fw-semibold lh-1 fs-5 mt-3"><?= $_SESSION['error-reset'] ?></div>
        </form>
</div>