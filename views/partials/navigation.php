<body>
    <header>
        <!-- Fixed navbar -->
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <div style="padding: 3px 10px;">
                <a href="/Datn"><img src="https://res.cloudinary.com/djdf56dfq/image/upload/v1726818573/rxold0efbwrvj3r9rwjr.png" alt="logo-hanoihome" height="50px"></a>
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
            <a class="navbar-brand" href="#"><i class="fa-regular fa-circle-user" style="font-size: 25px;"></i></a>
            <a class="navbar-brand" href="<?= $login === 'Đăng nhập' ? "/Datn/views/login.view.php" : "" ?>"><?= $login ?></a>
        </nav>
    </header>
    <!-- Begin page content -->
    <main class="flex-shrink-0">