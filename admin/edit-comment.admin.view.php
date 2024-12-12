<?php
session_start();
require '../function.php';
require '../models/Database.php';

$title = "Chỉnh sửa bình luận";
$comment_id = $_POST['comment_id'];

$db = new Database();
$comment = $db->query("
SELECT * FROM `comments`
WHERE comment_id = :comment_id", [
    'comment_id' => $comment_id
])->fetch(PDO::FETCH_ASSOC);

require '../views/partials/header.php';
?>
<div class="container-create-post mt-5">
    <h2>Chỉnh sửa bình luận</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/Datn/admin/home.admin.php/comments">Trang quản trị</a></li>
            <li class="breadcrumb-item active" aria-current="page">Chỉnh sửa bình luận</li>
        </ol>
    </nav>
    <form action="/Datn/controllers/edit-comment.controller.php" method="GET" enctype="multipart/form-data" id="submit-post">
        <input type="hidden" name="comment_id" value="<?= $comment_id ?>">
        <input type="hidden" name="role" value="admin">
        <div class="mb-3">
            <label class="form-label">Mô tả chi tiết</label>
            <textarea placeholder="Mô tả chi tiết về bài đăng" class="form-control" name='content' required maxlength="300"><?= $comment['content'] ?></textarea>
        </div>
        <div class="mt-3 mb-5">
            <button type="submit" class="btn btn-primary" onclick="return confirm('Bạn chắc chắn chỉnh sửa bình luận không ?')">Chỉnh sửa</button>
        </div>
    </form>
</div>