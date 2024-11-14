<?php
session_start();
require '../function.php';

$title = "Đăng kí";
$banner = "Đăng kí tài khoản";
$login = check_login($_SESSION['name']);
if (empty($_SESSION['error_register'])) {
    $_SESSION['error_register'] = "";
}

require '../models/Database.php';

require 'partials/header.php';

require 'partials/navigation.php';

require 'partials/banner.php';

?>
<div style="width: 60%;">
    <form action="/Datn/controllers/register.controller.php" method="POST" id="registerForm">
        <div class="row g-3">
            <div class="col">
                <label class="form-label">Họ và tên</label>
                <input type="text" class="form-control" placeholder="Nguyen Van A" name='name' required minlength="6">
            </div>
            <div class="col">
                <label class="form-label">Số CCCD</label>
                <input type="number" class="form-control" name='citizen_id' required min="10000000000" max="99999999999">
            </div>
        </div>
        <div class="row g-3">
            <div class="col">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" placeholder="nguyenvana@gmail.com" name='email' required>
            </div>
            <div class="col">
                <label class="form-label">Số điện thoại</label>
                <input type="number" class="form-control" name='phone' required min="100000000" max="999999999">
            </div>
        </div>
        <div class="mb-3 password-container">
            <label for="confirmPassword" class="form-label">Mật khẩu</label>
            <input type="password" class="form-control" id="password" name="password" required minlength="8">
            <span class="toggle-password" onclick="togglePassword('password')"><i class="fa-solid fa-eye"></i></span>
        </div>
        <div class="mb-3 password-container">
            <label for="confirmPassword" class="form-label">Xác nhận mật khẩu</label>
            <input type="password" class="form-control" id="confirmPassword" name="confirm_password" required minlength="8">
            <span class="toggle-password" onclick="togglePassword('confirmPassword')"><i class="fa-solid fa-eye"></i></span>
        </div>
        <div class="mt-5 btn-submit">
            <ul>
                <li>
                    <button type="submit" class="btn btn-primary" onclick="return confirm('Bạn chắc chắn muốn đăng kí tài khoản với thông tin trên')">Đăng kí</button>
                </li>
                <li style="margin-left: 30px;">
                    <form action="/Datn/views/login.view.php" method="post">
                        <button type="submit" class="btn btn-dark">Quay lại</btn>
                    </form>
                </li>
            </ul>
        </div>
</div>
</form>
<div class="text-danger fw-semibold lh-1 fs-5 mt-3"><?= $_SESSION['error_register'] ?></div>
</div>
<?= $_SESSION['error_register'] = "" ?>
<script>
    function togglePassword(inputId) {
        const input = document.getElementById(inputId);
        input.type = input.type === 'password' ? 'text' : 'password';
    }
</script>
<?php
require 'partials/footer.php';
?>