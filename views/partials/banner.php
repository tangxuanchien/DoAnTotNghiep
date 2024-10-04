<?php if($_SERVER['REQUEST_URI'] === '/Datn/') :?>
<div class="image-banner">
    <img src="/Datn/images/banner.jpg" alt="banner" style="width: -webkit-fill-available;">
</div>
<div class="slogan">
    <h3>TẠI SAO LẠI LÀ HANOIHOME ?</h3>
    <ul>
        <li>
            <img src="/Datn/images/hand.png" alt="banner" width="100px"></br>
            <div class="slogan-text">
                <h5>Tiên phong</h5>
                <p>Chúng tôi là đơn vị tiên phong trong lĩnh vực</p>
                <p>môi giới nhà ở, căn hộ, chung cư, nhà đất</p>
            </div>
        </li>
        <li>
            <img src="/Datn/images/magnifying-glass.png" alt="banner" width="100px"></br>
            <div class="slogan-text">
                <h5>Đơn giản</h5>
                <p>Thao tác sử dụng vô cùng đơn giản</p>
                <p>chỉ với vài bước là có thể đăng bài liên hệ</p>
            </div>
        </li>
        <li>
            <img src="/Datn/images/handshake.png" alt="banner" width="100px"></br>
            <div class="slogan-text">
                <h5>Phát triển</h5>
                <p>Trong tương lai HANOIHOME sẽ cố gắng mang tới</p>
                <p>nhiều sản phẩm tiện ích hơn cho người dùng</p>
            </div>
        </li>
    </ul>
</div>
<?php endif ?>
<div class="container-body">
    <h1><?= $banner ?></h1>