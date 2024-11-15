<?php
require 'models/Database.php';
require 'function.php';
if (!isset($_SESSION['method'])) {
    $method = '';
} else {
    $method = $_SESSION['method'];
}
$db = new Database();
$posts = $db->query("
SELECT * FROM `posts` p
inner join properties pr on pr.property_id = p.property_id
inner join users u on u.user_id = p.user_id
inner join wards w on w.ward_id = pr.ward_id
inner join districts d on d.district_id = w.district_id 
inner join property_images i on i.property_id = pr.property_id 
LIMIT 6")->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="div-lists" id="div-lists">
    <ul>
        <?php foreach ($posts as $index => $post) : ?>
            <li>
                <div class="card mx-3 mt-3 index-card">
                    <div>
                        <a href="<?= $post['image_url'] ?>" data-lightbox="image_property_<?= $index ?>" data-title="Ảnh mô tả">
                            <img src="<?= $post['image_url'] ?>" alt="Thumbnail" class="card-img-top">
                        </a>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?= strlen($post['title']) > 80 ? substr_replace($post['title'], ' ...', 80) : $post['title'] ?></h5>
                        <p>
                            <i class="fa-solid fa-bed"></i> <?= $post['num_bedrooms'] . " ngủ" ?>
                            <i class="fa-solid fa-bath" style="margin-left: 10px;"></i> <?= $post['num_bathrooms'] . " tắm" ?>
                            <i class="fa-solid fa-chart-line" style="margin-left: 10px;"></i> <?= $post['area'] . " m<sup>2</sup>" ?>
                        </p>
                        <p class="card-description"><i class="fa-solid fa-location-dot"></i> <?= 'P. ' . $post['ward_name'] . ", Q. " . $post['district_name'] ?></p>
                        <p><i class="fa-solid fa-user-tie"></i> <?= $post['name'] ?></p>
                        <a href="/Datn/views/detail-post.view.php?property_id=<?= $post['property_id'] ?>" class="btn btn-primary">Xem chi tiết</a>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</div>