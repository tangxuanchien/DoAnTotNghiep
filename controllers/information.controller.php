<?php
require '../models/Database.php';

$user_id = $_SESSION['id'];
$db = new Database();
$user = $db->query("SELECT * FROM `users` where user_id = $user_id")->fetch(PDO::FETCH_ASSOC);

$total_post = $db->query("
SELECT count(*) as total_post FROM `posts` p
INNER JOIN properties pr on pr.property_id = p.property_id
INNER JOIN users u on u.user_id = p.user_id
INNER JOIN wards w on w.ward_id = pr.ward_id
INNER JOIN districts d on d.district_id = w.district_id
INNER JOIN property_images i on i.property_id = pr.property_id
WHERE u.user_id = :user_id LIMIT 3", [
    'user_id' => $user_id
])->fetch(PDO::FETCH_ASSOC);

$posts = $db->query("
SELECT * FROM `posts` p
INNER JOIN properties pr on pr.property_id = p.property_id
INNER JOIN users u on u.user_id = p.user_id
INNER JOIN wards w on w.ward_id = pr.ward_id
INNER JOIN districts d on d.district_id = w.district_id
INNER JOIN property_images i on i.property_id = pr.property_id
WHERE u.user_id = :user_id LIMIT 3", [
    'user_id' => $user_id
])->fetchAll(PDO::FETCH_ASSOC);

if (empty($user['introduce'])) {
    $user['introduce'] = 'Chưa có giới thiệu';
}

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
                        <img src="<?= $user['avatar'] ?>" alt="avatar" class="avatar">
                    </div>
                    <h2 class="mb-0"><?= $user['name'] ?></h2>
                    <p class="text-light mb-3">Tham gia ngày <?= $date['day'] . '-' . $date['month'] . '-' . $date['year'] ?></p>
                    <div class="d-flex justify-content-center mb-3">
                        <a href="#" class="social-icon"><i class="fa-brands fa-facebook" style="color: white"></i></a>
                        <a href="#" class="social-icon"><i class="fa-brands fa-tiktok" style="color: white"></i></a>
                        <a href="#" class="social-icon"><i class="fa-brands fa-telegram" style="color: white"></i></a>
                    </div>
                </div>
                <div class="mb-4">
                    <h5>Tiến độ hoàn thành hồ sơ</h5>
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 85%;" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">85%</div>
                    </div>
                </div>
                <form action="/Datn/views/edit-information.view.php?user_id=<?= $user['user_id'] ?>" method="post">
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
                                <p><strong>Email:</strong> <?= $user['email'] ?></p>
                                <p><strong>Số điện thoại:</strong> <?= $user['phone'] ?></p>
                                <p><strong>Địa chỉ:</strong> Hà Nội, Việt Nam</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fa-regular fa-building"></i> Thông tin giao dịch</h5>
                                <p><strong>Số bài đăng:</strong> <?= $total_post['total_post'] ?> </p>
                                <p><strong>Khu vực chủ yếu:</strong> Hai Bà Trưng</p>
                                <p><strong>Loại hình ưa thích:</strong> Chung cư</p>
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
                            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
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

</body>