<?php
session_start();
require '../function.php';

$title = "Xem tất cả";
$banner = "Kết quả tìm kiếm";
$login = check_login($_SESSION['name']);
$search = $_POST['search'];

require 'partials/header.php';

require 'partials/navigation.php';

require 'partials/banner.php';

require '../controllers/search-post.controller.php';
?>
<div class="search">
    <form action="/Datn/views/search-post.view.php?page_number=1" method="post" class="d-flex my-3" role="search">
        <input class="form-control me-2" type="search" placeholder="Tìm kiếm theo tiêu đề" aria-label="Tìm kiếm" name="search" id="search" value="<?= $search ?>">
        <button class="btn btn-light" id="search-btn" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
        </div>
<?php if (!$posts): ?>
    <h3>Không có kết quả nào trùng khớp</h3>
<?php endif; 
foreach ($posts as $index => $post):
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
                    <div style="transform: translateY(-10%);">
                        <a href="/Datn/views/detail-post.view.php?property_id=<?= $post['property_id'] ?>" class="text-dark">
                            <h5><?= $post['title'] ?></h5>
                        </a>
                        <ul class="text-muted">
                            <li><i class="fa-solid fa-user-tie text-muted"></i> <?= $post['name'] ?></li>
                            <li><small><i class="far fa-clock me-1 text-muted"></i> <?= $date['day'] . '-' . $date['month'] . '-' . $date['year'] ?></small></li>
                            <li><i class="fa-solid fa-location-dot text-muted"></i> <?= 'P.' . $post['ward_name'] . ', Q.' . $post['district_name'] . ', Hà Nội' ?></li>
                        </ul>
                    </div>
                    <div class="mt-2 post-save">
                        <ul>
                            <li>
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
