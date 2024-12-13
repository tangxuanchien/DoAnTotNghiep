<?php
session_start();
require 'header.admin.php';
$_SESSION['email-success'] = (!isset($_SESSION['email-success'])) ?  '' : $_SESSION['email-success']; 
?>
<div class="container mt-5 w-75">
    <h2 class="mb-2">Phản hồi Email cho khách hàng</h2>
    <form action="/Datn/admin/email-feedbacks.admin.controller.php" method="POST" enctype="multipart/form-data" id="submit-post">
        <input type="hidden" name="role" value="admin">
        <div class="mb-3">
            <label class="form-label">Tiêu đề email</label>
            <input type="text" placeholder="Tiêu đề" class="form-control" name='title' required maxlength="50"></input>
        </div>
        <div class="mb-3">
            <label class="form-label">Email khách hàng</label>
            <input type="email" placeholder="example@gmail.com" class="form-control" name='email' required></input>
        </div>
        <div class="mb-3">
            <label class="form-label">Nội dung chi tiết</label>
            <textarea placeholder="Nội dung chi tiết" class="form-control" name='content' required maxlength="300"></textarea>
        </div>
        <div class="mt-3 mb-4">
            <button type="submit" class="btn btn-primary" onclick="return confirm('Xác nhận gửi Email ?')"><i class="fa-solid fa-envelope"></i> Gửi Email</button>
        </div>
    </form>
    <h4 class="text-success"><?= $_SESSION['email-success'] ?></h4>
</div>
<?php $_SESSION['email-success'] = '' ?>