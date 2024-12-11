<?php
session_start();
require '../function.php';

$title = 'Xem chi tiết';
$login = 'Đăng nhập';
if (!isset($_SESSION['name'])) {
    $login = 'Đăng nhập';
} else $login = $_SESSION['name'];
$banner = "";
if (!isset($_GET['source'])) {
    $_GET['source'] = '';
}


require 'partials/header.php';

require 'partials/navigation.php';

require 'partials/banner.php';

require '../controllers/detail-post.controller.php'; ?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/Datn">Trang chủ</a></li>
        <li class="breadcrumb-item">
            <?php if ($_GET['source'] == 'search'): ?>
                <a href="/Datn/views/search-post.view.php?page_number=1">Tìm kiếm bài đăng</a>
            <?php elseif ($_GET['source'] == 'save'): ?>
                <a href="/Datn/views/save-post.view.php">Lưu bài đăng</a>
            <?php elseif ($_GET['source'] == 'manage'): ?>
                <a href="/Datn/views/manage-posts.view.php/available">Quản lí bài đăng</a>
            <?php else: ?>
                <a href="/Datn/views/all-posts.view.php?page_number=1">Tất cả bài đăng</a>
            <?php endif ?>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Chi tiết bài đăng</li>
    </ol>
</nav>
<h1>Chi tiết bài đăng</h1>
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
            <p class="mb-3">Mô tả: <?= $post['description'] ?></p>
            <div class="mt-3">
                <h4>Đặc điểm dự án</h4>
                <i class="fa-solid fa-location-dot mb-3"></i> <?= 'Phường ' . $location['ward_name'] . ', Quận ' . $location['district_name'] . ', TP.Hà Nội, Việt Nam' ?></br>
                <table class="table">
                    <tbody>
                        <tr>
                            <th scope="row"><i class="fa-solid fa-building"></i> Loại hình</th>
                            <td>
                                <?php if ($post['type'] == 'home') {
                                    echo 'Nhà ở';
                                } elseif ($post['type'] == 'apartment') {
                                    echo 'Chung cư';
                                } else {
                                    echo 'Đất';
                                }
                                ?>
                            </td>
                            <th scope="row"><i class="fa-solid fa-layer-group"></i> Diện tích</th>
                            <td><?= $post['area'] ?> m<sup>2</sup></td>

                        </tr>
                        <tr>
                            <th scope="row"><i class="fa-solid fa-bed"></i> Phòng ngủ</th>
                            <td><?= $post['num_bedrooms'] ?></td>

                            <th scope="row"><i class="fa-solid fa-sack-dollar"></i> Giá bán</th>
                            <td><?= strlen($post['price']) > 3 ? ($post['price'] / 1000) . ' tỷ' : $post['price'] . ' triệu' ?> (Có thương lượng)</td>
                        </tr>
                        <tr>
                            <th scope="row"><i class="fa-solid fa-bath"></i> Phòng vệ sinh</th>
                            <td><?= $post['num_bathrooms'] ?></td>
                            <th scope="row"><i class="fa-solid fa-money-bill"></i> Giá bán trên mét vuông</th>
                            <td><?= $post['price_per_m2'] ?> triệu/m<sup>2</sup></td>
                        </tr>
                    </tbody>
                </table>
                <h3>Xem trên bản đồ</h3>
                <iframe
                    width="800"
                    height="400"
                    style="border: 1px solid grey; border-radius: 20px"
                    loading="lazy"
                    allowfullscreen
                    src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDJKLBheMXFGqapDSNbgnWGDvCzIrk_Jj8&q=<?= 'Phường ' . $location['ward_name'] . ', Quận ' . $location['district_name'] . ', TP.Hà Nội, Việt Nam' ?>">
                </iframe>
            </div>
        </div>
        <div class="container-comment">
            <div class="create-comment">
                <form action="/Datn/controllers/create-comment.controller.php" method="post">
                    <label class="form-label">
                        <h4>Bình luận</h4>
                    </label>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <ul>
                            <li>
                                <input type="text" name="content" class="form-control" placeholder="Thêm bình luận ..." required></input>
                                <input type="hidden" name="post_id" value="<?= $post['post_id'] ?>">
                                <input type="hidden" name="property_id" value="<?= $post['property_id'] ?>">
                            </li>
                            <li>
                                <button type="submit" class="btn btn-primary">Bình luận</button>
                            </li>
                        </ul>
                    <?php endif ?>
                </form>
            </div>
            <div class="view-comment" id="view-comment">
                Xem bình luận bài viết
            </div>
            <div class="comment" id="comment">
                <?php if (!$comments): ?>
                    <p>Chưa có bình luận</p>
                <?php endif ?>
                <?php foreach ($comments as $comment) :
                    $created_comment_at = date("d/m/Y H:i", strtotime($comment['created_comment_at'])); ?>
                    <div class="comment-info">
                        <img src="<?= $comment['avatar'] ?>" alt="avatar-comment" width="40px">
                        <?= $comment['name'] ?> - <?= $created_comment_at ?>
                    </div>
                    <div class="comment-content">
                        <?php if (isset($_SERVER['PATH_INFO']) and $comment['user_id'] == $_SESSION['user_id']): ?>
                            <div class="edit-comment">
                                <form action="/Datn/controllers/edit-comment.controller.php?comment_id=<?= $comment['comment_id'] ?>" method="post">
                                    <ul>
                                        <li><input type="text" name="content" class="form-control" value="<?= $comment['content'] ?>" required></li>
                                        <li><button class="btn btn-primary">Xác nhận</button></li>
                                    </ul>
                                </form>
                            </div>
                        <?php else: ?>
                            <?= $comment['content'] ?>
                        <?php endif ?>
                        <?php if ($comment['user_id'] == $_SESSION['user_id']) : ?>
                            <div>
                                <a href="/Datn/views/detail-post.view.php/edit?post_id=<?= $post['post_id'] ?>"><i class="fa-solid fa-pencil"></i></a>
                                <a href="/Datn/controllers/delete-comment.controller.php?comment_id=<?= $comment['comment_id'] ?>"><i class="fa-solid fa-trash"></i></a>
                            </div>
                        <?php else: ?>
                            <a href="/Datn/views/report.view.php?post_id=<?= $post_id ?>&source=detail" onclick="return confirm('Bạn chắc chắn muốn báo cáo bình luận này')"><i class="fa-solid fa-triangle-exclamation"></i></a>
                        <?php endif ?>
                    </div>
                <?php endforeach ?>
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
                        <h5 class="card-title mt-2"><?= strlen($post_related['title']) > 70 ? substr_replace($post_related['title'], ' ...', 70) : $post_related['title'] ?></h5>
                        <p>
                            <i class="fa-solid fa-bed"></i> <?= $post_related['num_bedrooms'] . " ngủ" ?>
                            <i class="fa-solid fa-bath" style="margin-left: 10px;"></i> <?= $post_related['num_bathrooms'] . " tắm" ?>
                            <i class="fa-solid fa-chart-line" style="margin-left: 10px;"></i> <?= $post_related['area'] . " m<sup>2</sup>" ?>
                        </p>
                        <p class="card-description"><i class="fa-solid fa-location-dot"></i> <?= $post_related['ward_name'] . ", " . $post_related['district_name'] ?></p>
                        <a href="/Datn/views/detail-post.view.php?post_id=<?= $post_related['post_id'] ?>" class="btn btn-primary">Xem chi tiết</a>
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
                        <h5 class="card-title mt-2"><?= strlen($post_other['title']) > 70 ? substr_replace($post_other['title'], ' ...', 70) : $post_other['title'] ?></h5>
                        <p>
                            <i class="fa-solid fa-bed"></i> <?= $post_other['num_bedrooms'] . " ngủ" ?>
                            <i class="fa-solid fa-bath" style="margin-left: 10px;"></i> <?= $post_other['num_bathrooms'] . " tắm" ?>
                            <i class="fa-solid fa-chart-line" style="margin-left: 10px;"></i> <?= $post_other['area'] . " m<sup>2</sup>" ?>
                        </p>
                        <p class="card-description"><i class="fa-solid fa-location-dot"></i> <?= $post_other['ward_name'] . ", " . $post_other['district_name'] ?></p>
                        <a href="/Datn/views/detail-post.view.php?post_id=<?= $post_other['post_id'] ?>" class="btn btn-primary">Xem chi tiết</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<div class="detail-fixed">
    <div class="detail-left">
        <div class="detail-info-seller">
            <img src="<?= $post['avatar'] ?>" alt="avatar">
            <b><?= $post['name'] ?></b> <i class="fa-solid fa-briefcase"></i></br>
            Tham gia từ: <?= $formatted_create_at ?></br>
            Đánh giá: <b>5.0 - <?= $post_available['total'] ?> tin đăng - <?= $post_sold['total'] ?> tin đã bán </b></br>
            <button class="btn btn-primary mt-3 mb-3" id="btn-contact" onclick="changeContact('<?= $post['contact_info'] ?>')">Liên hệ người bán</button>
            <?php if (isset($_SESSION['user_id'])):
                if ($post['user_id'] != $_SESSION['user_id']): ?>
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
                    <?php endif;
                    endif ?>
                    </form>
                <?php endif ?>
                <p class="mt-4">Giới thiệu: <?= (empty($post['introduce'])) ? 'Người này chưa có giới thiệu' : $post['introduce'] ?></p>
        </div>
        <div class="detail-support">
            <ul>
                <!-- <li><a href="#"><i class="fa-solid fa-headset"></i> Cần hỗ trợ</a></li> -->
                <li><a href="/Datn/views/report.view.php?post_id=<?= $post_id ?>&source=detail"><i class="fa-solid fa-triangle-exclamation"></i> Báo cáo bài viết</a></li>
            </ul>
        </div>
    </div>
</div>
<script>
    function changeContact(text) {
        document.getElementById('btn-contact').textContent = text;
    }

    $(document).ready(function() {
        $("#view-comment").click(function(text) {
            $("#comment").slideToggle();
        })
    })
</script>
<?php
require 'partials/footer.php';
