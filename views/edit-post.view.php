<?php
session_start();
require '../function.php';
require '../models/Database.php';

$title = "Chỉnh sửa bài đăng";
$banner = "Chỉnh sửa bài đăng";
$property_id = $_GET['property_id'];

$db = new Database();
$edit_post = $db->query("
SELECT * FROM `properties` p
INNER JOIN property_types pt on pt.type_id = p.type_id 
INNER JOIN wards w on w.ward_id = p.ward_id
INNER JOIN districts d on d.district_id = w.district_id 
WHERE property_id = :property_id", [
    'property_id' => $property_id
])->fetch(PDO::FETCH_ASSOC);
$types = $db->query("SELECT * FROM `property_types`")->fetchAll(PDO::FETCH_ASSOC);
$districts = $db->query("SELECT * FROM `districts`")->fetchAll(PDO::FETCH_ASSOC);

$_SESSION['ward_id_selected'] = $edit_post['ward_id'];
$_SESSION['district_id_selected'] = $edit_post['district_id'];
$login = check_login($_SESSION['name']);
if (!isset($_SESSION['error_post'])) {
    $_SESSION['error_post'] = '';
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
    <form action="/Datn/controllers/create.post.controller.php?user_id=<?= $user_id ?> &property_id=<?= $property_id ?>" method="POST" enctype="multipart/form-data" id="submit-post">
        <div class="text-danger fw-semibold lh-1 fs-5 mt-3"><?= $_SESSION['error_post'] ?></div>
        <div class="mb-3">
            <label class="form-label">Tiêu đề</label>
            <input type="text" class="form-control" placeholder="Tiêu đề ngắn gọn" name='title' value="<?= $edit_post['title'] ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Mô tả chi tiết</label>
            <textarea placeholder="Mô tả chi tiết về bài đăng" class="form-control" name='description'><?= $edit_post['description'] ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Số điện thoại liên hệ người bán</label>
            <input type="number" class="form-control" placeholder="09xx-xxx-xxx" name='contact_info' value="<?= $edit_post['contact_info'] ?>">
        </div>
        <div class="select-room mb-3">
            <ul>
                <li>
                    <label class="form-label">Giá bán (triệu VND)</label>
                    <input type="text" class="form-control" placeholder="Đơn vị triệu đồng (2,2 tỉ = 2200 triệu đồng)" name='price' value="<?= $edit_post['price'] ?>">
                </li>
                <li>
                    <label class="form-label">Diện tích đất (m2)</label>
                    <input type="text" class="form-control" placeholder="Diện tích đất trên sổ đỏ theo mét vuông" name='area' value="<?= $edit_post['area'] ?>">
                </li>
                <li>
                    <label class="form-label">Số phòng ngủ</label>
                    <input type="number" class="form-control" name='num_bedrooms' value="<?= $edit_post['num_bedrooms'] ?>">
                </li>
                <li>
                    <label class="form-label">Số phòng vệ sinh</label>
                    <input type="number" class="form-control" name='num_bathrooms' value="<?= $edit_post['num_bathrooms'] ?>">
                </li>
            </ul>
        </div>
        <div class="mb-3 select-location">
            <ul>
                <li>
                    <label class="form-label">Phân loại bất động sản</label></br>
                    <select class="form-select" name="type_id">
                        <option value="">--Chọn Loại--</option>
                        <?php foreach ($types as $type): ?>
                            <option value="<?= $type['type_id'] ?>" <?= $type['type_id'] == $edit_post['type_id'] ? 'selected' : '' ?>>
                                <?= $type['type_name'] ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </li>
                <li>
                    <label class="form-label">Chọn Quận</label></br>
                    <select class="district_id form-select" name="district_id">
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
                    <select class="ward_id form-select" name="ward_id">
                        <option value="">--Chọn Phường--</option>
                        <?php if (isset($edit_post['ward_id'])): ?>
                            <option value="<?= $edit_post['ward_id'] ?>" selected><?= $edit_post['ward_name'] ?></option>
                        <?php endif; ?>
                    </select>
                </li>
            </ul>
        </div>
        <div class="mb-3">
            <label class="form-label">Chọn ảnh để tải lên:</label>
            <input class="form-control mb-3" type="file" name="image[]" id="image" multiple onchange="previewImage()">
            <div id="preview"></div>
        </div>
        <div class="mt-3 mb-5">
            <button type="submit" class="btn btn-primary" onclick="return confirm('Bạn chắc chắn chỉnh sửa bài đăng không ?')">Chỉnh sửa</button>
            <div class="mt-3 ml-3">
                <a href="/Datn/views/login.view.php" class="link-dark">Quay lại</a>
            </div>
        </div>
    </form>
</div>
<?php
require 'partials/footer.php';
?>