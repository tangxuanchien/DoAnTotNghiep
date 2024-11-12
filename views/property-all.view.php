<?php
session_start();
require '../function.php';

$title = "Xem tất cả";
$banner = "Xem tất cả";
$login = check_login($_SESSION['name']);

require 'partials/header.php';

require 'partials/navigation.php';

require 'partials/banner.php';

require '../controllers/property-all.controller.php';

foreach ($posts as $post):
    $date = date_parse($post['created_at']);
?>
        <div class="post-lists">
            <ul>
                <li>
                    <div class="image-container" style="transform: translateY(-5%);">
                        <img src="<?= $post['image_url'] ?>" alt="image_property" width="200px">
                        <div class="image-overlay">
                            <i class="fa-regular fa-images"></i> <?= $post['total_images'] ?>
                        </div>
                    </div>
                </li>
                <li>
                    <div style="transform: translateY(15%);">
                        <a href="/Datn/views/detail.property.view.php?property_id=<?= $post['property_id'] ?>" class="text-dark">
                            <h5><?= $post['title'] ?></h5>
                        </a>
                        <ul class="text-muted">
                            <li><small><i class="far fa-clock me-1 text-muted"></i> <?= $date['day'] . '-' . $date['month'] . '-' . $date['year'] ?></small></li>
                            <li><i class="fa-solid fa-user-tie text-muted"></i> <?= $post['name'] ?></li>
                        </ul>
                    </div>
                    <div class="mt-2 post-edit">
                        <ul>
                            <li>
                                <form action="/Datn/views/edit-post.view.php?property_id=<?= $post['property_id'] ?>" method="post">
                                    <button class="btn btn-outline-secondary"><i class="fa-solid fa-pen"></i> Sửa tin</button>
                                </form>
                            </li>
                            <li>
                                <form action="/Datn/controllers/status-post.controller.php?property_id=<?= $post['property_id'] ?>&status=hide" method="post">
                                    <button class="btn btn-outline-secondary" onclick="return confirm('Bạn chắc chắn muốn ẩn tin này ?')"><i class="fa-regular fa-eye-slash"></i> Ẩn tin</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
<?php endforeach ?>
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