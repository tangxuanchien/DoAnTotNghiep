<?php
session_start();
require '../function.php';

$title = "Xem tất cả";
$banner = "Xem tất cả";
$login = check_login($_SESSION['name']);

require 'partials/header.php';

require 'partials/navigation.php';

require 'partials/banner.php';

require '../controllers/property-all.controller.php';

require 'partials/footer.php';