<?php
session_start();
require '../function.php';

$title = "Đăng kí";
$banner = "Đăng kí tài khoản";
$login = check_login($_SESSION['name']);

require '../models/Database.php';

require '../partials/header.php';

require '../partials/navigation.php';

require '../partials/banner.php';

?>
<form action="/Datn/controllers/register.controller.php" method="POST">
    <div class="mb-3">
        <label  class="form-label">Họ và tên</label>
        <input type="name" class="form-control" placeholder="Nguyen Van A" name='name' value="">
    </div>
    <div class="mb-3">
        <label  class="form-label">Email</label>
        <input type="email" class="form-control" placeholder="name@gmail.com" name='email' value="">
    </div>
    <div class="mb-3">
        <label class="form-label">Số điện thoại</label>
        <input type="number" class="form-control" placeholder="09xx-xxx-xxx" name='phone' value="">
    </div>
    <div class="mb-3">
        <label  class="form-label">Mật khẩu</label>
        <input type="password" class="form-control" name='password' value="">
    </div>
    <div class="mt-5">
        <button type="submit" class="btn btn-primary">Đăng kí</button>
        <div class="mt-3 ml-3">
            <a href="/Datn/views/login.view.php" class="link-dark">Quay lại</a>
        </div>
    </div>
</form>
<?php
require '../partials/footer.php';
?>