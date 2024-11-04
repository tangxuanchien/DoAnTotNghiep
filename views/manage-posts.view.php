<?php
session_start();
require '../function.php';

$title = "Quản lí bài đăng";
$banner = "";
$login = check_login($_SESSION['name']);

require 'partials/header.php';

require 'partials/navigation.php';

require 'partials/banner.php';

if (!empty($_SESSION['id'])) :
    require '../controllers/manage-posts.controller.php';
    $my_posts = $_SESSION['my_posts'];
?>
    <div class="container-post" style="width: 80%;">
        <div class="navigation-post">
            <ul>
                <li>Tin đang bán</li>
                <li>Tin cho thuê</li>
                <li>Tin đã bán (đã ẩn)</li>
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
                            <h5><?= $my_post['title'] ?></h5>
                            <small class="text-muted"><i class="far fa-clock me-1"></i> <?= $date['day'] . '-' . $date['month'] . '-' . $date['year'] ?></small>
                            <div class="mt-2 post-edit">
                                <ul>
                                    <li>
                                        <button class="btn btn-outline-secondary"><i class="fa-solid fa-pen"></i> Sửa tin</button>
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
