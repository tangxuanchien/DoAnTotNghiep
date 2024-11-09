<?php
session_start();
require '../function.php';

$title = "Quản lí bài đăng";
$banner = "";
$login = check_login($_SESSION['name']);

require 'partials/header.php';

require 'partials/navigation.php';

require 'partials/banner.php';

if (!empty($_SESSION['user_id'])) {
    require '../controllers/change-password.controller.php';
}
?>
<style>
    .card {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background-color: #007bff;
        color: white;
    }
</style>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">Thay đổi mật khẩu</h3>
                </div>
                <div class="card-body">
                    <form>
                        <div class="mb-3">
                            <label for="currentPassword" class="form-label">Mật khẩu hiện tại</label>
                            <input type="password" class="form-control" name="current_password" required>
                        </div>
                        <div class="mb-3">
                            <label for="newPassword" class="form-label">Mật khẩu mới</label>
                            <input type="password" class="form-control" name="new_password" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Xác nhận mật khẩu mới</label>
                            <input type="password" class="form-control" name="confirm_password" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Thay đổi mật khẩu</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="text-danger fw-semibold lh-1 fs-5 mt-3"><?= $_SESSION['error_change_password'] ?></div>
        </div>
    </div>
</div>
<?php
require 'partials/footer.php';
