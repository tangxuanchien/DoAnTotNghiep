<?php
session_start();
require '../function.php';

$title = "Đăng kí";
$banner = "Đăng kí tài khoản";
$login = check_login($_SESSION['name']);

require '../models/Database.php';

require 'partials/header.php';

require 'partials/navigation.php';

require 'partials/banner.php';

?>
<script>
    function handleSubmit() {
        Swal.fire({
            title: "Đăng kí thành công",
            text: "Nhấn OK để về trang đăng nhập",
            icon: "success",
            confirmButtonText: "OK"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('registerForm').submit();
            }
        });
    }
</script>
<form action="/Datn/controllers/register.controller.php" method="POST" id="registerForm">
    <div class="row g-3">
        <div class="col">
            <label class="form-label">Họ và tên</label>
            <input type="text" class="form-control" placeholder="Nguyen Van A" name='name'>
        </div>
        <div class="col">
            <label class="form-label">Số CCCD</label>
            <input type="text" class="form-control" placeholder="Số ghi trong Căn cước công dân" name='citizen_id'>
        </div>
    </div>
    <div class="row g-3">
        <div class="col">
            <label class="form-label">Email</label>
            <input type="text" class="form-control" placeholder="nguyenvana@gmail.com" name='email'>
        </div>
        <div class="col">
            <label class="form-label">Số điện thoại</label>
            <input type="text" class="form-control" placeholder="09xx xxx xxx" name='phone'>
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label">Mật khẩu</label>
        <input type="password" class="form-control" name='password' value="">
    </div>
    <div class="mt-5">
        <button type="button" class="btn btn-primary" onclick="handleSubmit()">Đăng kí</button>
        <div class="mt-3 ml-3">
            <a href="/Datn/views/login.view.php" class="link-dark">Quay lại</a>
        </div>
    </div>
</form>
<?php
require 'partials/footer.php';
?>