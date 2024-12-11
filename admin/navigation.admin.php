<nav class="col-md-3 col-lg-2 d-md-block sidebar">
    <div class="position-sticky">
        <h3>Trang quản trị</h3>
        <ul class="nav flex-column mt-3">
            <li class="nav-item">
                <a <?= $_SERVER['PATH_INFO'] == '/users' ? 'class="nav-link active"' : 'class="nav-link"' ?>
                    href="/Datn/admin/home.admin.php/users">
                    <i class="fa-solid fa-user-pen"></i>
                    Quản lí người dùng
                </a>
            </li>
            <li class="nav-item">
                <a <?= $_SERVER['PATH_INFO'] == '/comments' ? 'class="nav-link active"' : 'class="nav-link"' ?>
                    href="/Datn/admin/home.admin.php/comments">
                    <i class="fa-solid fa-comment-dots"></i>
                    Quản lý bình luận
                </a>
            </li>
            <li class="nav-item">
                <a <?= $_SERVER['PATH_INFO'] == '/posts' ? 'class="nav-link active"' : 'class="nav-link"' ?>
                    href="/Datn/admin/home.admin.php/posts">
                    <i class="fa-solid fa-square-pen"></i>
                    Quản lý bài đăng
                </a>
            </li>
            <li class="nav-item">
                <a <?= $_SERVER['PATH_INFO'] == '/reports' ? 'class="nav-link active"' : 'class="nav-link"' ?>
                    href="/Datn/admin/home.admin.php/reports">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    Báo cáo
                </a>
            </li>
        </ul>
    </div>
    <div class="sidebar-bottom">
        <ul class="nav flex-column">
            <!-- <li class="nav-item">
              <a class="nav-link" href="/Datn/views/information.view.php">
                <i class="fa-solid fa-circle-user"></i>
                Hồ sơ
              </a>
            </li> -->
            <li class="nav-item">
                <a class="nav-link text-danger" href="/Datn/controllers/logout.controller.php">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    Đăng xuất
                </a>
            </li>
        </ul>
    </div>
</nav>