<?php
$id = $_SESSION['id'];
require '../models/Database.php';
$db = new Database();
$property = $db->query("SELECT * FROM `users` WHERE id = $id")->fetch(PDO::FETCH_ASSOC); 
?>

<h4 class="text-success mt-3">Lưu ý: Đăng nhập khi sử dụng trang web để bảo mật các thông tin quan trọng</h4>
<div>
        Tên người dùng: <b><?= $property['name']?></b></br>
        Email: <b><?= $property['email']?></b></br>
        Số điện thoại: <b><?= $property['phone']?></b>
</div>
<div class="mt-5">
    <a href="/Datn/views/information.update.view.php?id=<?=$id?>" class="text-dark h5">Thay đổi thông tin</a></br>
    <div class="mt-2">
        <a href="/Datn/controllers/information.controller.php" class="text-danger h5">Đăng xuất</a>
    </div>
</div>