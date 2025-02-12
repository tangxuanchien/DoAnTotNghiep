<?php
session_start();
require '../function.php';

$title = "Tất cả bài đăng";
$banner = "Tất cả bài đăng";
if (!isset($_SESSION['name'])) {
    $login = 'Đăng nhập';
} else $login = $_SESSION['name'];

require 'partials/header.php';

require 'partials/navigation.php';

require 'partials/banner.php';

require '../controllers/all-posts.controller.php';
?>
<!-- <div class="form-check form-switch">
    <form action="/Datn/views/all-posts.view.php?page_number=1/authentic" method="post">
        <input class="form-check-input" type="checkbox" role="switch">
        <label class="form-check-label" for="authentic-switch">Tin xác thực</label>
    </form>
</div> -->
<?php
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
                    <div>
                        <a href="/Datn/views/detail-post.view.php?post_id=<?= $post['post_id'] ?>" class="text-dark">
                            <h5>
                                <?php if ($post['authentic'] == 1): ?>
                                    <i class="fa-solid fa-circle-check text-success"></i>
                                <?php endif ?>
                                <?= $post['title'] ?>
                            </h5>
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
                                <ul>
                                    <li>
                                        <?php if ($post['status'] == 'available') {
                                            echo '<p class ="badge text-bg-primary text-wrap">Đang bán</p>';
                                        } elseif ($post['status'] == 'for_rent') {
                                            echo '<p class ="badge text-bg-warning text-wrap">Cho thuê</p>';
                                        } ?>
                                    </li>
                                    <li>
                                        <h5 class="text-danger">
                                            <?= strlen($post['price']) > 3 ? ($post['price'] / 1000) . ' tỷ' : $post['price'] . ' triệu' ?>
                                        </h5>
                                    </li>
                                </ul>
                            </li>
                            <li class="post-save">
                                <?php if (isset($_SESSION['user_id'])): ?>
                                    <?php if ($post['user_id'] != $_SESSION['user_id']): ?>
                                        <form action="/Datn/controllers/save-post.controller.php" method="get">
                                            <input type="hidden" name="post_id" value="<?= $post['post_id'] ?>">
                                            <?php if ($post['user_sid'] == $_SESSION['user_id'] and $post['post_sid'] == $post['post_id']): ?>
                                                <button class="btn btn-success">
                                                    <i class="fa-regular fa-bookmark text-light"></i> Bỏ lưu tin
                                                </button>
                                            <?php else: ?>
                                                <button class="btn btn-outline-success">
                                                    <i class="fa-solid fa-bookmark"></i> Lưu tin
                                                </button>
                                            <?php endif ?>
                                        <?php endif ?>
                                        </form>
                                    <?php endif ?>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
<?php endforeach; ?>
<div class="page-numbers">
    <ul>
        <li>
            <a href="<?= checkpagenumber($page_number, 1, '', '/Datn/views/all-posts.view.php' . $path_info . '?page_number=' . ($page_number - 1)) ?>" style="color: <?= ($page_number == 1) ? 'gray' : 'black' ?>">
                <i class="fa-solid fa-angles-left" style="color: <?= ($page_number == 1) ? 'gray' : 'black' ?>"></i> Trước
            </a>
        </li>
        <?php
        foreach ($total_pages as $number) : ?>
            <li>
                <form action="/Datn/views/all-posts.view.php<?= $path_info ?>?page_number=<?= $number ?>" method="post">
                    <button type="submit" style="background-color: <?= ($number == $page_number) ? '#6e9eeb' : 'white' ?>"><?= $number ?></button>
                </form>
            </li>
        <?php endforeach ?>
        <li>
            <a href="<?= checkpagenumber($page_number, $last_page_numbers, '', '/Datn/views/all-posts.view.php' . $path_info . '?page_number=' . ($page_number + 1)) ?>" style="color: <?= ($page_number == $last_page_numbers) ? 'gray' : 'black' ?>">
                Sau <i class="fa-solid fa-angles-right" style="color: <?= ($page_number == $last_page_numbers) ? 'gray' : 'black' ?>"></i>
            </a>
        </li>
    </ul>
</div>
<?php
require 'partials/footer.php';
