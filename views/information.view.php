<?php
session_start();
require '../function.php';

$title = "Thông tin cá nhân";
$login = check_login($_SESSION['name']);

if (isset($_SESSION['user_id'])) {
    $banner = "";
} else $banner = "Vui lòng đăng nhập để xem việc làm";

require 'partials/header.php';

require 'partials/navigation.php';

require 'partials/banner.php';

if (!empty($_SESSION['user_id'])) {
require '../controllers/information.controller.php';
}

require 'partials/footer.php';