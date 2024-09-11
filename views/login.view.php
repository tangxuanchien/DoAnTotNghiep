<?php 
require '../function.php';
session_start();
$title = "Đăng nhập";
$banner = "Danh sách việc cần làm";
$login = check_login($_SESSION['name']);
if(!isset($_SESSION['error'])){
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
    </style>

<body>
    <main class="form-signin w-100 m-auto mt-5">
        <form action="/Datn/controllers/login.controller.php" method="POST">
            <h1 class="h3 mb-3 fw-normal mt-5">Đăng nhập</h1>

            <div class="form-floating">
                <input type="text" class="form-control" name="phone" placeholder="0123-456-789">
                <label for="floatingInput">Số điện thoại</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" name="password" placeholder="Password">
                <label for="floatingPassword">Mật khẩu</label>
            </div>
            <button class="btn btn-primary w-100 py-2" type="submit">Đăng nhập</button>
        </form>
        <form action="/Datn/views/register.view.php" method="POST">
            <div>Nếu chưa có tài khoản hãy đăng kí</div>
            <div class="mt-2">
                <button class="btn btn-primary w-100 py-2" type="submit">Đăng kí</button>
            </div>
        </form>
        <div class="text-danger fw-semibold lh-1 fs-5 mt-3"><?= $_SESSION['error'] ?></div>
    </main>
</body>

</html>