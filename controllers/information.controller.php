<?php
$id = $_SESSION['id'];
require '../models/Database.php';
$db = new Database();
$user = $db->query("SELECT * FROM `users` where user_id = $id")->fetch(PDO::FETCH_ASSOC); 
?>

<div>
        Tên người dùng: <b><?= $user['name']?></b></br>
        Email người dùng: <b><?= $user['email']?></b></br>
        Số điện thoại người dùng: <b><?= $user['phone']?>VND (Có thương lượng)</b></br>
        Mật khẩu người dùng: <b><?= $user['password']?></b></br>
        Ngày tạo tài khoản: <b><?= $user['created_at']?></b></br>
        Ngày cập nhật tài khoản: <b><?= $user['updated_at']?></b></br>
</div>
<form action="/Datn/controllers/logout.controller.php" method="post" class="mt-3">
    <button type="submit">Đăng xuất</button>
</form>