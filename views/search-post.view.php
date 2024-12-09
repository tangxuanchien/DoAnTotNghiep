<?php
session_start();
require '../function.php';

$title = "Xem tất cả";
$banner = "Kết quả tìm kiếm";
if (!isset($_SESSION['name'])) {
    $login = 'Đăng nhập';
} else $login = $_SESSION['name'];
if (!isset($_POST['search'])) {
    $_POST['search'] = '';
}
$search = $_POST['search'];

if (!isset($_POST['sort_by_price'])) {
    $_POST['sort_by_price'] = '';
}
if (!isset($_POST['type'])) {
    $_POST['type'] = '';
}
if (!isset($_POST['ward_id'])) {
    $_POST['ward_id'] = 0;
}
if (!isset($_POST['district_id'])) {
    $_POST['district_id'] = 0;
}
if (!isset($_POST['sort_by_created_at'])) {
    $_POST['sort_by_created_at'] = '';
}

require 'partials/header.php';

require 'partials/navigation.php';

require 'partials/banner.php';

require '../controllers/search-post.controller.php';
?>
<div class="container-post search">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/Datn">Trang chủ</a></li>
            <?php if (isset($_GET['source'])): ?>
                <li class="breadcrumb-item">
                    <?php if ($_GET['source'] == 'statistic'): ?>
                        <a href="/Datn/views/price-statistics.view.php">Thống kê giá</a>
                    <?php endif ?>
                </li>
            <?php endif ?>
            <li class="breadcrumb-item active" aria-current="page">Tìm kiếm bài đăng</li>
        </ol>
    </nav>
    <form action="/Datn/views/search-post.view.php?page_number=1" method="post" class="d-flex my-3" role="search">
        <ul>
            <li>
                <input class="form-control me-2" type="search" placeholder="Tìm kiếm theo tiêu đề" aria-label="Tìm kiếm" name="search" id="search" value="<?= $search ?>">
                <div id="result" class="search-result">
                </div>
            </li>
            <li>
                <?php if (!$posts): ?>
                    <h4><i class="fa-solid fa-square-xmark text-danger"></i> Không có kết quả nào trùng khớp</h4>
                <?php else: ?>
                    <h4 class="text-danger"><?= count($posts) ?> kết quả tìm kiếm</h4>
                <?php endif; ?>
            </li>
            <li>
                <ul class="ul-filter">
                    <li>
                        <p><i class="fa-solid fa-sort"></i> Bộ lọc :</p>
                    </li>
                    <li style=" margin-left: 15px;">
                        <select class="form-select w-auto" name="sort_by_price">
                            <option value="">-Giá bán-</option>
                            <option value="price_ASC" <?= ($_POST['sort_by_price'] == 'price_ASC') ? 'selected' : '' ?>>Giá từ thấp nhất</option>
                            <option value="price_DESC" <?= ($_POST['sort_by_price'] == 'price_DESC') ? 'selected' : '' ?>>Giá từ cao nhất</option>
                        </select>
                    </li>
                    <li style=" margin-left: 15px;">
                        <select class="form-select w-auto" name="sort_by_created_at">
                            <option value="">-Thời gian-</option>
                            <option value="created_at_DESC" <?= ($_POST['sort_by_created_at'] == 'created_at_DESC') ? 'selected' : '' ?>>Thời gian mới nhất</option>
                            <option value="created_at_ASC" <?= ($_POST['sort_by_created_at'] == 'created_at_ASC') ? 'selected' : '' ?>>Thời gian cũ nhất</option>
                        </select>
                    </li>
                    <li style=" margin-left: 15px;">
                        <select class="type_id form-select w-auto" name="type">
                            <option value="">--Chọn Loại hình--</option>
                            <option value="home" <?= ($_POST['type'] == 'home') ? 'selected' : '' ?>>Nhà ở</option>
                            <option value="apartment" <?= ($_POST['type'] == 'apartment') ? 'selected' : '' ?>>Chung cư/Căn hộ</option>
                            <option value="land" <?= ($_POST['type'] == 'land') ? 'selected' : '' ?>>Đất</option>
                        </select>
                    <li style=" margin-left: 15px;">
                        <select class="district_id form-select w-auto" name="district_id">
                            <option value="">--Chọn Quận--</option>
                            <?php foreach ($districts as $district): ?>
                                <option value="<?= $district['district_id'] ?>" <?= ($_POST['district_id'] == $district['district_id']) ? 'selected' : '' ?>>
                                    <?= $district['district_name'] ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </li>
                    <li style=" margin-left: 15px;">
                        <select class="ward_id form-select w-auto" name="ward_id">
                            <option value="">--Chọn Phường--</option>
                            <?php if (isset($ward['ward_id'])): ?>
                                <option value="<?= $ward['ward_id'] ?>" selected><?= $ward['ward_name'] ?></option>
                            <?php endif; ?>
                        </select>
                    </li>
                    <li style="margin-left: 15px;">
                        <button class="btn btn-success" type="submit">Áp dụng</button>
                    </li>
                </ul>
            </li>
        </ul>
    </form>
</div>
<?php foreach ($posts as $index => $post):
    $date = date_parse($post['created_at']);
?>
    <div class="container-post mt-3" style="width: 80%;">
        <div class="post-lists">
            <ul>
                <li>
                    <div class="image-container">
                        <a href="<?= $post['image_url'] ?>" data-lightbox="image_property_<?= $index ?>" data-title="Ảnh mô tả">
                            <img src="<?= $post['image_url'] ?>" alt="Thumbnail" style="width: 200px;">
                        </a>
                        <div class="image-overlay">
                            <i class="fa-regular fa-images"></i> <?= $post['total_images'] ?>
                        </div>
                    </div>
                </li>
                <li>
                    <div>
                        <a href="/Datn/views/detail-post.view.php?post_id=<?= $post['post_id'] ?>&source=search" class="text-dark">
                            <h5><?= $post['title'] ?></h5>
                        </a>
                        <ul class="text-muted">
                            <li><i class="fa-solid fa-user-tie text-muted"></i> <?= $post['name'] ?></li>
                            <li class="post-time"><i class="far fa-clock me-1 text-muted"></i> <?= $date['day'] . '-' . $date['month'] . '-' . $date['year'] ?></li>
                            <li class="post-location"><i class="fa-solid fa-location-dot text-muted"></i> <?= 'P.' . $post['ward_name'] . ', Q.' . $post['district_name'] . ', Hà Nội' ?></li>
                        </ul>
                    </div>
                    <div class="mt-2">
                        <ul>
                            <li class="post-price">
                                <h5 class="text-danger">
                                    <?= strlen($post['price']) > 3 ? ($post['price'] / 1000) . ' tỷ' : $post['price'] . ' triệu' ?>
                                </h5>
                            </li>
                            <li class="post-save">
                                <?php if (isset($_SESSION['user_id'])): ?>
                                    <form action="/Datn/controllers/save-post.controller.php?post_id=<?= $post['post_id'] ?>" method="post">
                                        <?php if ($post['user_sid'] == $_SESSION['user_id'] and $post['post_sid'] == $post['post_id']): ?>
                                            <button class="btn btn-success">
                                                <i class="fa-regular fa-bookmark text-light"></i> Bỏ lưu tin
                                            </button>
                                        <?php else: ?>
                                            <button class="btn btn-outline-success">
                                                <i class="fa-solid fa-bookmark"></i> Lưu tin
                                            </button>
                                        <?php endif ?>
                                    </form>
                                <?php endif ?>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            var initialProperties = $('#properties').html();
            $('#search').keyup(function(e) {
                var search = $('#search').val();
                if (search.length > 0) {
                    $.ajax({
                        url: '/Datn/controllers/get_searchs.php',
                        type: 'POST',
                        data: {
                            search: search
                        },
                        success: function(response) {
                            $('#result').html(response).show();
                            $('#properties').html("");
                        },
                    });
                } else {
                    $('#result').html('').hide();
                    $('#properties').html(initialProperties);
                }
            });
        });

        $(document).ready(function() {
            $('.district_id').change(function(e) {
                var district_id = $('.district_id').val().trim();
                var ward_id = $('.ward_id').val().trim();
                $.ajax({
                    url: '../controllers/get_wards.php',
                    type: 'POST',
                    data: {
                        district_id: district_id,
                        ward_id: ward_id
                    },
                    success: function(response) {
                        console.log(district_id);
                        $('.ward_id').html('<option value="">--Chọn Phường--</option>');
                        $('.ward_id').append(response);

                        // if (selectedWardId) {
                        //     $('.ward_id').val(selectedWardId);
                        // }
                    }
                });
            });
        });
    </script>
<?php endforeach;
require 'partials/footer.php';
