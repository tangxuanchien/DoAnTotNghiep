<?php
$id = $_SESSION['id'];
require '../models/Database.php';
// require '../function.php';
$db = new Database();
$user = $db->query("SELECT * FROM `users` where user_id = $id")->fetch(PDO::FETCH_ASSOC);
$date = date_parse($user['created_at']);
?>

<div>
        Tên người dùng: <b><?= $user['name']?></b></br>
        Email người dùng: <b><?= $user['email']?></b></br>
        Số điện thoại người dùng: <b><?= $user['phone']?></b></br>
        Mật khẩu người dùng: <b><?= $user['password']?></b></br>
        Đã tham gia vào: <b><?=$date['day'].'-'.$date['month'].'-'.$date['year']?></b></br>
</div>
<form action="/Datn/views/information.update.view.php?id=<?=$id?>" method="post" class="mt-3">
    <button type="submit">Chỉnh sửa thông tin cá nhân</button>
</form>
<form action="/Datn/controllers/logout.controller.php" method="post" class="mt-3">
    <button type="submit">Đăng xuất</button>
</form>