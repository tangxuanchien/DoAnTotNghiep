<?php
session_start();
require '../function.php';
require '../models/Database.php';

$db = new Database();
$districts = $db->query("SELECT * FROM `districts`")->fetchAll(PDO::FETCH_ASSOC);

$user_id = $_SESSION['user_id'];
$title = "Tạo bài đăng";
$banner = "";
$login = check_login($_SESSION['name']);
if (!isset($_SESSION['error_post'])) {
    $_SESSION['error_post'] = '';
}

require 'partials/header.php';

require 'partials/navigation.php';

require 'partials/banner.php';
?>
<div class="container-create-post">
    <h1>Bài đăng mới</h1>
    <form action="/Datn/controllers/create.post.controller.php?user_id=<?= $user_id ?>" method="POST" enctype="multipart/form-data" id="submit-post">
        <div class="text-danger fw-semibold lh-1 fs-5 mt-3"><?= $_SESSION['error_post'] ?></div>
        <div class="mb-3">
            <label class="form-label">Tiêu đề</label>
            <input type="text" class="form-control" placeholder="Tiêu đề ngắn gọn" name='title' required maxlength="100">
        </div>
        <div class="mb-3">
            <label class="form-label">Mô tả chi tiết</label>
            <textarea placeholder="Mô tả chi tiết về bài đăng" class="form-control" name='description' required maxlength="300"></textarea>
        </div>
        <div class="select-status mb-3">
            <ul>
                <li>
                    <label class="form-label">Số điện thoại liên hệ người bán</label>
                    <input type="number" class="form-control" name='contact_info' required min="100000000" max="999999999">
                </li>
                <li>
                    <label class="form-label">Loại bài đăng</label>
                    <select class="form-select" name="status" required>
                        <option value="">--Chọn Loại--</option>
                        <option value="available">Đăng bán</option>
                        <option value="for_rent">Cho thuê</option>
                    </select>
                </li>
            </ul>
        </div>
        <div class="select-room mb-3">
            <ul>
                <li>
                    <label class="form-label">Giá bán (triệu VND)</label>
                    <input type="number" class="form-control" name='price' required min="0" max="100000">
                </li>
                <li>
                    <label class="form-label">Diện tích đất (m<sup>2</sup>)</label>
                    <input type="number" class="form-control" name='area' required min="50" max="1000">
                </li>
                <li>
                    <label class="form-label">Số phòng ngủ</label>
                    <input type="number" class="form-control" name='num_bedrooms' required max="20">
                </li>
                <li>
                    <label class="form-label">Số phòng vệ sinh</label>
                    <input type="number" class="form-control" name='num_bathrooms' required max="20">
                </li>
            </ul>
        </div>
        <div class="mb-3 select-location">
            <ul>
                <li>
                    <label class="form-label">Phân loại bất động sản</label></br>
                    <select class="form-select" name="type" required>
                        <option value="">--Chọn Loại--</option>
                        <option value="home">Nhà ở</option>
                        <option value="apartment">Chung cư/Căn hộ</option>
                        <option value="land">Đất</option>
                    </select>
                </li>
                <li>
                    <label class="form-label">Chọn Quận</label></br>
                    <select class="district_id form-select" name="district_id" required>
                        <option value="">--Chọn Quận--</option>
                        <?php foreach ($districts as $district): ?>
                            <option value="<?= $district['district_id'] ?>"><?= $district['district_name'] ?></option>
                        <?php endforeach ?>
                    </select>
                </li>
                <li>
                    <label class="form-label">Chọn Phường:</label></br>
                    <select class="ward_id form-select" name="ward_id" required>
                        <option value="">--Chọn Phường--</option>
                    </select>
                </li>
            </ul>
        </div>
        <div class="mb-3">
            <label class="form-label">Chọn ảnh để tải lên:</label>
            <input class="form-control mb-3" type="file" name="image[]" id="image" multiple onchange="previewImage()" required>
            <div id="preview"></div>
        </div>
        <div class="mt-3 mb-5">
            <button type="submit" class="btn btn-primary" onclick="return confirm('Bạn chắc chắn muốn đăng bài không ?')">Đăng bài</button>
        </div>
    </form>
</div>
<script>
    $(document).ready(function() {
        $('.district_id').change(function(e) {
            var district_id = $('.district_id').val();
            $.ajax({
                url: '../controllers/get_wards.php',
                type: 'POST',
                data: {
                    district_id: district_id
                },
                success: function(response) {
                    $('.ward_id').html('<option value="">--Chọn Phường--</option>');
                    $('.ward_id').append(response);
                }
            });
        });
    });

    function previewImage() {
        const preview = document.getElementById('preview');
        preview.innerHTML = '';
        const files = document.getElementById('image').files;

        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const reader = new FileReader();

            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.maxWidth = '150px';
                img.style.marginRight = '10px';
                preview.appendChild(img);
            }

            reader.readAsDataURL(file);
        }
    }
</script>
<?php
require 'partials/footer.php';
?>