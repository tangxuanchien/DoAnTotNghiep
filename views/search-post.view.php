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
if (!isset($_POST['price_range'])) {
    $_POST['price_range'] = '';
}
if (!isset($_POST['price_key_range'])) {
    $_POST['price_key_range'] = '';
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
                    <h4 class="text-danger"><?= count($posts) ?> kết quả tìm kiếm <?= ($_POST['price_key_range'] == '' or $_POST['price_key_range'] == '0 - 0') ? '' : '- Áp dụng khoảng giá: ' . $_POST['price_key_range'] . ' tỉ đồng' ?></h4>
                <?php endif; ?>
            </li>
            <li>
                <ul class="ul-filter">
                    <li>
                        <p><i class="fa-solid fa-sort"></i> Sắp xếp :</p>
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
                        <input type="hidden" value="" name="price_range" id="priceRange">
                        <input type="hidden" value="" name="price_key_range" id="priceKeyRange">
                    </li>
                    <li style="margin-left: 15px;">
                        <button class="btn btn-success" type="submit">Áp dụng</button>
                    </li>
                </ul>
            </li>
            <li>
                <div id="rubber-slider" style="margin: 50px; width:300px;"></div>
                <p>Khoảng giá đã chọn: <span id="rangeDisplay">0 - 100</span> tỉ đồng</p>
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
                            <h5>
                                <?php if ($post['authentic'] == 1): ?>
                                    <i class="fa-solid fa-circle-check text-success"></i>
                                <?php endif ?>
                                <?= $post['title'] ?>
                            </h5>
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
                                <ul>
                                    <li>
                                        <?php if ($post['status'] == 'available') {
                                            echo '<p class ="badge text-bg-primary text-wrap">Đang bán</p>';
                                        } elseif ($post['status'] == 'for_rent') {
                                            echo '<p class ="badge text-bg-warning text-wrap">Cho thuê</p>';
                                        } ?>
                                    </li>
                                    <li>
                                        <h5 class="text-danger">
                                            <?= strlen($post['price']) > 3 ? ($post['price'] / 1000) . ' tỷ' : $post['price'] . ' triệu' ?>
                                        </h5>
                                    </li>
                                </ul>
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
<?php endforeach; ?>
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
                }
            });
        });
    });

    const slider = document.getElementById('rubber-slider');
    const hiddenInput = document.getElementById('priceRange');
    const hiddenKeyInput = document.getElementById('priceKeyRange');
    noUiSlider.create(slider, {
        start: [0, 0],
        connect: true,
        range: {
            'min': 0,
            'max': 50
        },
        animate: true,
        animationDuration: 300,
    });
    const rangeDisplay = document.getElementById('rangeDisplay');
    slider.noUiSlider.on('update', function(values) {
        rangeDisplay.textContent = `${Math.round(values[0])} - ${Math.round(values[1])}`;
        hiddenInput.value = `${Math.round(values[0])}000 AND ${Math.round(values[1])}000`;
        hiddenKeyInput.value = `${Math.round(values[0])} - ${Math.round(values[1])}`;
    });
</script>

<?php
require 'partials/footer.php';
