<body>
    <header>
        <nav class="navbar navbar-expand-md fixed-top" id="navbar">
            <div style="padding: 3px 10px;">
                <a href="/Datn"><img src="https://res.cloudinary.com/djdf56dfq/image/upload/v1728370944/nb6vvykp5cfauwifdhm5.png" alt="logo-hanoihome" height="50px"></a>
            </div>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class='<?= $_SERVER['REQUEST_URI'] == '/Datn/' ? 'nav-link active' : 'nav-link' ?>' href="/Datn">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class='<?= $_SERVER['REQUEST_URI'] == '/Datn/views/price-statistics.view.php' ? 'nav-link active' : 'nav-link' ?>' href="/Datn/views/price-statistics.view.php">Thống kê giá</a>
                    </li>
                    <li class="nav-item">
                        <a class="<?= $_SERVER['REQUEST_URI'] == '/Datn/views/information.view.php' ? 'nav-link active' : 'nav-link' ?>" href="/Datn/views/information.view.php">Thông tin cá nhân</a>
                    </li>
                    <li class="nav-item">
                        <a class="<?= $_SERVER['REQUEST_URI'] == '/Datn/views/about.view.php' ? 'nav-link active' : 'nav-link' ?>" href="/Datn/views/about.view.php">Về chúng tôi</a>
                    </li>
                </ul>
            </div>
            <div class="profile-menu">
                <div class="profile" onclick="toggleMenu()">
                    <a class="navbar-brand"><i class="fa-regular fa-circle-user" style="font-size: 25px;"></i></a>
                    <a class="navbar-brand" href="<?= $login === 'Đăng nhập' ? "/Datn/views/login.view.php" : "" ?>"><?= $login ?></a>
                </div>
                <div id="dropdownMenu" class="dropdown-content">
                    <a href="#">Thông tin cá nhân</a>
                    <a href="#">Đổi mật khẩu</a>
                    <a href="#">Đăng xuất</a>
                </div>
            </div>
        </nav>
    </header>
    <main>