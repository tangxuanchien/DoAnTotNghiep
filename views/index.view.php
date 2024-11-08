<?php
require 'routes.php';
session_start();

$title = "Trang chủ";
if (isset($_SESSION['id'])) {
    $banner = "Tìm kiếm theo tiêu đề";
} else $banner = "Vui lòng đăng nhập để xem việc làm";
if (!isset($_SESSION['name'])) {
    $login = 'Đăng nhập';
} else $login = $_SESSION['name'];


require 'partials/header.php';

require 'partials/navigation.php';

require 'partials/banner.php';


?>
<?php
if (isset($_SESSION['id'])) :
    require 'controllers/index.controller.php';

?>
<div class="btn-view-all">
    <form action="/Datn/views/property-all.view.php?page_number=1" method="post">
        <button type="submit" class="btn btn-dark">Xem tất cả bài đăng <i class="fa-solid fa-arrow-right text-light"></i></button>
    </form>
</div>
<?php
endif;
require 'partials/footer.php';
