<?php
require '../function.php';
session_start();
$title = "";
$banner = "Danh sách việc cần làm";
$login = check_login($_SESSION['name']);
if (!isset($_SESSION['error'])) {
    $_SESSION['error'] = '';
}
require 'partials/header.php';
require 'partials/navigation.php';
?>
<style>
    html,
    body {
        height: 100%;
    }

    .form-signin {
        max-width: 330px;
        padding: 1rem;
    }

    .form-signin .form-floating:focus-within {
        z-index: 2;
    }

    .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }

    .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }

    #progress-bar {
        background-color: #228B22;
    }

    .btn-login {
        border: 1px solid #cccccc;
        border-radius: 10px;
        font-weight: bold;
        background-color: black;
        color: white;
        margin-top: 20px;
    }

    .btn-login-google {
        border: 1px solid #cccccc;
        border-radius: 10px;
        font-weight: bold;
    }
</style>
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
</script>
<body>
    <main class="form-signin w-100 m-auto mt-5">
        <form action="/Datn/controllers/forget-password.controller.php" method="POST" id="forgetPassword">
            <h3 class="mb-3 fw-normal mt-5">Quên mật khẩu</h3>
            <div class="fw-normal">Vui lòng nhập email để gửi mã xác thực</div>
            <div class="form-floating">
                <input type="text" class="form-control" name="phone" placeholder="nguyenvana@gmail.com" id="email">
                <label for="floatingInput">Email</label>
            </div>
            <button class="btn-login w-100 py-2" type="button" onclick="handleSubmit()">Gửi mã xác nhận</button>
            <a href="/Datn/views/login.view.php"><i class="fa-solid fa-arrow-left"></i> Quay lại đăng nhập</a>
        </form>
</body>
