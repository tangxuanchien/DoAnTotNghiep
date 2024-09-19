<?php
session_start();

$title = "Việc cần làm";
$banner = "Thay đổi thông tin";
$login = 'Chào, ' . $_SESSION['name'];

$id = $_GET['id'];
require '../models/Database.php';
$db = new Database();
$user = $db->query("SELECT * FROM `users` WHERE user_id = $id")->fetch(PDO::FETCH_ASSOC);

require 'partials/header.php';

require 'partials/navigation.php';

require 'partials/banner.php';

$password = $user['password'];
$confirmpassword = '';
?>
<form action="/Datn/controllers/information.update.controller.php?id=<?= $id ?>" method="POST">
    <div class="mb-3">
        <label  class="form-label">Họ và tên</label>
        <input type="text" class="form-control" placeholder="Nguyen Van A" name='name' value="<?= $user['name'] ?>">
    </div>
    <div class="mb-3">
        <label  class="form-label">Email</label>
        <input type="email" class="form-control" placeholder="name@gmail.com" name='email' value="<?= $user['email'] ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Số điện thoại</label>
        <input type="number" class="form-control" placeholder="09xx-xxx-xxx" name='phone' value="<?= $user['phone'] ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Căn cước công dân</label>
        <input type="text" class="form-control" placeholder="Số CCCD" name='citizen_id' value="<?= $user['citizen_id'] ?>">
    </div>
    <div class="mb-3">
        <label  class="form-label">Mật khẩu</label>
        <input type="password" class="form-control" name='password' value="<?= $user['password'] ?>">
    </div>
    <div class="mt-5">
        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </div>
</form>
<?php
require 'partials/footer.php';
?>