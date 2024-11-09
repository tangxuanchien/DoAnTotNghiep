<?php
session_start();
require '../function.php';

$title = "Quản lí bài đăng";
$banner = "";
$login = check_login($_SESSION['name']);

require 'partials/header.php';

require 'partials/navigation.php';

require 'partials/banner.php';

if (!empty($_SESSION['user_id'])) :
    require '../controllers/manage-posts.controller.php';
?>
    <div class="container-post" style="width: 80%;">
        <div class="navigation-post">
            <ul>
                <li <?=($_SERVER['PATH_INFO'] == '/available') ? 'class="active-manage"' : ''?>><a href="/Datn/views/manage-posts.view.php/available">
                        Tin đang bán
                    </a>
                </li>
                <li <?=($_SERVER['PATH_INFO'] == '/sold') ? 'class="active-manage"' : ''?>><a href="/Datn/views/manage-posts.view.php/sold">
                        Tin đã bán
                    </a>
                </li>
                <li <?=($_SERVER['PATH_INFO'] == '/for-rent') ? 'class="active-manage"' : ''?>><a href="/Datn/views/manage-posts.view.php/for-rent">
                        Tin cho thuê
                    </a>
                </li>
                <li <?=($_SERVER['PATH_INFO'] == '/hide') ? 'class="active-manage"' : ''?>><a href="/Datn/views/manage-posts.view.php/hide">
                        Tin bị ẩn
                    </a>
                </li>
            </ul>
        </div>
        <?php
        foreach ($my_posts as $my_post):
            $date = date_parse($my_post['created_at']);
        ?>
            <div class="post-lists">
                <ul>
                    <li>
                        <div class="image-container" style="transform: translateY(-5%);">
                            <img src="<?= $my_post['image_url'] ?>" alt="image_property" width="200px">
                            <div class="image-overlay">
                                <i class="fa-regular fa-images"></i> <?= $my_post['total_images'] ?>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div style="transform: translateY(15%);">
                            <a href="/Datn/views/detail.property.view.php?property_id=<?= $my_post['property_id'] ?>" class="text-dark">
                                <h5><?= $my_post['title'] ?></h5>
                            </a>
                            <small class="text-muted"><i class="far fa-clock me-1"></i> <?= $date['day'] . '-' . $date['month'] . '-' . $date['year'] ?></small>
                            <div class="mt-2 post-edit">
                                <ul>
                                    <li>
                                        <form action="/Datn/views/edit-post.view.php?property_id=<?= $my_post['property_id'] ?>" method="post">
                                            <button class="btn btn-outline-secondary"><i class="fa-solid fa-pen"></i> Sửa tin</button>
                                        </form>
                                    </li>
                                    <li>
                                        <form action="/Datn/controllers/hide-post.php?property_id=<?= $my_post['property_id'] ?>" method="post">
                                            <button class="btn btn-outline-secondary" onclick="return confirm('Bạn chắc chắn muốn ẩn tin này ?')"><i class="fa-regular fa-eye-slash"></i> Ẩn tin</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        <?php endforeach ?>
    </div>

<?php endif;

require 'partials/footer.php';
