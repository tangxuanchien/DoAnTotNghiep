<?php
require 'routes.php';
session_start();

$title = "Trang chủ";
$banner = "Bài đăng nổi bật";

if (!isset($_SESSION['name'])) {
    $login = 'Đăng nhập';
} else $login = $_SESSION['name'];

require 'partials/header.php';

require 'partials/navigation.php';

require 'controllers/index.controller.php';

?>
<div class="container-search">
    <h1 class="text-light">Chào mừng bạn tới với HANOIHOME <i class="fa-solid fa-handshake-simple text-light"></i></h1>
    <h4 class="mt-5 text-light">TÌM KIẾM THEO TỪ KHÓA</h4>
    <div class="search">
        <form action="/Datn/views/search-post.view.php?page_number=1" method="post" class="d-flex my-3" role="search">
            <input class="form-control me-2" type="search" placeholder="Tìm kiếm theo tiêu đề" aria-label="Tìm kiếm" name="search" id="search">
            <button class="btn btn-light" id="search-btn" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
    </div>
    <h4 class="mt-5 text-light">TÌM KIẾM THEO BỘ LỌC</h4>
    <form action="/Datn/views/search-post.view.php?page_number=1" method="post">
    <div class="select-ward-index">
        <select class="type_id form-select w-auto" name="type">
            <option value="">--Chọn Loại hình--</option>
            <option value="home">Nhà ở</option>
            <option value="apartment">Chung cư/Căn hộ</option>
            <option value="land">Đất</option>
        </select>
        <select class="district_id form-select w-auto" name="district_id">
            <option value="">--Chọn Quận--</option>
            <?php foreach ($districts as $district): ?>
                <option value="<?= $district['district_id'] ?>">
                    <?= $district['district_name'] ?>
                </option>
            <?php endforeach ?>
        </select>
        <select class="ward_id form-select w-auto" name="ward_id">
            <option value="">--Chọn Phường--</option>
        </select>
        <button type="submit" class="btn">Áp dụng</button>
    </div>
    <div id="result" class="search-result"></div>
    </form>
</div>
<?php
require 'partials/banner.php';
?>
<div class="div-lists" id="div-lists">
    <ul>
        <?php foreach ($posts as $index => $post) : ?>
            <li>
                <div class="card mx-3 mt-3 index-card">
                    <div>
                        <a href="<?= $post['image_url'] ?>" data-lightbox="image_property_<?= $index ?>" data-title="Ảnh mô tả">
                            <img src="<?= $post['image_url'] ?>" alt="Thumbnail" class="card-img-top">
                        </a>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?= strlen($post['title']) > 80 ? substr_replace($post['title'], ' ...', 80) : $post['title'] ?></h5>
                        <p>
                            <i class="fa-solid fa-bed"></i> <?= $post['num_bedrooms'] . " ngủ" ?>
                            <i class="fa-solid fa-bath" style="margin-left: 10px;"></i> <?= $post['num_bathrooms'] . " tắm" ?>
                            <i class="fa-solid fa-chart-line" style="margin-left: 10px;"></i> <?= $post['area'] . " m<sup>2</sup>" ?>
                        </p>
                        <p class="card-description"><i class="fa-solid fa-location-dot"></i> <?= 'P. ' . $post['ward_name'] . ", Q. " . $post['district_name'] ?></p>
                        <p><i class="fa-solid fa-user-tie"></i> <?= $post['name'] ?></p>
                        <a href="/Datn/views/detail-post.view.php?post_id=<?= $post['post_id'] ?>" class="btn btn-primary">Xem chi tiết</a>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
<div class="btn-view-all">
    <form action="/Datn/views/all-posts.view.php?page_number=1" method="post">
        <button type="submit" class="btn btn-dark">Xem tất cả bài đăng <i class="fa-solid fa-arrow-right text-light"></i></button>
    </form>
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
				url: '/Datn/controllers/get_wards.php',
				type: 'POST',
				data: {
					district_id: district_id,
					ward_id: ward_id
				},
				success: function(response) {
					$('.ward_id').html('<option value="">--Chọn Phường--</option>');
					$('.ward_id').append(response);

					// if (selectedWardId) {
					// 	$('.ward_id').val(selectedWardId);
					// }
				}
			});
		});
	});
</script>
<?php
require 'partials/footer.php';
