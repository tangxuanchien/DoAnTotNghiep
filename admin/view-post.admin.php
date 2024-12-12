<?php
session_start();
require '../function.php';

$title = 'Xem chi tiết';
$banner = "";
if (!isset($_GET['source'])) {
    $_GET['source'] = '';
}

require '../views/partials/header.php';

require '../controllers/detail-post.controller.php'; ?>
<div class="ms-5 mt-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/Datn/admin/home.admin.php/posts">Trang quản trị</a></li>
            <li class="breadcrumb-item active" aria-current="page">Chi tiết bài đăng</li>
        </ol>
    </nav>
    <h1>Chi tiết bài đăng</h1>
    <?php if ($post['authentic'] == 1): ?>
        <button class="btn btn-success" type="button"><i class="fa-solid fa-circle-check text-light"></i> BÀI ĐĂNG ĐÃ XÁC THỰC</button>
    <?php endif ?>
    <div class="position-relative ms-5">
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
                            <?= $comment['content'] ?>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="detail-fixed ms-5">
    <div class="detail-left">
        <div class="detail-info-seller">
            <img src="<?= $post['avatar'] ?>" alt="avatar">
            <b><?= $post['name'] ?></b> <i class="fa-solid fa-briefcase"></i></br>
            Tham gia từ: <?= $formatted_create_at ?></br>
            Đánh giá: <b>5.0 - <?= $post_available['total'] ?> tin đăng - <?= $post_sold['total'] ?> tin đã bán </b></br>
            <button class="btn btn-primary mt-3 mb-3" id="btn-contact" onclick="changeContact('<?= $post['contact_info'] ?>')">
                <i class="fa-solid fa-phone text-light"></i> Liên hệ người bán
            </button>
            <div>
                <a href="https://zalo.me/<?= $post['contact_info'] ?>" class="btn btn-outline-primary">
                    <img src="../images/icon_zalo.svg" alt="zalo" width="22.3px"> Liên hệ qua Zalo
                </a>
            </div>
            <p class="mt-4">Giới thiệu: <?= (empty($post['introduce'])) ? 'Người này chưa có giới thiệu' : $post['introduce'] ?></p>
        </div>
        <div class="detail-support">
            <ul>
                <li><a href="#"><i class="fa-solid fa-headset"></i> 1900 2121</a></li>
                <!-- <li><a href="/Datn/views/report.view.php?post_id=<?= $post_id ?>&source=detail"><i class="fa-solid fa-triangle-exclamation"></i> Báo cáo bài viết</a></li> -->
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