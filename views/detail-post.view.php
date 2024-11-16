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

require '../controllers/detail-post.controller.php'; ?>
<div class="position-relative">
    <div id="carouselAutoplaying" class="carousel slide container-detail" data-bs-ride="carousel" data-bs-interval="3000">
        <div class="carousel-inner">
            <div class="carousel-indicators">
                <?php for ($i = 0; $i < $first_slide['total']; $i++): ?>
                    <button type="button" data-bs-target="#carouselAutoplaying" data-bs-slide-to="<?= $i ?>" <?= ($i == 0) ? 'aria-current="true" class="active"' : NULL ?> aria-label="Slide <?= $i ?>"></button>
                <?php endfor ?>
            </div>
            <?php foreach ($slides as $index => $slide): ?>
                <div class="carousel-item <?= ($slide['image_id'] == $first_slide['min']) ? 'active' : '' ?>">
                    <a href="<?= $slide['image_url'] ?>" data-lightbox="image_property_<?= $index ?>" data-title="Ảnh mô tả">
                        <img src="<?= $slide['image_url'] ?>" class="d-block w-100" alt="Slide" style="width: 200px;">
                    </a>
                </div>
            <?php endforeach ?>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselAutoplaying" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselAutoplaying" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <div class="mt-3 detail-post">
            <h3><?= $post['title'] ?></h3>
            <i class="fa-solid fa-location-dot"></i> <?= 'Phường ' . $location['ward_name'] . ', Quận ' . $location['district_name'] . ', TP.Hà Nội, Việt Nam' ?></br>
            <div class="mt-3">
                <h4>Mô tả dự án</h4>
                <p><?= $post['description'] ?></p>
                <p>Diện tích: <?= $post['area'] ?></p>
                <p>Giá bán trên mét vuông: <?= $post['price_per_m2'] ?> triệu/m<sup>2</sup></p>
                <p>Phòng ngủ: <?= $post['num_bedrooms'] ?></p>
                <p>Phòng vệ sinh: <?= $post['num_bathrooms'] ?></p>
                <p>Giá bán: <?= strlen($post['price']) > 3 ? ($post['price'] / 1000) . ' tỷ' : $post['price'] . ' triệu' ?> (Có thương lượng)</p>
            </div>
        </div>
        <h4 class="mt-4">Tin đăng khác ở <?= 'quận ' . $location['district_name'] ?></h4>
        <div class="detail-post-related">
            <?php foreach ($posts_related as $post_related) : ?>
                <div class="detail-card card mx-3 mt-3" style="width: 21rem;">
                    <div class="card-body">
                        <div>
                            <img src="<?= $post_related['image_url'] ?>" class="card-img-top" alt="image_house">
                        </div>
                        <h5 class="card-title mt-2"><?= strlen($post_related['title']) > 80 ? substr_replace($post_related['title'], ' ...', 80) : $post_related['title'] ?></h5>
                        <p>
                            <i class="fa-solid fa-bed"></i> <?= $post_related['num_bedrooms'] . " ngủ" ?>
                            <i class="fa-solid fa-bath" style="margin-left: 10px;"></i> <?= $post_related['num_bathrooms'] . " tắm" ?>
                            <i class="fa-solid fa-chart-line" style="margin-left: 10px;"></i> <?= $post_related['area'] . " m<sup>2</sup>" ?>
                        </p>
                        <p class="card-description"><i class="fa-solid fa-location-dot"></i> <?= $post_related['ward_name'] . ", " . $post_related['district_name'] ?></p>
                        <a href="/Datn/views/detail-post.view.php?property_id=<?= $post_related['property_id'] ?>" class="btn btn-primary">Xem chi tiết</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <h4 class="mt-4">Tin đăng khác của <?= $post['name'] ?></h4>
        <div class="detail-post-related">
            <?php foreach ($posts_other as $post_other) : ?>
                <div class="detail-card card mx-3 mt-3" style="width: 21rem;">
                    <div class="card-body">
                        <div>
                            <img src="<?= $post_other['image_url'] ?>" class="card-img-top" alt="image_house">
                        </div>
                        <h5 class="card-title mt-2"><?= strlen($post_other['title']) > 80 ? substr_replace($post_other['title'], ' ...', 80) : $post_other['title'] ?></h5>
                        <p>
                            <i class="fa-solid fa-bed"></i> <?= $post_other['num_bedrooms'] . " ngủ" ?>
                            <i class="fa-solid fa-bath" style="margin-left: 10px;"></i> <?= $post_other['num_bathrooms'] . " tắm" ?>
                            <i class="fa-solid fa-chart-line" style="margin-left: 10px;"></i> <?= $post_other['area'] . " m<sup>2</sup>" ?>
                        </p>
                        <p class="card-description"><i class="fa-solid fa-location-dot"></i> <?= $post_other['ward_name'] . ", " . $post_other['district_name'] ?></p>
                        <a href="/Datn/views/detail-post.view.php?property_id=<?= $post_other['property_id'] ?>" class="btn btn-primary">Xem chi tiết</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<div class="detail-fixed">
    <div class="detail-left">
        <div class="detail-info-seller">
            <img src="<?= $post['avatar'] ?>" alt="avatar" style="border-radius: 50px; width: 80px; margin: 0 20px 10px 0; border: 2px solid black">
            <b><?= $post['name'] ?></b> <i class="fa-solid fa-briefcase"></i></br>
            Tham gia từ: <?= $formatted_create_at ?></br>
            Đánh giá: <b>5.0 - <?= $post_available['total'] ?> tin đăng - <?= $post_sold['total'] ?> tin đã bán </b></br>
            <button class="btn btn-primary mt-3" id="btn-contact" onclick="changeContact('<?= $post['contact_info'] ?>')">Liên hệ người bán</button>
        </div>
        <div class="detail-support">
            <ul>
                <li><a href="#"></a><i class="fa-solid fa-headset"></i> Cần hỗ trợ</a></li>
                <li><a href="#"><i class="fa-solid fa-triangle-exclamation"></i> Báo cáo bài viết</a></li>
            </ul>
        </div>
    </div>
</div>
<script>
    function changeContact(text) {
        document.getElementById('btn-contact').textContent = text; 
    }
</script>
<?php
require 'partials/footer.php';
