<?php
session_start();
require '../function.php';

$title = "Tạo bài đăng";
$banner = "Bài đăng mới";
$login = 'Đăng nhập';

require 'partials/header.php';

require 'partials/navigation.php';

require 'partials/banner.php';
?>
<style>
    .text-number {
        width: 50px;
        border-radius: 5px;
    }

    .ml {
        margin-left: 30px;
    }
    .ml-input{
        margin-left: 15px;
    }
</style>
<form action="/Datn/controllers/register.controller.php" method="POST">
    <div class="mb-3">
        <label class="form-label">Tiêu đề</label>
        <input type="name" class="form-control" placeholder="Tiêu đề ngắn gọn" name='tilte'>
    </div>
    <div class="mb-3">
        <label class="form-label">Mô tả chi tiết</label>
        <textarea name="description" placeholder="Mô tả chi tiết về bài đăng" class="form-control"></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Giá bán</label>
        <input type="email" class="form-control" placeholder="đơn vị tỉ đồng" name='email'>
    </div>
    <div class="mb-3">
        <label class="form-label">Số điện thoại liên hệ người bán</label>
        <input type="number" class="form-control" placeholder="09xx-xxx-xxx" name='contact_info'>
    </div>
    <div class="mb-3">
        <label class="">Số phòng ngủ</label>
        <input type="number" class="text-number ml-input" name='num_bedrooms'>

        <label class="ml">Số phòng vệ sinh</label>
        <input type="number" class="text-number ml-input" name='num_bathrooms'>
    </div>
    <div class="mt-5">
        <button type="submit" class="btn btn-primary">Đăng bài</button>
        <div class="mt-3 ml-3">
            <a href="/Datn/views/login.view.php" class="link-dark">Quay lại</a>
        </div>
    </div>
</form>
<?php
require 'partials/footer.php';
?>