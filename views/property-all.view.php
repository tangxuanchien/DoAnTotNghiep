<?php
session_start();
require '../function.php';

$title = "Xem tất cả";
$banner = "Xem tất cả bài đăng";
$login = check_login($_SESSION['name']);

require 'partials/header.php';

require 'partials/navigation.php';

require 'partials/banner.php';

require '../controllers/property-all.controller.php';

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
                        <a href="/Datn/views/detail.property.view.php?property_id=<?= $post['property_id'] ?>" class="text-dark">
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
<?php endforeach; ?>

<div class="page-numbers">
    <ul>
        <li>
            <a href="<?= checkpagenumber($page_number, 1, '', '/Datn/views/property-all.view.php?page_number=' . ($page_number - 1)) ?>" style="color: <?= ($page_number == 1) ? 'gray' : 'black' ?>">
                <i class="fa-solid fa-angles-left" style="color: <?= ($page_number == 1) ? 'gray' : 'black' ?>"></i> Trước
            </a>
        </li>
        <?php
        foreach ($total_pages as $number) : ?>
            <li>
                <form action="/Datn/views/property-all.view.php?page_number=<?= $number ?>" method="post">
                    <button type="submit" style="background-color: <?= ($number == $page_number) ? '#6e9eeb' : 'white' ?>"><?= $number ?></button>
                </form>
            </li>
        <?php endforeach ?>
        <li>
            <a href="<?= checkpagenumber($page_number, $last_page_numbers, '', '/Datn/views/property-all.view.php?page_number=' . ($page_number + 1)) ?>" style="color: <?= ($page_number == $last_page_numbers) ? 'gray' : 'black' ?>">
                Sau <i class="fa-solid fa-angles-right" style="color: <?= ($page_number == $last_page_numbers) ? 'gray' : 'black' ?>"></i>
            </a>
        </li>
    </ul>
</div>

<?php
require 'partials/footer.php';
