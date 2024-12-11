<?php
require 'header.admin.php';
require 'home.admin.controller.php';
?>

<body>
  <div class="container-fluid">
    <div class="row">
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
          </ul>
        </div>
        <div class="sidebar-bottom">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link" href="/Datn/views/information.view.php">
                <i class="fa-solid fa-circle-user"></i>
                Hồ sơ
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-danger" href="/Datn/controllers/logout.controller.php">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                Đăng xuất
              </a>
            </li>
          </ul>
        </div>
      </nav>

      <main class="ms-sm-auto col-lg-10 main-content">
        <div class="row">
          <div class="col-md-12">
            <?php if ($_SERVER['PATH_INFO'] == '/posts'): ?>
              <h2>Quản lí bài đăng</h2>
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Tiêu đề</th>
                    <th>Phường</th>
                    <th>Quận</th>
                    <th>Trạng thái</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($posts as $post): ?>
                    <tr>
                      <td><?= $post['post_id'] ?></td>
                      <td><?= $post['title'] ?></td>
                      <td><?= $post['ward_name'] ?></td>
                      <td><?= $post['district_name'] ?></td>
                      <td>
                        <a href=""><i class="fa-solid fa-trash-can"></i> Xóa</a>
                        <a href=""><i class="fa-solid fa-pen-to-square"></i> Sửa</a>
                      </td>
                    </tr>
                <?php
                  endforeach;
                endif
                ?>
                <?php if ($_SERVER['PATH_INFO'] == '/comments'): ?>
                  <h2>Quản lí bình luận</h2>
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Tên người dùng</th>
                        <th>Nội dung</th>
                        <!-- <th>Quận</th> -->
                        <th>Trạng thái</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($comments as $comment): ?>
                        <tr>
                          <td><?= $comment['comment_id'] ?></td>
                          <td><?= $comment['name'] ?></td>
                          <td><?= $comment['content'] ?></td>
                          <!-- <td><?= $comment['district_name'] ?></td> -->
                          <td>
                            <a href=""><i class="fa-solid fa-trash-can"></i> Xóa</a>
                            <a href=""><i class="fa-solid fa-pen-to-square"></i> Sửa</a>
                          </td>
                        </tr>
                    <?php
                      endforeach;
                    endif
                    ?>
                    <?php if ($_SERVER['PATH_INFO'] == '/users'): ?>
                      <h2>Quản lí người dùng</h2>
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Tên người dùng</th>
                            <th>Nội dung</th>
                            <th>Trạng thái</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($users as $user): ?>
                            <tr>
                              <td><?= $user['user_id'] ?></td>
                              <td><?= $user['name'] ?></td>
                              <td><?= $user['content'] ?></td>
                              <!-- <td><?= $user['district_name'] ?></td> -->
                              <td>
                                <a href=""><i class="fa-solid fa-trash-can"></i> Xóa</a>
                                <a href=""><i class="fa-solid fa-pen-to-square"></i> Sửa</a>
                              </td>
                            </tr>
                        <?php
                          endforeach;
                        endif
                        ?>
                        </tbody>
                      </table>
          </div>
        </div>
      </main>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>