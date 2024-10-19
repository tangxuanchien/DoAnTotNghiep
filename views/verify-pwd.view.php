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
<script>
    function handleSubmit() {
        let phoneInput = document.getElementById('phone');
        let error = "document.getElementById('phone')";
        let passwordInput = document.getElementById('password');
        if (phoneInput.value && passwordInput.value) {
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

    function countDown() {
        let timeLeft = 90;
        const countdownTimer = setInterval(function() {
            timeLeft--;
            document.getElementById('countdown').innerHTML = timeLeft + 's';

            if (timeLeft <= 0) {
                clearInterval(countdownTimer);
                document.getElementById('countdown').innerHTML = "Hết giờ!";
            }
        }, 1000);

    }
    window.onload = function() {
        countDown();
    };
</script>

<div class="reset-pwd">
        <form action="/Datn/controllers/verify-pwd.controller.php?email=<?=$email?>" method="POST" id="forgetPassword">
            <h3>Xác nhận bằng email</h3>
            <div>Vui lòng nhập mã xác được gửi tới email</div>
            <div class="form-floating">
                <input type="text" class="form-control" name="verification_code">
                <label for="floatingInput">Mã xác nhận</label>
            </div>
            <button class="btn-confirm" type="submit">Xác nhận</button>
            <div>
                <a href="/Datn/views/login.view.php"><i class="fa-solid fa-arrow-left"></i> Quay lại đăng nhập</a>
            </div>
            <div class="text-danger fw-semibold lh-1 fs-5 mt-3"><?= $_SESSION['error_verify'] ?></div>
        </form>
</div>