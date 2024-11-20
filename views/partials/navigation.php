<body>
    <header>
        <nav class="navbar navbar-expand-lg fixed-top">
            <div class="container">
                <a href="/Datn"><img src="https://res.cloudinary.com/djdf56dfq/image/upload/v1728370944/nb6vvykp5cfauwifdhm5.png" alt="logo-hanoihome" height="50px"></a>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a class='<?= $_SERVER['REQUEST_URI'] == '/Datn/' ? 'nav-link active' : 'nav-link' ?>' href="/Datn">
                                <i class="fa-solid fa-house"></i> Trang chủ
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class='<?= $_SERVER['REQUEST_URI'] == '/Datn/views/price-statistics.view.php' ? 'nav-link active' : 'nav-link' ?>' href="/Datn/views/price-statistics.view.php">
                                <i class="fa-solid fa-chart-simple"></i> Thống kê giá
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="<?= $_SERVER['SCRIPT_NAME'] == '/Datn/views/manage-posts.view.php' ? 'nav-link active' : 'nav-link' ?>">
                                <i class="fa-solid fa-id-badge"></i> Quản lí bài đăng
                            </a>
                            <?php if (isset($_SESSION['user_id'])): ?>
                                <div class="mega-menu">
                                    <ul class="list-unstyled">
                                        <li><a href="/Datn/views/save-post.view.php" class="mega-dropdown-item">Tin đã lưu</a></li>
                                        <li><a href="/Datn/views/manage-posts.view.php/available" class="mega-dropdown-item">Quản lý bài đăng</a></li>
                                    </ul>
                                </div>
                            <?php endif ?>
                        </li>
                        <li class="nav-item">
                            <?php if (isset($_SESSION['user_id'])): ?>
                                <a class="<?= $_SERVER['SCRIPT_NAME'] == '/Datn/views/create.post.view.php' ? 'nav-link active' : 'nav-link' ?>" href="/Datn/views/create.post.view.php?user_id=<?= $_SESSION['user_id'] ?>">
                                    <i class="fa-solid fa-pen-to-square"></i> Đăng tin mới
                                </a>
                            <?php else: ?>
                                <a class="<?= $_SERVER['SCRIPT_NAME'] == '/Datn/views/create.post.view.php' ? 'nav-link active' : 'nav-link' ?>" href="#">
                                    <i class="fa-solid fa-pen-to-square"></i> Đăng tin mới
                                </a>
                            <?php endif ?>
                        </li>
                    </ul>

                    <div class="d-flex align-items-center">
                        <div class="dropdown">
                            <?php if ($login == 'Đăng nhập') : ?>
                                <div class="user-profile">
                                    <div class="user-avatar">
                                        <i class="fa-solid fa-user text-light"></i>
                                    </div>
                                    <a href="/Datn/views/login.view.php" style="color: #2c3e50 !important; font-weight: 500;"><?= $login ?></a>
                                <?php else: ?>
                                    <div class="user-profile" data-bs-toggle="dropdown">
                                        <div>
                                            <img src="<?= $_SESSION['avatar'] ?>" alt="avatar" class="image-avatar">
                                        </div>
                                        <span class="user-name d-none d-lg-block"><?= $login ?></span>
                                        <i class="fa-solid fa-chevron-down"></i>
                                    <?php endif ?>
                                    </div>
                                    <?php if ($login != 'Đăng nhập') : ?>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item" href="/Datn/views/information.view.php"><i class="fa-solid fa-user"></i> Hồ sơ</a></li>
                                            <li><a class="dropdown-item" href="/Datn/views/change-password.view.php"><i class="fa-solid fa-key"></i> Đổi mật khẩu</a></li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li><a class="dropdown-item text-danger" href="/Datn/controllers/logout.controller.php"><i class="fa-solid fa-right-from-bracket"></i> Đăng xuất</a></li>
                                        </ul>
                                    <?php endif ?>
                                </div>
                        </div>
                    </div>
                </div>
        </nav>
    </header>
    <main>