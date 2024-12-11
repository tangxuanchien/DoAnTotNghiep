<?php
require 'header.admin.php';
require 'home.admin.controller.php';
?>

<body>
  <div class="container-fluid">
    <div class="row">
      <?php
      require 'navigation.admin.php';
      ?>
      <main class="ms-sm-auto col-lg-10 main-content">
        <div class="row col-md-12">
          <!-- <div class="search">
            <form action="/Datn/views/search-post.view.php" method="post" class="d-flex my-3" role="search">
              <input class="form-control me-2" type="search" placeholder="Tìm kiếm theo tiêu đề" aria-label="Tìm kiếm" name="search" id="search">
              <button class="btn btn-dark" id="search-btn" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
          </div> -->
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
                      <ul>
                        <li>
                          <form action="/Datn/admin/delete.admin.php" method="post">
                            <input type="hidden" name="post_id" value="<?= $post['post_id'] ?>">
                            <button class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">
                              <i class="fa-solid fa-trash-can"></i> Xóa
                            </button>
                          </form>
                        </li>
                        <li>
                          <form action="/Datn/admin/edit.admin.view.php" method="post">
                            <input type="hidden" name="post_id" value="<?= $post['post_id'] ?>">
                            <button class="btn btn-primary">
                              <i class="fa-solid fa-pen-to-square"></i> Sửa
                            </button>
                          </form>
                        </li>
                      </ul>
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
                      <th>ID bài đăng</th>
                      <th>Trạng thái</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($comments as $comment): ?>
                      <tr>
                        <td><?= $comment['comment_id'] ?></td>
                        <td><?= $comment['name'] ?></td>
                        <td><?= $comment['content'] ?></td>
                        <td><?= $comment['post_id'] ?></td>
                        <td>
                          <ul>
                            <li>
                              <form action="/Datn/admin/delete.admin.php" method="post">
                                <button class="btn btn-danger">
                                  <input type="hidden" name="comment_id" value="<?= $comment['comment_id'] ?>"
                                    onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">
                                  <i class="fa-solid fa-trash-can"></i> Xóa
                                </button>
                              </form>
                            </li>
                            <li>
                              <form action="/Datn/admin/edit.admin.php" method="post">
                                <button class="btn btn-primary" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">
                                  <i class="fa-solid fa-pen-to-square"></i> Sửa
                                </button>
                              </form>
                            </li>
                          </ul>
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
                          <th>Số điện thoại</th>
                          <th>Email</th>
                          <th>Trạng thái</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($users as $user): ?>
                          <tr>
                            <td><?= $user['user_id'] ?></td>
                            <td><?= $user['name'] ?></td>
                            <td><?= $user['phone'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td>
                              <ul>
                                <li>
                                  <form action="/Datn/admin/delete.admin.php" method="post">
                                    <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
                                    <button class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">
                                      <i class="fa-solid fa-trash-can"></i> Xóa
                                    </button>
                                  </form>
                                </li>
                                <li>
                                  <form action="/Datn/admin/edit.admin.php" method="post">
                                    <button class="btn btn-primary" onclick="confirm('Bạn có chắc chắn muốn xóa không?')">
                                      <i class="fa-solid fa-pen-to-square"></i> Sửa
                                    </button>
                                  </form>
                                </li>
                              </ul>
                            </td>
                          </tr>
                      <?php
                        endforeach;
                      endif
                      ?>
                      <?php if ($_SERVER['PATH_INFO'] == '/reports'): ?>
                        <h2>Quản lí báo cáo</h2>
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>ID</th>
                              <th>Nội dung</th>
                              <th>Loại báo cáo</th>
                              <th>ID bài viết</th>
                              <th>ID người dùng báo cáo</th>
                              <th>Thời gian</th>
                              <th>Trạng thái</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach ($reports as $report): ?>
                              <tr>
                                <td><?= $report['report_id'] ?></td>
                                <td><?= $report['content_report'] ?></td>
                                <td><?= $report['type_report'] ?></td>
                                <td><?= $report['post_report_id'] ?></td>
                                <td><?= $report['user_report_id'] ?></td>
                                <td><?= $report['created_report_at'] ?></td>
                                <td>
                                  <form action="/Datn/admin/delete.admin.php" method="post">
                                    <input type="hidden" name="report_id" value="<?= $report['report_id'] ?>">
                                    <button class="btn btn-primary">
                                      <i class="fa-solid fa-check"></i> Phê duyệt
                                    </button>
                                  </form>
                                </td>
                              </tr>
                          <?php
                            endforeach;
                          endif
                          ?>
                          </tbody>
                        </table>
        </div>
      </main>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>