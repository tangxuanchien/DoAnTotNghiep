<?php
session_start();
require '../function.php';

$title = 'Xem chi tiết';
$login = 'Đăng nhập';
$login = check_login($_SESSION['name']);

if (isset($_SESSION['user_id'])) {
$banner = "Chi tiết bài đăng";
} else $banner = "Vui lòng đăng nhập để xem thông tin";


require 'partials/header.php';

require 'partials/navigation.php';

require 'partials/banner.php';

if (isset($_SESSION['user_id'])) {
require '../controllers/detail.property.controller.php';
}

require 'partials/footer.php';
