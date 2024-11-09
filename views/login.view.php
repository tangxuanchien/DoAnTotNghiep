<?php
require '../function.php';
session_start();
$title = "Đăng nhập";
$banner = "Danh sách việc cần làm";
$login = check_login($_SESSION['name']);
if (!isset($_SESSION['error-login'])) {
    $_SESSION['error-login'] = '';
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


</style>
<script>
    function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            input.type = input.type === 'password' ? 'text' : 'password';
        }
</script>
<body>
    <main class="form-signin w-100 m-auto mt-5">
        <form action="/Datn/controllers/login.controller.php" method="POST" id="loginForm">
            <h1 class="h3 mb-3 fw-normal mt-5">Đăng nhập</h1>

            <div class="form-floating">
                <input type="text" class="form-control" name="phone" placeholder="" id="phone" required>
                <label for="floatingInput">Số điện thoại</label>
            </div>
            <div class="form-floating mt-2">
                <input type="password" class="form-control" name="password" placeholder="" id="password" required>
                <label for="floatingPassword">Mật khẩu</label>
                <span class="toggle-password" onclick="togglePassword('password')"><i class="fa-solid fa-eye"></i></span>
            </div>
            <a href="/Datn/views/confirm-email.view.php" class="text-dark fw-bold">Quên mật khẩu</a>
            <button class="btn-login w-100 py-2" type="submit">Đăng nhập</button>
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
        <div class="text-danger fw-semibold lh-1 fs-5 mt-3" id="error"><?= $_SESSION['error-login'] ?></div>
    </main>
</body>
<?php $_SESSION['error-login'] = "" ?>
</html>