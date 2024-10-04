<?php
session_start();

$title = "Trang chủ";
if (isset($_SESSION['id'])) {
    $banner = "Trang chủ";
} else $banner = "Vui lòng đăng nhập để xem việc làm";
if (!isset($_SESSION['name'])) {
    $login = 'Đăng nhập';
} else $login = 'Chào, ' . $_SESSION['name'];


require 'partials/header.php';

require 'partials/navigation.php';

require 'partials/banner.php';


?>
<?php
if (isset($_SESSION['id'])) :
    require 'controllers/index.controller.php';
endif;
?>
<div class="btn-view-all">
    <form action="/Datn/views/property-all.view.php" method="post">
        <button type="submit">Xem tất cả <i class="fa-solid fa-arrow-right"></i></button>
    </form>
</div>

<?php
require 'partials/footer.php';
