<?php
session_start();
require '../function.php';

$title = "Thông tin cá nhân";
$login = check_login($_SESSION['name']);

if (isset($_SESSION['id'])) {
    $banner = "Thông tin cá nhân";
} else $banner = "Vui lòng đăng nhập để xem việc làm";
// $banner = check_banner($_SESSION['id'], "Vui lòng đăng nhập để xem thông tin", "Thông tin cá nhân");


require 'partials/header.php';

require 'partials/navigation.php';

require 'partials/banner.php';

if (!empty($_SESSION['id'])) {
require '../controllers/information.controller.php';
}

require 'partials/footer.php';