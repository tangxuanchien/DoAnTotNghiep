<?php
session_start();

$title = "Việc cần làm";

$user_id = $_POST['user_id'];
require '../models/Database.php';
$db = new Database();
$user = $db->query("SELECT * FROM `users` WHERE user_id = $user_id")->fetch(PDO::FETCH_ASSOC);

$password = $user['password'];
$confirmpassword = '';
require '../views/partials/header.php';

?>
<div style="width: 50%; margin-bottom: 50px; margin-left: 120px;" class="mt-5">
    <h1>Chỉnh sửa thông tin người dùng</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/Datn/admin/home.admin.php/users">Trang chủ quản trị</a></li>
            <li class="breadcrumb-item active" aria-current="page">Chỉnh sửa thông tin</li>
        </ol>
    </nav>
    <form action="/Datn/controllers/edit-information.controller.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" value="<?= $user_id ?>" name="user_id">
        <input type="hidden" value="admin" name="role">
        <div class="mb-3">
            <label class="form-label">Họ và tên</label>
            <input type="text" class="form-control" placeholder="Nguyen Van A" name='name' value="<?= $user['name'] ?>" required minlength="6">
        </div>
        <div class="mb-3">
            <label class="form-label">Giới thiệu (dưới 200 kí tự)</label>
            <textarea type="text" class="form-control" placeholder="Giới thiệu ngắn gọn" name='introduce' maxlength="200"><?= $user['introduce'] ?></textarea>
        </div>
        <?php if ($_SESSION['method'] == 'local'): ?>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" placeholder="name@gmail.com" name='email' value="<?= $user['email'] ?>" required>
            </div>
        <?php endif ?>
        <div class="mb-3">
            <label class="form-label">Số điện thoại</label>
            <input type="number" class="form-control" placeholder="09xx-xxx-xxx" name='phone' value="<?= $user['phone'] ?>" <?= ($_SESSION['method'] == 'google') ? '' : 'required min="100000000" max="999999999"' ?>>
        </div>
        <div class="mb-3">
            <label class="form-label">Căn cước công dân</label>
            <input type="number" class="form-control" placeholder="Số CCCD" name='citizen_id' value="<?= $user['citizen_id'] ?>" <?= ($_SESSION['method'] == 'google') ? '' : 'required min="10000000000" max="99999999999"' ?>>
        </div>
        <div class="mb-3">
            <label class="form-label">Chọn ảnh để tải lên: Định dạng JPEG, PNG (Lưu ý chọn ảnh mới và nó sẽ thay thế các ảnh cũ bạn đã chọn)</label>
            <input class="form-control mb-3" type="file" name="image" id="image" onchange="previewImage()">

            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" name="keep_images" value="yes" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Giữ lại ảnh cũ
                </label>
            </div>
            <div id="preview">
                <img src="<?= $user['avatar'] ?>" alt="preview" width="200px">
            </div>
        </div>
        <div class="mt-5 btn-submit">
            <ul>
                <li>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </li>
                <li style="margin-left: 20px;">
                    <form action="/Datn/admin/home.admin.php/users" method="post">
                        <button type="submit" class="btn btn-dark">Quay lại</button>
                    </form>
                </li>
            </ul>
        </div>
    </form>
</div>
<script>
    function previewImage() {
        const preview = document.getElementById('preview');
        preview.innerHTML = '';
        const files = document.getElementById('image').files;

        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const reader = new FileReader();

            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.maxWidth = '150px';
                img.style.marginRight = '10px';
                preview.appendChild(img);
            }

            reader.readAsDataURL(file);
        }
    }
</script>