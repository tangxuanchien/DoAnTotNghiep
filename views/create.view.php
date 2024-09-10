<?php
session_start();
require '../function.php';

$title = "Việc cần làm";
$banner = "Thêm mới việc làm";
$login = check_login($_SESSION['name']);
if(!isset($_SESSION['textbody'])){
    $_SESSION['textbody'] = '';
}

require '../partials/header.php';

require '../partials/navigation.php';

require '../partials/banner.php';
?>
<form action="/Datn/controllers/create.controller.php" method="POST">
    <div class="text-danger fw-semibold lh-1 fs-5"><?= $_SESSION['textbody'] ?></div>
    <div class="form-floating mt-3">
        <textarea class="form-control"  style="height: 100px" name="body"></textarea>
    </div>
    <div class="mt-5">
        <button type="submit" class="btn btn-primary">Thêm việc làm</button>
    </div>
    <div class="mt-2">
        <button type="reset" class="btn btn-primary">Đặt lại</button>
    </div>
</form>
<?php
require '../partials/footer.php';
?>