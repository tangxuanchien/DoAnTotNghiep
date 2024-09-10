<?php

$id = $_GET['id'];
require '/models/Database.php';
$db = new Database();
$property = $db->query("SELECT * FROM `notes` WHERE id = $id")->fetch(PDO::FETCH_ASSOC); //fetchAll cho nhieu ban ghi
?>
<div>
    <?= $property['body']; ?></br>
    <div class="mt-5">
        <a href="/Datn/views/update.view.php?id=<?= $property['id'] ?>">CẬP NHẬT VIỆC LÀM</a></br>
    </div>
    <div class="mt-2">
        <a href="/Datn/controllers/delete.controller.php?id=<?= $property['id'] ?>" onclick="return  confirm('Bạn chắc chắn muốn xóa không ?')" class="text-danger">XÓA VIỆC LÀM</a>
    </div>
</div>