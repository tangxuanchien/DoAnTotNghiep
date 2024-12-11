<?php
session_start();
require '../function.php';
require '../models/Database.php';


$user_id = $_SESSION['user_id'];
$title = "Báo cáo";
$banner = "";
$login = check_login($_SESSION['name']);
if (!isset($_SESSION['error_report'])) {
    $_SESSION['error_report'] = '';
}

require 'partials/header.php';

require 'partials/navigation.php';

require 'partials/banner.php';
?>
<div class="container-create-post">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/Datn">Trang chủ</a></li>
            <li class="breadcrumb-item">
                <?php if ($_GET['source'] == 'detail'): ?>
                    <a href="/Datn/views/detail-post.view.php?post_id=<?= $_GET['post_id'] ?>">Chi tiết bài đăng</a>
                <?php endif ?>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Báo cáo bài viết</li>
        </ol>
    </nav>
    <h2>Báo cáo bài viết</h2>
    <form action="/Datn/controllers/report.controller.php" method="POST" enctype="multipart/form-data" id="submit-post">
        <div class="text-danger fw-semibold lh-1 fs-5 mt-3"><?= $_SESSION['error_report'] ?></div>
        <div class="mb-3">
            <label class="form-label">Mô tả chi tiết</label>
            <textarea placeholder="Mô tả chi tiết về nội dung cần báo cáo" class="form-control" name='content_report' required maxlength="60"></textarea>
        </div>
        <input type="hidden" name="post_report_id" value="<?= $_GET['post_id'] ?>">
        <div class="mb-3">
            <label class="form-label">Phân loại báo cáo</label></br>
            <select class="form-select" name="type_report" required>
                <option value="">--Chọn Loại--</option>
                <option value="post">Bài viết</option>
                <option value="comment">Bình luận</option>
                <option value="user">Người dùng</option>
            </select>
        </div>
        <div class="mt-3 mb-5">
            <button type="submit" class="btn btn-primary" onclick="return confirm('Bạn chắc chắn muốn gửi báo cáo không ?')">Gửi báo cáo</button>
            <div class="mt-3 ml-3">
                <a href="/Datn/views/login.view.php" class="link-dark">Quay lại</a>
            </div>
        </div>
    </form>
</div>