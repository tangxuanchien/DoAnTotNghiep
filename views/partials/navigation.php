<body>
    <style>
        :root {
            --primary-color: #2c3e50;
            --accent-color: #e74c3c;
            --hover-color: #c0392b;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
            padding: 0.8rem 0;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary-color);
        }

        .navbar-brand img {
            height: 40px;
            margin-right: 10px;
        }

        .nav-link {
            color: var(--primary-color) !important;
            font-weight: 500;
            padding: 0.8rem 1.2rem !important;
            position: relative;
            transition: all 0.3s ease;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 3px;
            bottom: 0;
            left: 50%;
            background-color: var(--accent-color);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            width: 100%;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--accent-color) !important;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 16px;
            border-radius: 50px;
            background: #f8f9fa;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .user-profile:hover {
            background: #e9ecef;
        }

        .user-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: var(--accent-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        .user-name {
            font-weight: 500;
            color: var(--primary-color);
        }

        .notification-badge {
            position: relative;
            margin-right: 20px;
        }

        .notification-badge i {
            font-size: 1.2rem;
            color: var(--primary-color);
        }

        .badge-count {
            position: absolute;
            top: -8px;
            right: -8px;
            background: var(--accent-color);
            color: white;
            border-radius: 50%;
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            padding: 1rem 0;
        }

        .dropdown-item {
            padding: 0.7rem 1.5rem;
            color: var(--primary-color);
            transition: all 0.2s ease;
        }

        .dropdown-item:hover {
            background: #f8f9fa;
            color: var(--accent-color);
        }

        .dropdown-item i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        @media (max-width: 991.98px) {
            .navbar-collapse {
                background: white;
                padding: 1rem;
                border-radius: 12px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
                margin-top: 1rem;
            }

            .user-profile {
                margin-top: 1rem;
            }
        }

        .navbar-shrink {
            padding: 0.5rem 0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .mega-menu {
            position: absolute;
            width: 100%;
            left: 0;
            background: white;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: all 0.3s ease;
            padding: 2rem;
            z-index: 1000;
        }

        .nav-item:hover .mega-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
    </style>
    <header>
        <nav class="navbar navbar-expand-lg fixed-top">
            <div class="container">
                <a href="/Datn"><img src="https://res.cloudinary.com/djdf56dfq/image/upload/v1728370944/nb6vvykp5cfauwifdhm5.png" alt="logo-hanoihome" height="50px"></a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a class='<?= $_SERVER['REQUEST_URI'] == '/Datn/' ? 'nav-link active' : 'nav-link' ?>' href="/Datn">
                                <i class="fas fa-home"></i> Trang chủ
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class='<?= $_SERVER['REQUEST_URI'] == '/Datn/views/price-statistics.view.php' ? 'nav-link active' : 'nav-link' ?>' href="/Datn/views/price-statistics.view.php">
                                <i class="fas fa-chart-line"></i> Thống kê giá
                            </a>
                            <!-- <div class="mega-menu">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h5>Thống kê theo khu vực</h5>
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="dropdown-item">Hà Nội</a></li>
                                            <li><a href="#" class="dropdown-item">TP. Hồ Chí Minh</a></li>
                                            <li><a href="#" class="dropdown-item">Đà Nẵng</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Loại bất động sản</h5>
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="dropdown-item">Căn hộ</a></li>
                                            <li><a href="#" class="dropdown-item">Nhà riêng</a></li>
                                            <li><a href="#" class="dropdown-item">Đất nền</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Báo cáo</h5>
                                        <ul class="list-unstyled">
                                            <li><a href="#" class="dropdown-item">Báo cáo tháng</a></li>
                                            <li><a href="#" class="dropdown-item">Báo cáo quý</a></li>
                                            <li><a href="#" class="dropdown-item">Báo cáo năm</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div> -->
                        </li>
                        <li class="nav-item">
                            <a class="<?= $_SERVER['REQUEST_URI'] == '/Datn/views/manage-posts.view.php' ? 'nav-link active' : 'nav-link' ?>" href="/Datn/views/manage-posts.view.php">
                                <i class="fas fa-edit"></i> Quản lí bài đăng
                            </a>
                        </li>
                    </ul>

                    <div class="d-flex align-items-center">

                        <div class="dropdown">
                            <?php if ($login == 'Đăng nhập') : ?>
                                <div class="user-profile">
                                    <div class="user-avatar">
                                        HN
                                    </div>
                                    <a href="/Datn/views/login.view.php" style="color: #2c3e50"><?= $login ?></a>
                                <?php else: ?>
                                    <div class="user-profile" data-bs-toggle="dropdown">
                                        <div>
                                            <img src="<?= $_SESSION['avatar'] ?>" alt="avatar" width="35px">
                                        </div>
                                        <span class="user-name d-none d-lg-block"><?= $login ?></span>
                                        <i class="fas fa-chevron-down ms-2"></i>
                                    <?php endif ?>
                                    </div>
                                    <?php if ($login != 'Đăng nhập') : ?>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item" href="/Datn/views/information.view.php"><i class="fas fa-user"></i> Hồ sơ</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog"></i> Cài đặt</a></li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li><a class="dropdown-item text-danger" href="/Datn/controllers/logout.controller.php"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a></li>
                                        </ul>
                                    <?php endif ?>
                                </div>
                        </div>
                    </div>
                </div>
        </nav>
    </header>
    <main>