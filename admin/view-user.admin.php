<?php
session_start();
require '../function.php';

$title = "Thông tin cá nhân";

require '../views/partials/header.php';

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
        </div>
        <div class="col-lg-8 col-xl-9 profile-main">
            <h1 class="mb-4">Thông tin cá nhân</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/Datn/admin/home.admin.php/users">Trang quản trị</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Thông tin cá nhân</li>
                </ol>
            </nav>
            <div class="row g-4">
                <div class="col-12">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fa-regular fa-address-card"></i> Thông tin liên hệ</h5>
                            <p><strong>Email:</strong> <?= $user['email'] ?></p>
                            <p><strong>Số điện thoại:</strong> <?= $user['phone'] ?></p>
                            <p><strong>Số căn cước công dân:</strong> <?= $user['citizen_id'] ?></p>
                            <p><strong>Địa chỉ:</strong> Hà Nội, Việt Nam</p>
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
        </div>
    </div>
</div>