<?php
$id = $_GET['id'];
require '../models/Database.php';
$db = new Database();
$property = $db->query("SELECT * FROM `properties` where property_id = :property_id", [
        'property_id' => $id
])->fetch(PDO::FETCH_ASSOC);
$post = $db->query("
        SELECT *, count(p.property_id) as total FROM `posts` p 
        INNER JOIN users u on u.user_id = p.user_id
        inner join properties pr on pr.property_id = p.property_id
        where p.property_id = :property_id", [
        'property_id' => $id
])->fetch(PDO::FETCH_ASSOC);

$slides = $db->query("
        SELECT * FROM `property_images` 
        where property_id = :property_id", [
        'property_id' => $id
])->fetchAll(PDO::FETCH_ASSOC);

$first_slide = $db->query("
        SELECT min(image_id) as min, count(*) as total FROM `property_images` 
        where property_id = :property_id", [
        'property_id' => $id
])->fetch(PDO::FETCH_ASSOC);

$location = $db->query("
        SELECT w.ward_name, d.district_name, d.district_id, p.property_id FROM `properties` p 
        INNER JOIN wards w on w.ward_id = p.ward_id
        INNER JOIN districts d on d.district_id = w.district_id
        where p.property_id = :property_id", [
        'property_id' => $id
])->fetch(PDO::FETCH_ASSOC);

$district_id = $location['district_id'];
$posts_related = $db->query("
        SELECT * FROM `posts` p
        inner join properties pr on pr.property_id = p.property_id
        inner join users u on u.user_id = p.user_id
        inner join wards w on w.ward_id = pr.ward_id
        inner join districts d on d.district_id = w.district_id 
        inner join property_images i on i.property_id = pr.property_id
        where d.district_id = :district_id
        and i.image_id = (
        SELECT MIN(image_id)
        FROM property_images
        WHERE property_id = pr.property_id)", [
        'district_id' => $district_id
])->fetchAll(PDO::FETCH_ASSOC);

$user_id = $post['user_id'];
$posts_other = $db->query("
SELECT *, (SELECT COUNT(*) FROM property_images WHERE property_id = pr.property_id) AS total_images
FROM `posts` p
INNER JOIN properties pr on pr.property_id = p.property_id
INNER JOIN users u on u.user_id = p.user_id
INNER JOIN wards w on w.ward_id = pr.ward_id
INNER JOIN districts d on d.district_id = w.district_id 
INNER JOIN property_images i on i.property_id = pr.property_id
WHERE u.user_id = :user_id
AND i.image_id = (
SELECT MIN(image_id)
FROM property_images
WHERE property_id = pr.property_id)", [
    'user_id' => $user_id
])->fetchAll(PDO::FETCH_ASSOC);

$created_at = $post['created_at'];
$formatted_create_at = date("d-m-Y", strtotime($created_at));
?>
<div class="position-relative">
        <div id="carouselAutoplaying" class="carousel slide container-detail" data-bs-ride="carousel" data-bs-interval="3000">
                <div class="carousel-inner">
                        <div class="carousel-indicators">
                                <?php for ($i = 0; $i < $first_slide['total']; $i++): ?>
                                        <button type="button" data-bs-target="#carouselAutoplaying" data-bs-slide-to="<?= $i ?>" <?= ($i == 0) ? 'aria-current="true" class="active"' : NULL ?> aria-label="Slide <?= $i ?>"></button>
                                <?php endfor ?>
                        </div>
                        <?php foreach ($slides as $slide): ?>
                                <div class="carousel-item <?= ($slide['image_id'] == $first_slide['min']) ? 'active' : '' ?>">
                                        <img src="<?= $slide['image_url'] ?>" class="d-block w-100" alt="Slide">
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
                        <h3><?= $property['title'] ?></h3>
                        <i class="fa-solid fa-location-dot"></i> <?= 'Phường ' . $location['ward_name'] . ', Quận ' . $location['district_name'] . ', TP.Hà Nội, Việt Nam' ?></br>
                        <div class="mt-3">
                                <h4>Mô tả dự án</h4>
                                <p><?= $property['description'] ?></p>
                                <p>Diện tích: <?= $property['area'] ?></p>
                                <p>Giá bán trên mét vuông: <?= $property['price_per_m2'] ?>tr/m2</p>
                                <p>Phòng ngủ: <?= $property['num_bedrooms'] ?></p>
                                <p>Phòng vệ sinh: <?= $property['num_bathrooms'] ?></p>
                                <p>Giá bán: <?= $property['price'] ?>VND (Có thương lượng)</p>
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
                                                <a href="/Datn/views/detail.property.view.php?id=<?= $post_related['property_id'] ?>" class="btn btn-primary">Xem chi tiết</a>
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
                                                <a href="/Datn/views/detail.property.view.php?id=<?= $post_other['property_id'] ?>" class="btn btn-primary">Xem chi tiết</a>
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
                        Đánh giá: <b>5.0 - <?= $post['total'] ?> tin đăng </b></br>
                        <button class="btn btn-primary mt-3">Liên hệ người bán</button>
                </div>
                <div class="detail-support">
                        <ul>
                                <li><a href="http://"></a:href><i class="fa-solid fa-headset"></i> Cần hỗ trợ</a></li>
                                <li><a href="http://"><i class="fa-solid fa-triangle-exclamation"></i> Báo cáo bài viết</a></li>
                        </ul>
                </div>
        </div>
</div>