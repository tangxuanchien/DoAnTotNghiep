<?php
require 'header.admin.php';
require 'home.admin.controller.php';
?>

<div class="container-fluid">
  <?php require 'navigation.admin.php'; ?>
  <main class="ms-sm-auto col-lg-10 main-content">
    <div class="row col-md-12">
      <!-- <div class="search">
            <form action="/Datn/views/search-post.view.php" method="post" class="d-flex my-3" role="search">
              <input class="form-control me-2" type="search" placeholder="Tìm kiếm theo tiêu đề" aria-label="Tìm kiếm" name="search" id="search">
              <button class="btn btn-dark" id="search-btn" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
          </div> -->
      <table class="table table-striped">
        <?php if ($_SERVER['PATH_INFO'] == '/posts'): ?>
          <h2>Quản lí bài đăng</h2>
          <thead>
            <tr>
              <th>ID</th>
              <th>Người đăng</th>
              <th>Phường</th>
              <th>Quận</th>
              <th>Trạng thái</th>
              <th>Thao tác</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($posts as $post): ?>
              <tr>
                <td><?= $post['post_id'] ?></td>
                <td><?= $post['name'] ?></td>
                <td><?= $post['ward_name'] ?></td>
                <td><?= $post['district_name'] ?></td>
                <td>
                  <?php if ($post['status'] == 'available') {
                    echo '<p class ="badge text-bg-warning text-wrap">Đang bán</p>';
                  } elseif ($post['status'] == 'sold') {
                    echo '<p class ="badge text-bg-success text-wrap">Bán thành công</p>';
                  } elseif ($post['status'] == 'hide') {
                    echo '<p class ="badge text-bg-secondary text-wrap">Đã bị ẩn</p>';
                  } else {
                    echo '<p class ="badge text-bg-danger text-wrap">Đã xóa</p>';
                  } ?>
                </td>
                <td>
                  <ul>
                    <li>
                      <a href="/Datn/admin/view-post.admin.php?post_id=<?= $post['post_id'] ?>" class="btn btn-dark">
                        <i class="fa-solid fa-eye"></i> Xem
                      </a>
                    </li>
                    <li>
                      <form action="/Datn/admin/delete.admin.php" method="post">
                        <input type="hidden" name="post_id" value="<?= $post['post_id'] ?>">
                        <button class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">
                          <i class="fa-solid fa-trash-can"></i> Xóa
                        </button>
                      </form>
                    </li>
                    <li>
                      <form action="/Datn/admin/edit-post.admin.view.php" method="post">
                        <input type="hidden" name="post_id" value="<?= $post['post_id'] ?>">
                        <button class="btn btn-primary">
                          <i class="fa-solid fa-pen-to-square"></i> Sửa
                        </button>
                      </form>
                    </li>
                    <li>
                      <form action="/Datn/admin/authentic-post.admin.php" method="post">
                        <input type="hidden" name="post_id" value="<?= $post['post_id'] ?>">
                        <?php if ($post['authentic'] == 0): ?>
                          <button class="btn btn-outline-success" type="submit">
                            <i class="fa-regular fa-circle-check"></i> Xác thực
                          </button>
                        <?php else: ?>
                          <button class="btn btn-success" type="button">
                            <i class="fa-solid fa-circle-check"></i> Đã xác thực
                          </button>
                        <?php endif ?>
                      </form>
                    </li>
                  </ul>
                </td>
              </tr>
          <?php endforeach;
          endif; ?>
          <?php if ($_SERVER['PATH_INFO'] == '/comments'): ?>
            <h2>Quản lí bình luận</h2>
            <thead>
              <tr>
                <th>ID</th>
                <th>Tên người dùng</th>
                <th>Nội dung</th>
                <th>ID bài đăng</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
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
                  <?php if ($comment['status_comment'] == 'pending') {
                    echo '<p class ="badge text-bg-secondary text-wrap">Chưa phê duyệt</p>';
                  } elseif ($comment['status_comment'] == 'approved') {
                    echo '<p class ="badge text-bg-success text-wrap">Phê duyệt</p>';
                  } else {
                    echo '<p class ="badge text-bg-danger text-wrap">Từ chối</p>';
                  } ?>
                </td>
                <td>
                  <?php if ($comment['status_comment'] == 'approved'): ?>
                    <ul>
                      <li>
                        <a href="/Datn/admin/view-post.admin.php?post_id=<?= $comment['post_id'] ?>" class="btn btn-dark">
                          <i class="fa-solid fa-eye"></i> Xem
                        </a>
                      </li>
                      <li>
                        <form action="/Datn/admin/delete.admin.php" method="post">
                          <input type="hidden" name="comment_id" value="<?= $comment['comment_id'] ?>">
                          <button class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">
                            <i class="fa-solid fa-trash-can"></i> Xóa
                          </button>
                        </form>
                      </li>
                      <li>
                        <form action="/Datn/admin/edit-comment.admin.view.php" method="post">
                          <input type="hidden" name="comment_id" value="<?= $comment['comment_id'] ?>">
                          <button class="btn btn-primary">
                            <i class="fa-solid fa-pen-to-square"></i> Sửa
                          </button>
                        </form>
                      </li>
                    </ul>
                  <?php else: ?>
                    <button class="btn btn-dark" type="button">
                      <i class="fa-solid fa-trash-can"></i> Đã xóa
                    </button>
                  <?php endif ?>
                </td>
              </tr>
          <?php
            endforeach;
          endif
          ?>
          <?php if ($_SERVER['PATH_INFO'] == '/users'): ?>
            <h2>Quản lí người dùng</h2>
            <thead>
              <tr>
                <th>ID</th>
                <th>Tên người dùng</th>
                <th>Số điện thoại</th>
                <th>Email</th>
                <th>Thao tác</th>
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
                      <a href="/Datn/admin/view-user.admin.php?user_id=<?= $user['user_id'] ?>" class="btn btn-dark">
                        <i class="fa-solid fa-eye"></i> Xem
                      </a>
                    </li>
                    <li>
                      <form action="/Datn/admin/delete.admin.php" method="post">
                        <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
                        <button class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">
                          <i class="fa-solid fa-trash-can"></i> Xóa
                        </button>
                      </form>
                    </li>
                    <li>
                      <form action="/Datn/admin/edit-user.admin.view.php" method="post">
                        <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
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
          <?php if ($_SERVER['PATH_INFO'] == '/reports'): ?>
            <h2>Quản lí báo cáo, hỗ trợ</h2>
            <thead>
              <tr>
                <th>ID</th>
                <th>Nội dung</th>
                <th>Loại báo cáo</th>
                <th>ID bài viết</th>
                <th>ID người dùng</th>
                <th>Thời gian</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
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
                  <?php if ($report['status_report'] == 'pending') {
                    echo '<p class ="badge text-bg-secondary text-wrap">Chưa phê duyệt</p>';
                  } elseif ($report['status_report'] == 'approved') {
                    echo '<p class ="badge text-bg-success text-wrap">Phê duyệt</p>';
                  } else {
                    echo '<p class ="badge text-bg-danger text-wrap">Từ chối</p>';
                  } ?>
                </td>
                <td>
                  <?php if ($report['status_report'] == 'approved'): ?>
                    <ul>
                      <li>
                        <form action="/Datn/admin/change-report.admin.php" method="post">
                          <input type="hidden" name="report_id" value="<?= $report['report_id'] ?>">
                          <input type="hidden" name="status_report" value="approved">
                          <button class="btn btn-success">
                            <i class="fa-solid fa-check"></i> Phê duyệt
                          </button>
                        </form>
                      </li>
                      <li>
                        <form action="/Datn/admin/change-report.admin.php" method="post">
                          <input type="hidden" name="report_id" value="<?= $report['report_id'] ?>">
                          <input type="hidden" name="status_report" value="rejected">
                          <button class="btn btn-danger">
                            <i class="fa-solid fa-xmark"></i> Từ chối
                          </button>
                        </form>
                      </li>
                    </ul>
                  <?php else: ?>
                    <button class="btn btn-dark" type="button">
                      Đã phê duyệt
                    </button>
                  <?php endif ?>
                </td>
              </tr>
          <?php
            endforeach;
          endif
          ?>
          <?php if ($_SERVER['PATH_INFO'] == '/email-feedbacks'): ?>
            <?php require 'email-feedbacks.admin.php'; ?>
          <?php endif ?>
          </tbody>
      </table>
    </div>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</div>

</html>