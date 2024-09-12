<?php
session_start();
require '../function.php';

$title = "Về chúng tôi";
$banner = "Giới thiệu về chúng tôi";
$login = check_login($_SESSION['name']);

require 'partials/header.php';

require 'partials/navigation.php';

require 'partials/banner.php';
?>

<h4 class="text-success mt-3">Lưu ý: Đăng nhập khi sử dụng trang web để bảo mật các thông tin quan trọng</h4>
<div>
    Đoạn mã được sử dụng cho báo cáo thực tập tốt nghiệp vui lòng không tái sử dụng dưới mọi hình thức</br>
    <div class="mt-5">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/4b/LOGO_DHXD.png/1037px-LOGO_DHXD.png" width="200px" alt="Ảnh logo trường">
    </div>
</div>
<?php
require 'partials/footer.php';