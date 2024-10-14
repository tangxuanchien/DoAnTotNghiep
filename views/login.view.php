<?php
require '../function.php';
session_start();
$title = "Đăng nhập";
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
                title: "Đăng nhập thành công",
                text: "Nhấn OK để vào trang chủ",
                icon: "success",
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                customClass: {
                    timerProgressBar: '#progress-bar'
                }
            }).then(() => {
                // if (result.isConfirmed) {
                document.getElementById('loginForm').submit();
                // }
            });
        } else {
            Swal.fire({
                title: console.log(errorMessage()),
                text: "Bạn đang để trống tài khoản hoặc mật khẩu",
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
        <form action="/Datn/controllers/login.controller.php" method="POST" id="loginForm">
            <h1 class="h3 mb-3 fw-normal mt-5">Đăng nhập</h1>

            <div class="form-floating">
                <input type="text" class="form-control" name="phone" placeholder="0123-456-789" id="phone">
                <label for="floatingInput">Số điện thoại</label>
            </div>
            <div class="form-floating mt-2">
                <input type="password" class="form-control" name="password" placeholder="Password" id="password">
                <label for="floatingPassword">Mật khẩu</label>
            </div>
            <a href="/Datn/views/forgetpw.view.php" class="text-dark fw-bold">Quên mật khẩu</a>
            <button class="btn-login w-100 py-2" type="button" onclick="handleSubmit()">Đăng nhập</button>
        </form>
        <form action="/Datn/views/google-login/google-oauth.php" method="POST">
            <div>
                <button class=" w-100 py-2 btn-login-google" type="submit">
                    <img src="../images/google_icon.png" alt="google.icon" style="height:24px">
                    Đăng nhập bằng Google
                </button>
            </div>
        </form>
        <div>Nếu chưa có tài khoản? <a href="/Datn/views/register.view.php" class="text-dark fw-bold">Đăng kí tại đây</a></div>
        <div class="text-danger fw-semibold lh-1 fs-5 mt-3" id="error"><?= $_SESSION['error'] ?></div>
    </main>
</body>

</html>