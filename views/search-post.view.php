<?php
session_start();
require '../function.php';

$title = "Xem tất cả";
$banner = "Kết quả tìm kiếm";
$login = check_login($_SESSION['name']);
if (!isset($_POST['search'])) {
    $_POST['search'] = '';
}
$search = $_POST['search'];
if (!isset($_POST['sort_by_price'])) {
    $_POST['sort_by_price'] = ' ';
}
if (!isset($_POST['sort_by_created_at'])) {
    $_POST['sort_by_created_at'] = ' ';
}

require 'partials/header.php';

require 'partials/navigation.php';

require 'partials/banner.php';

require '../controllers/search-post.controller.php';
?>
<div class="container-post search" style="width: 80%;">
    <form action="/Datn/views/search-post.view.php?page_number=1" method="post" class="d-flex my-3" role="search">
        <input class="form-control me-2" type="search" placeholder="Tìm kiếm theo tiêu đề" aria-label="Tìm kiếm" name="search" id="search" value="<?= $search ?>">
        <button class="btn btn-outline-dark" id="search-btn" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
    </form>
    <?php if (!$posts): ?>
        <h5>Không có kết quả nào trùng khớp</h5>
    <?php else: ?>
        <h5 class="text-danger"><?= count($posts) ?> kết quả tìm kiếm</h5>
    <?php endif; ?>
    <ul>
        <form action="/Datn/views/search-post.view.php?page_number=1" method="post">
            <li>
                <p>Sắp xếp theo:</p>
            </li>
            <li style=" margin-left: 20px;">
                <select class="form-select w-auto" name="sort_by_price">
                    <option value="">-Giá bán-</option>
                    <option value="price_ASC" <?= ($_POST['sort_by_price'] == 'price_ASC') ? 'selected' : ''?>>Giá từ thấp nhất</option>
                    <option value="price_DESC" <?= ($_POST['sort_by_price'] == 'price_DESC') ? 'selected' : ''?>>Giá từ cao nhất</option>
                </select>
            </li>
            <li style=" margin-left: 20px;">
                <select class="form-select w-auto" name="sort_by_created_at">
                    <option value="">-Thời gian-</option>
                    <option value="created_at_DESC" <?= ($_POST['sort_by_created_at'] == 'created_at_DESC') ? 'selected' : ''?>>Thời gian mới nhất</option>
                    <option value="created_at_ASC" <?= ($_POST['sort_by_created_at'] == 'created_at_ASC') ? 'selected' : ''?>>Thời gian cũ nhất</option>
                </select>
            </li>
            <li style="margin-left: 20px;">
                <button class="btn btn-success" type="submit">Áp dụng</button>
            </li>
        </form>
    </ul>
</div>
<?php foreach ($posts as $index => $post):
    $date = date_parse($post['created_at']);
?>
    <div class="container-post mt-3" style="width: 80%;">
        <div class="post-lists">
            <ul>
                <li>
                    <div class="image-container">
                        <a href="<?= $post['image_url'] ?>" data-lightbox="image_property_<?= $index ?>" data-title="Ảnh mô tả">
                            <img src="<?= $post['image_url'] ?>" alt="Thumbnail" style="width: 200px;">
                        </a>
                        <div class="image-overlay">
                            <i class="fa-regular fa-images"></i> <?= $post['total_images'] ?>
                        </div>
                    </div>
                </li>
                <li>
                    <div>
                        <a href="/Datn/views/detail-post.view.php?property_id=<?= $post['property_id'] ?>" class="text-dark">
                            <h5><?= $post['title'] ?></h5>
                        </a>
                        <ul class="text-muted">
                            <li><i class="fa-solid fa-user-tie text-muted"></i> <?= $post['name'] ?></li>
                            <li class="post-time"><i class="far fa-clock me-1 text-muted"></i> <?= $date['day'] . '-' . $date['month'] . '-' . $date['year'] ?></li>
                            <li class="post-location"><i class="fa-solid fa-location-dot text-muted"></i> <?= 'P.' . $post['ward_name'] . ', Q.' . $post['district_name'] . ', Hà Nội' ?></li>
                        </ul>
                    </div>
                    <div class="mt-2">
                        <ul>
                            <li class="post-price">
                                <h5 class="text-danger">
                                    <?= strlen($post['price']) > 3 ? ($post['price'] / 1000) . ' tỷ' : $post['price'] . ' triệu' ?>
                                </h5>
                            </li>
                            <li class="post-save">
                                <form action="/Datn/controllers/save-post.controller.php?post_id=<?= $post['post_id'] ?>" method="post">
                                    <?php if ($post['user_sid'] == $_SESSION['user_id'] and $post['post_sid'] == $post['post_id']): ?>
                                        <button class="btn btn-success">
                                            <i class="fa-regular fa-bookmark text-light"></i> Bỏ lưu tin
                                        </button>
                                    <?php else: ?>
                                        <button class="btn btn-outline-success">
                                            <i class="fa-solid fa-bookmark"></i> Lưu tin
                                        </button>
                                    <?php endif ?>
                                </form>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
<?php endforeach;
require 'partials/footer.php';
