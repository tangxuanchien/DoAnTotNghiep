<?php
$id = $_SESSION['id'];
require '../models/Database.php';
$db = new Database();
$user = $db->query("SELECT * FROM `users` where user_id = $id")->fetch(PDO::FETCH_ASSOC);
$date = date_parse($user['created_at']);
?>
<style>
    :root {
        --primary-color: #2c3e50;
        --secondary-color: #34495e;
        --accent-color: #e74c3c;
    }

    body {
        background-color: #ecf0f1;
        min-height: 100vh;
    }

    .avatar {
        border-radius: 80px;
        height: 130px;
        width: 130px;
    }

    .profile-sidebar {
        background-color: var(--primary-color);
        color: white;
        padding: 2rem;
        height: 100%;
        min-height: 100vh;
    }

    .profile-main {
        padding: 2rem;
    }

    .profile-avatar {
        width: 150px;
        height: 150px;
        background-color: var(--secondary-color);
        color: white;
        font-size: 4rem;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        margin-bottom: 1rem;
        border: 4px solid #fff;
    }

    .progress {
        height: 10px;
    }

    .badge-real-estate {
        background-color: var(--accent-color);
        color: white;
        font-size: 0.8rem;
        padding: 0.3rem 0.6rem;
        border-radius: 1rem;
        margin-right: 0.5rem;
        margin-bottom: 0.5rem;
    }

    .social-icon {
        font-size: 1.5rem;
        color: white;
        margin-right: 1rem;
    }

    .card {
        border: none;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .card-title {
        color: var(--primary-color);
        border-bottom: 2px solid var(--accent-color);
        padding-bottom: 0.5rem;
    }
</style>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-xl-3 profile-sidebar">
                <div class="text-center mb-4">
                    <div class="profile-avatar mx-auto">
                        <img src="<?= $user['picture'] ?>" alt="avatar" class="avatar">
                    </div>
                    <h2 class="mb-0"><?= $user['name'] ?></h2>
                    <p class="text-light mb-3">Tham gia ngày <?= $date['day'] . '-' . $date['month'] . '-' . $date['year'] ?></p>
                    <div class="d-flex justify-content-center mb-3">
                        <a href="#" class="social-icon" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="social-icon" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
                        <a href="#" class="social-icon" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>
                <div class="mb-4">
                    <h5>Tiến độ hoàn thành hồ sơ</h5>
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 85%;" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">85%</div>
                    </div>
                </div>
                <div class="mb-4">
                    <h5>Lĩnh vực quan tâm</h5>
                    <div>
                        <span class="badge-real-estate">Chung cư</span>
                        <span class="badge-real-estate">Biệt thự</span>
                        <span class="badge-real-estate">Đất nền</span>
                        <span class="badge-real-estate">Nhà phố</span>
                    </div>
                </div>
                <button class="btn btn-light w-100 mb-3">
                    <i class="bi bi-pencil-square me-2"></i>Chỉnh sửa hồ sơ
                </button>
                <button class="btn btn-outline-light w-100">
                    <i class="bi bi-box-arrow-right me-2"></i>Đăng xuất
                </button>
            </div>
            <div class="col-lg-8 col-xl-9 profile-main">
                <h1 class="mb-4">Thông tin cá nhân</h1>
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title"><i class="bi bi-person-vcard me-2"></i>Thông tin liên hệ</h5>
                                <p><strong>Email:</strong> chien0181966@huce.edu.vn</p>
                                <p><strong>Số điện thoại:</strong> 1</p>
                                <p><strong>Địa chỉ:</strong> Hà Nội, Việt Nam</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title"><i class="bi bi-building me-2"></i>Thông tin đầu tư</h5>
                                <p><strong>Số dự án đã tham gia:</strong> 7</p>
                                <p><strong>Tổng giá trị đầu tư:</strong> 15 tỷ VNĐ</p>
                                <p><strong>Loại hình ưa thích:</strong> Chung cư cao cấp</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><i class="bi bi-file-text me-2"></i>Giới thiệu</h5>
                                <p>Tôi là một nhà đầu tư bất động sản với hơn 5 năm kinh nghiệm trong lĩnh vực. Tôi chuyên về các dự án chung cư cao cấp và biệt thự nghỉ dưỡng. Mục tiêu của tôi là tạo ra giá trị bền vững cho cộng đồng thông qua các dự án bất động sản chất lượng.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <h5>Dự án gần đây</h5>
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1">Chung cư Green Park</h6>
                                <p class="mb-1 text-muted">Hà Nội</p>
                            </div>
                            <span class="badge bg-primary rounded-pill">Đang đầu tư</span>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1">Biệt thự Vinhomes Ocean Park</h6>
                                <p class="mb-1 text-muted">Hưng Yên</p>
                            </div>
                            <span class="badge bg-success rounded-pill">Hoàn thành</span>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1">Đất nền KĐT Thanh Hà</h6>
                                <p class="mb-1 text-muted">Hà Nội</p>
                            </div>
                            <span class="badge bg-warning rounded-pill">Đang xem xét</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>