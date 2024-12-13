<?php
session_start();
require '../function.php';

$title = "Thông tin cá nhân";
$login = check_login($_SESSION['name']);

if (isset($_SESSION['user_id'])) {
    $banner = "";
} else $banner = "Vui lòng đăng nhập để xem việc làm";

require 'partials/header.php';

require 'partials/navigation.php';

require 'partials/banner.php';

require '../controllers/information.controller.php';
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-4 col-xl-3 profile-sidebar">
            <div class="text-center mb-4">
                <div class="profile-avatar mx-auto">
                    <a href="<?= $user['avatar'] ?>" data-lightbox="avatar" data-title="Ảnh đại diện">
                        <img src="<?= $user['avatar'] ?>" alt="avatar" class="avatar">
                    </a>
                </div>
                <h2 class="mb-0"><?= $user['name'] ?></h2>
                <p class="text-light mb-3">Tham gia ngày <?= $date['day'] . '-' . $date['month'] . '-' . $date['year'] ?></p>
                <div class="d-flex justify-content-center mb-3">
                    <a href="#" class="social-icon"><i class="fa-brands fa-facebook" style="color: white"></i></a>
                    <a href="#" class="social-icon"><i class="fa-brands fa-tiktok" style="color: white"></i></a>
                    <a href="#" class="social-icon"><i class="fa-brands fa-telegram" style="color: white"></i></a>
                </div>
            </div>
            <!-- <div class="mb-4">
                <h5>Tiến độ hoàn thành hồ sơ</h5>
                <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 85%;" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">85%</div>
                </div>
            </div> -->
            <form action="/Datn/views/edit-information.view.php" method="post">
                <input type="hidden" value="<?= $user['user_id'] ?>" name="user_id">
                <button class="btn btn-light w-100 mb-3">
                    <i class="fa-solid fa-pen-to-square" style="color: var(--primary-color)"></i> Chỉnh sửa hồ sơ
                </button>
            </form>
            <form action="/Datn/controllers/logout.controller.php" method="post">
                <button class="btn btn-outline-light w-100" type="submit">
                    <i class="fa-solid fa-arrow-right-from-bracket" style="color: white"></i> Đăng xuất
                </button>
            </form>
        </div>
        <div class="col-lg-8 col-xl-9 profile-main">
            <h1 class="mb-4">Thông tin cá nhân</h1>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fa-regular fa-address-card"></i> Thông tin liên hệ</h5>
                            <p><b>Email:</b> <?= $user['email'] ?></p>
                            <p><b>Số điện thoại:</b> <?= $user['phone'] ?></p>
                            <p><b>Địa chỉ:</b> Hà Nội, Việt Nam</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fa-regular fa-building"></i> Thông tin giao dịch</h5>
                            <p>
                                <b>Số bài đăng:</b> <?= $total_post['total_post'] ?> -
                                <b>Đã bán:</b> <?= (!$post_sold) ? '0' : $post_sold['total_post'] ?>
                            </p>
                            <p>
                                <b>Khu vực chủ yếu:</b>
                                <?= ($favourite_district) ? $favourite_district[0]['district_name'] . ', ' . $favourite_district[1]['district_name'] : 'Không có'?>
                            </p>
                            <p>
                                <b>Loại hình ưa thích:</b>
                                <?php if ($favourite_type[0]['type'] == 'home') {
                                    echo 'Nhà ở';
                                } elseif ($favourite_type[0]['type'] == 'apartment') {
                                    echo 'Chung cư';
                                } elseif ($favourite_type[0]['type'] == 'land') {
                                    echo 'Đất đai';
                                } else {
                                    echo 'Không có';
                                } ?>
                                - <?= $favourite_type[0]['total'] ?> bài đăng
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fa-regular fa-file-lines"></i> Giới thiệu</h5>
                            <p><?= $user['introduce'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <h5>Dự án gần đây</h5>
                <div class="list-group">
                    <?php foreach ($posts as $post): ?>
                        <a href="/Datn/views/detail-post.view.php?post_id=<?= $post['post_id'] ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1"><?= $post['title'] ?></h6>
                                <p class="mb-1 text-muted"><?= 'Phường ' . $post['ward_name'] . ', Quận ' . $post['district_name'] ?>, Hà Nội</p>
                            </div>
                            <span class="badge bg-primary rounded-pill">Đang bán</span>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require 'partials/footer.php';
