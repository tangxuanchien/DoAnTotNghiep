<?php
session_start();
require '../function.php';

$title = "Tạo bài đăng";
$banner = "Bài đăng mới";
$login = check_login($_SESSION['name']);
if(!isset($_SESSION['error_post'])){
    $_SESSION['error_post'] = '';
}

require 'partials/header.php';

require 'partials/navigation.php';

require 'partials/banner.php';
?>
<style>
    .text-number {
        width: 50px;
        border-radius: 5px;
    }

    .ml {
        margin-left: 30px;
    }

    .ml-input {
        margin-left: 15px;
    }
</style>
<form action="/Datn/controllers/create.post.controller.php" method="POST">
    <div class="text-danger fw-semibold lh-1 fs-5 mt-3"><?=$_SESSION['error_post']?></div>
    <div class="mb-3">
        <label class="form-label">Tiêu đề</label>
        <input type="text" class="form-control" placeholder="Tiêu đề ngắn gọn" name='title'>
    </div>
    <div class="mb-3">
        <label class="form-label">Mô tả chi tiết</label>
        <textarea placeholder="Mô tả chi tiết về bài đăng" class="form-control" name="description"></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Giá bán</label>
        <input type="text" class="form-control" placeholder="Đơn vị triệu đồng (2,2 tỉ = 2200 triệu đồng)" name='price'>
    </div>
    <div class="mb-3">
        <label class="form-label">Diện tích đất</label>
        <input type="text" class="form-control" placeholder="Diện tích đất trên sổ đỏ theo mét vuông" name='area'>
    </div>
    <div class="mb-3">
        <label class="form-label">Số điện thoại liên hệ người bán</label>
        <input type="number" class="form-control" placeholder="09xx-xxx-xxx" name='contact_info'>
    </div>
    <div class="mb-3">
        <label class="">Số phòng ngủ</label>
        <input type="number" class="text-number ml-input" name='num_bedrooms'>

        <label class="ml">Số phòng vệ sinh</label>
        <input type="number" class="text-number ml-input" name='num_bathrooms'>
    </div>
    <div class="mb-3">
        <label class="form-label">Phân loại bất động sản</label></br>
        <select class="" name="type_id">
            <option value="1">Nhà ở</option>
            <option value="2">Chung cư/Căn hộ</option>
            <option value="3">Đất</option>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Chọn Quận</label></br>
        <select class="district_id" name="district_id">
            <option value="">--Chọn Quận--</option>
            <?php
            require '../models/Database.php';

            $db = new Database();
            $districts = $db->query("SELECT * FROM `districts`")->fetchAll(PDO::FETCH_ASSOC);
            foreach ($districts as $district):
            ?>
                <option value="<?= $district['district_id'] ?>"><?= $district['district_name'] ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <label class="form-label">Chọn Phường:</label></br>
    <select class="ward_id" name="ward_id">
        <option value="">--Chọn Phường--</option>
    </select>
    <script>
        $(document).ready(function(){
            $('.district_id').change(function(e){
                var district_id = $('.district_id').val();
                    $.ajax({
                        url: '../controllers/get_wards.php',
                        type: 'POST',
                        data: {district_id: district_id},
                        success: function(response) {
                            $('.ward_id').html('<option value="">--Chọn Phường--</option>');
                            $('.ward_id').append(response);
                        }
                    }); 
            });
        });
    </script>

    <div class="mt-5">
        <button type="submit" class="btn btn-primary" onclick="return confirm('Bạn chắc chắn muốn đăng bài không ?')">Đăng bài</button>
        <div class="mt-3 ml-3">
            <a href="/Datn/views/login.view.php" class="link-dark">Quay lại</a>
        </div>
    </div>
</form>
<?php
require 'partials/footer.php';
?>