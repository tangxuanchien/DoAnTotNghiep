<?php
session_start();
// require 'function.php';


$title = "Trang chủ";
if (isset($_SESSION['id'])) {
    $banner = "Danh sách việc cần làm";
} else $banner = "Vui lòng đăng nhập để xem việc làm";

if (!isset($_SESSION['name'])) {
    $login = 'Đăng nhập';
} else $login = 'Chào, ' . $_SESSION['name'];


require 'partials/header.php';

require 'partials/navigation.php';

require 'partials/banner.php';
?>
<!-- <div class="mt-5">
    <img src="/images/house.jpg" width="200px" alt="Ảnh nền">
</div> -->
<?php

// if (isset($_SESSION['id'])) {
require 'controllers/index.controller.php';
// }

require 'partials/footer.php';
