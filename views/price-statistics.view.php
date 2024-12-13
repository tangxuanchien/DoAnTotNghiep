<?php
session_start();
require '../function.php';
require '../models/Database.php';
require '../controllers/price-statistics.controller.php';

$db = new Database();
$title = "Thống kê giá bán";
if (!isset($_SESSION['name'])) {
	$login = 'Đăng nhập';
} else $login = $_SESSION['name'];

if (isset($ward['ward_name'])) {
	$banner = "Thống kê giá bán của phường " . $ward['ward_name'];
} else $banner = 'Thống kê giá bán';

if (!isset($ward['district_id'])) {
	$ward['district_id'] = 0;
}

$wards = $db->query("
SELECT * FROM `wards` 
WHERE district_id = :district_id 
ORDER BY ward_id", [
	'district_id' => $ward['district_id']
])->fetchAll(PDO::FETCH_ASSOC);

require 'partials/header.php';

require 'partials/navigation.php';

require 'partials/banner.php';

?>
<nav aria-label="breadcrumb" style="margin-left:120px">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/Datn">Trang chủ</a></li>
		<li class="breadcrumb-item active" aria-current="page">Thống kê giá bán</li>
	</ol>
</nav>
<form action="/Datn/views/price-statistics.view.php" method="post">
	<div class="select-ward">
		<select class="type_id form-select w-auto" name="type" required>
			<option value="">--Chọn Loại--</option>
			<option value="home" <?= $type == 'home' ? 'selected' : '' ?>>Nhà ở</option>
			<option value="apartment" <?= $type == 'apartment' ? 'selected' : '' ?>>Chung cư/Căn hộ</option>
			<option value="land" <?= $type == 'land' ? 'selected' : '' ?>>Đất</option>
		</select>
		<select class="district_id form-select w-auto" name="district_id" required>
			<option value="">--Chọn Quận--</option>
			<?php foreach ($districts as $district): ?>
				<option value="<?= $district['district_id'] ?>" <?= isset($_POST['district_id']) && $_POST['district_id'] == $district['district_id'] ? 'selected' : '' ?>>
					<?= $district['district_name'] ?>
				</option>
			<?php endforeach ?>
		</select>
		<select class="ward_id form-select w-auto" name="ward_id" required>
			<option value="">--Chọn Phường--</option>
			<?php if (isset($ward['ward_id'])): ?>
				<option value="<?= $ward['ward_id'] ?>" selected><?= $ward['ward_name'] ?></option>
			<?php endif; ?>
		</select>
		<button type="submit" class="btn btn-success">Áp dụng</button>
	</div>
</form>

<div class="statistic-label">
	<?php if ($statistic_of_ward['total'] != 0): ?>
		<ul>
			<li>
				Giá bán trung bình của phường
				<div class="statistic-number">
					<?= $statistic_of_ward['avg_ward'] ?> triệu/m<sup>2</sup>
				</div>
			</li>
			<li class="border-left">
				Tổng số bài đăng của phường
				<div class="statistic-number">
					<?= $statistic_of_ward['total'] ?>
				</div>
			</li>
			<li class="border-left">
				Giá bán trung bình của quận
				<div class="statistic-number">
					<?= $statistic_of_district['avg_district'] ?> triệu/m<sup>2</sup>
				</div>
			</li>
		</ul>
	<?php else: ?>
		<h2 class="text-danger"><i class="fa-solid fa-xmark text-danger"></i> Chưa có bất động sản nào được rao bán ở đây</h2>
	<?php endif ?>
</div>
<?php if (isset($statistic_of_district) && isset($ward['district_name'])): ?>
	<div class="price-range-container">
		<div class="price-info">
			<span id="min-label"><?= $statistic_of_district['min_district'] ?></span>
			<span id="current-label"><?= $statistic_of_district['avg_district'] ?></span>
			<span id="max-label"><?= $statistic_of_district['max_district'] ?></span>
		</div>
		<div class="range-bar">
			<div class="track"></div>
			<div class="highlight" id="highlight-bar"></div>
			<div class="marker min-marker"></div>
			<div class="marker max-marker"></div>
		</div>
		<p class="range-description">Khoảng giá phổ biến ở quận <b><?= $ward['district_name'] ?></b></p>
	</div>
<?php endif ?>
<div class="statistic-label">
	<?php if ($statistic_of_ward['total'] > 0): ?>
		<form action="/Datn/views/search-post.view.php?page_number=1&source=statistic" class="text-dark fs-5" method="post">
			<button type="submit" class="btn fs-4">
				Xem tất cả bài đăng ở phường <?= $ward['ward_name'] ?> <i class="fa-solid fa-angles-right"></i>
			</button>
			<input type="hidden" value="<?= $ward['ward_id'] ?>" name="ward_id">
		</form>
	<?php endif ?>
</div>
<div class="chart">
	<h2>Biểu đồ giá các phường <?= !isset($ward['district_name']) ? '' : 'thuộc quận ' . $ward['district_name'] ?></h2>
	<canvas id="wardChart"></canvas>
	<?php if (isset($ward['district_name'])): ?>
		<form action="/Datn/views/search-post.view.php?page_number=1&source=statistic" class="text-dark fs-5" method="post">
			<button type="submit" class="btn fs-4">
				Xem tất cả bài đăng ở quận <?= $ward['district_name'] ?> <i class="fa-solid fa-angles-right"></i>
			</button>
			<input type="hidden" value="<?= $ward['district_id'] ?>" name="district_id">
		</form>
	<?php endif ?>
	<h2 class="mt-5">Biểu đồ giá các quận thuộc thủ đô Hà Nội</h2>
	<canvas id="districtChart"></canvas>
	<a href="/Datn/views/all-posts.view.php/all?page_number=1" class="fs-4 mt-3">
		Xem tất cả bài đăng ở Hà Nội <i class="fa-solid fa-angles-right"></i>
	</a>
</div>
<script>
	var backgroundColors = <?= json_encode($backgroundColors); ?>;
	var borderColors = <?= json_encode($borderColors); ?>;

	var xDistricts = <?= json_encode(array_column($districts, 'district_name')); ?>;
	var yDistricts = <?= json_encode(array_column($avg_districts, 'avg_district')) ?>;

	var xWards = <?= json_encode(array_column($wards, 'ward_name')); ?>;
	var yWards = <?= json_encode(array_column($avg_wards, 'avg_ward')) ?>;


	var ctxDistricts = document.getElementById('districtChart').getContext('2d');
	var myChart = new Chart(ctxDistricts, {
		type: 'bar',
		data: {
			labels: xDistricts,
			datasets: [{
				label: 'Giá nhà đất (triệu VNĐ/m2)',
				data: yDistricts,
				backgroundColor: backgroundColors,
				borderColor: borderColors,
				borderWidth: 1
			}]
		},
		options: {
			scales: {
				y: {
					beginAtZero: true
				}
			}
		}
	});

	var ctxWards = document.getElementById('wardChart').getContext('2d');
	var myChart = new Chart(ctxWards, {
		type: 'bar',
		data: {
			labels: xWards,
			datasets: [{
				label: 'Giá nhà đất (triệu VNĐ/m2)',
				data: yWards,
				backgroundColor: backgroundColors,
				borderColor: borderColors,
				borderWidth: 1
			}]
		},
		options: {
			scales: {
				y: {
					beginAtZero: true
				}
			}
		}
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
					console.log(district_id)
					$('.ward_id').html('<option value="">--Chọn Phường--</option>');
					$('.ward_id').append(response);
				}
			});
		});
	});
</script>

