<?php
session_start();
require '../function.php';
require '../models/Database.php';

$title = "Chỉnh sửa bài đăng";
$banner = "Chỉnh sửa bài đăng";
$post_id = $_POST['post_id'];

$db = new Database();
$edit_post = $db->query("
SELECT * FROM `properties` p
INNER JOIN wards w on w.ward_id = p.ward_id
INNER JOIN districts d on d.district_id = w.district_id 
INNER JOIN posts po on po.property_id = p.property_id 
WHERE po.post_id = :post_id", [
    'post_id' => $post_id
])->fetch(PDO::FETCH_ASSOC);
$images = $db->query("
SELECT * FROM `property_images` i 
INNER JOIN posts p on p.property_id = i.property_id 
WHERE post_id = :post_id", [
    'post_id' => $post_id
])->fetchAll(PDO::FETCH_ASSOC);

$type = $edit_post['type'];
$districts = $db->query("SELECT * FROM `districts`")->fetchAll(PDO::FETCH_ASSOC);

$_SESSION['ward_id_selected'] = $edit_post['ward_id'];
$_SESSION['district_id_selected'] = $edit_post['district_id'];
$login = check_login($_SESSION['name']);
if (!isset($_SESSION['error_edit_post'])) {
    $_SESSION['error_edit_post'] = '';
}

require 'partials/header.php';

require 'partials/navigation.php';

require 'partials/banner.php';
?>
<script>
    $(document).ready(function() {
        function loadWards(district_id) {
            $.ajax({
                url: '../controllers/get_ward_selected.php',
                type: 'POST',
                data: {
                    district_id: district_id
                },
                success: function(response) {
                    $('.ward_id').html('<option value="">--Chọn Phường--</option>');
                    $('.ward_id').append(response);
                }
            });
        }

        $('.district_id').change(function(e) {
            var district_id = $(this).val();
            loadWards(district_id);
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
<div class="container-create-post">
    <form action="/Datn/controllers/edit-post.controller.php" method="POST" enctype="multipart/form-data" id="submit-post">
        <input type="hidden" name="post_id" value="<?= $post_id ?>">
        <div class="text-danger fw-semibold lh-1 fs-5 mt-3"><?= $_SESSION['error_edit_post'] ?></div>
        <div class="mb-3">
            <label class="form-label">Tiêu đề</label>
            <input type="text" class="form-control" placeholder="Tiêu đề ngắn gọn" name='title' value="<?= $edit_post['title'] ?>" required maxlength="100">
        </div>
        <div class="mb-3">
            <label class="form-label">Mô tả chi tiết</label>
            <textarea placeholder="Mô tả chi tiết về bài đăng" class="form-control" name='description' required maxlength="300"><?= $edit_post['description'] ?></textarea>
        </div>
        <div class="select-status mb-3">
            <ul>
                <li>
                    <label class="form-label">Số điện thoại liên hệ người bán</label>
                    <input type="number" class="form-control" name='contact_info' value="<?= $edit_post['contact_info'] ?>" required min="100000000" max="999999999">
                </li>
                <li>
                    <label class="form-label">Loại bài đăng</label>
                    <select class="form-select" name="status" required>
                        <option value="">--Chọn Loại--</option>
                        <option value="available" <?= $edit_post['status'] == 'available' ? 'selected' : '' ?>>Đăng bán</option>
                        <option value="for_rent" <?= $edit_post['status'] == 'for_rent' ? 'selected' : '' ?>>Cho thuê</option>
                    </select>
                </li>
            </ul>
        </div>
        <div class="select-room mb-3">
            <ul>
                <li>
                    <label class="form-label">Giá bán (triệu VND)</label>
                    <input type="number" class="form-control" placeholder="Đơn vị triệu đồng (2,2 tỉ = 2200 triệu đồng)" name='price' value="<?= $edit_post['price'] ?>" required min="0" max="1000000">
                </li>
                <li>
                    <label class="form-label">Diện tích đất (m<sup>2</sup>)</label>
                    <input type="number" class="form-control" placeholder="Diện tích đất trên sổ đỏ theo mét vuông" name='area' value="<?= $edit_post['area'] ?>" required min="50" max="1000">
                </li>
                <li>
                    <label class="form-label">Số phòng ngủ</label>
                    <input type="number" class="form-control" name='num_bedrooms' value="<?= $edit_post['num_bedrooms'] ?>" required max="20">
                </li>
                <li>
                    <label class="form-label">Số phòng vệ sinh</label>
                    <input type="number" class="form-control" name='num_bathrooms' value="<?= $edit_post['num_bathrooms'] ?>" required max="20">
                </li>
            </ul>
        </div>
        <div class="mb-3 select-location">
            <ul>
                <li>
                    <label class="form-label">Phân loại bất động sản</label></br>
                    <select class="form-select" name="type" required>
                        <option value="">--Chọn Loại--</option>
                            <option value="home" <?= $edit_post['type'] == 'home' ? 'selected' : '' ?>>Nhà ở</option>
                            <option value="apartment" <?= $edit_post['type'] == 'apartment' ? 'selected' : '' ?>>Chung cư/Căn hộ</option>
                            <option value="land" <?= $edit_post['type'] == 'land' ? 'selected' : '' ?>>Đất</option>
                    </select>
                </li>
                <li>
                    <label class="form-label">Chọn Quận</label></br>
                    <select class="district_id form-select" name="district_id" required>
                        <option value="">--Chọn Quận--</option>
                        <?php foreach ($districts as $district): ?>
                            <option value="<?= $district['district_id'] ?>" <?= $district['district_id'] == $edit_post['district_id'] ? 'selected' : '' ?>>
                                <?= $district['district_name'] ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </li>
                <li>
                    <label class="form-label">Chọn Phường:</label></br>
                    <select class="ward_id form-select" name="ward_id" required>
                        <option value="">--Chọn Phường--</option>
                        <?php if (isset($edit_post['ward_id'])): ?>
                            <option value="<?= $edit_post['ward_id'] ?>" selected><?= $edit_post['ward_name'] ?></option>
                        <?php endif; ?>
                    </select>
                </li>
            </ul>
        </div>
        <div class="mb-3">
            <label class="form-label">Chọn ảnh để tải lên: (Lưu ý chọn ảnh mới và nó sẽ thay thế các ảnh cũ bạn đã chọn)</label>
            <input class="form-control mb-3" type="file" name="image[]" id="image" multiple onchange="previewImage()">

            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" name="keep_images" value="yes" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Giữ lại ảnh cũ
                </label>
            </div>
            <div id="preview">
                <?php foreach ($images as $image): ?>
                    <img src="<?= $image['image_url'] ?>" alt="preview" width="200px">
                <?php endforeach; ?>
            </div>
        </div>
        <div class="mt-3 mb-5">
            <button type="submit" class="btn btn-primary" onclick="return confirm('Bạn chắc chắn chỉnh sửa bài đăng không ?')">Chỉnh sửa</button>
            <div class="mt-3 ml-3">
                <a href="/Datn/views/manage-posts.view.php/available" class="link-dark">Quay lại</a>
            </div>
        </div>
    </form>
</div>
<?php
require 'partials/footer.php';
?>