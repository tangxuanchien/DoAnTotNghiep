<?php
session_start();
require '../function.php';
require '../models/Database.php';
require '../controllers/price-statistics.controller.php';


$db = new Database();
$title = "Thống kê giá bán";
$login = check_login($_SESSION['name']);
$ward = $_SESSION['ward'];


if (isset($ward['ward_name'])) {
	$banner = "Thống kê giá bán của phường " . $ward['ward_name'];
} else $banner = '';

if (!isset($ward['district_id'])) {
	$ward['district_id'] = 0;
}

$wards = $db->query("
SELECT * FROM `wards` 
WHERE district_id = :district_id 
ORDER BY ward_id", [
	'district_id' => $ward['district_id']
])->fetchAll(PDO::FETCH_ASSOC);


$statistic_of_ward = $db->query("Select count(*) AS total, REPLACE(CAST(avg(price_per_m2) AS DECIMAL(5, 1)), '.', ',') AS avg_ward from `properties` where ward_id = :ward_id", [
	'ward_id' => $ward_id
])->fetch(PDO::FETCH_ASSOC);


$statistic_of_district = $db->query("SELECT CAST(avg(price_per_m2) AS DECIMAL(5, 0)) AS avg_district FROM `properties` WHERE ward_id IN (SELECT ward_id FROM `wards` WHERE district_id = :district_id)", [
	'district_id' => $ward['district_id']
])->fetch(PDO::FETCH_ASSOC);

require 'partials/header.php';

require 'partials/navigation.php';

require 'partials/banner.php';

?>
<form action="/Datn/views/price-statistics.view.php" method="post">
	<div class="select-ward">
		<select class="type_id form-select w-auto" name="type">
			<option value="">--Chọn Loại--</option>
			<option value="home" <?= $type == 'home' ? 'selected' : '' ?>>Nhà ở</option>
			<option value="apartment" <?= $type == 'apartment' ? 'selected' : '' ?>>Chung cư/Căn hộ</option>
			<option value="land" <?= $type == 'land' ? 'selected' : '' ?>>Đất</option>
		</select>
		<select class="district_id form-select w-auto" name="district_id">
			<option value="">--Chọn Quận--</option>
			<?php foreach ($districts as $district): ?>
				<option value="<?= $district['district_id'] ?>" <?= isset($_POST['district_id']) && $_POST['district_id'] == $district['district_id'] ? 'selected' : '' ?>>
					<?= $district['district_name'] ?>
				</option>
			<?php endforeach ?>
		</select>
		<select class="ward_id form-select w-auto" name="ward_id">
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
				Giá bán trung bình
				<div class="statistic-number">
					<?= $statistic_of_ward['avg_ward'] ?> triệu/m<sup>2</sup>
				</div>
			</li>
			<li class="border-left">
				Tổng số bài đăng
				<div class="statistic-number">
					<?= $statistic_of_ward['total'] ?>
				</div>
			</li>
			<li class="border-left">
				Giá bán trung bình của quận
				<div class="statistic-number">
					<?= $statistic_of_ward['avg_ward'] ?> triệu/m<sup>2</sup>
				</div>
			</li>
		</ul>
	<?php else: ?>
		<h2 class="text-danger"><i class="fa-solid fa-xmark text-danger"></i> Chưa có bất động sản nào được rao bán ở đây</h2>
	<?php endif ?>
</div>
<div class="chart">
	<h2>Biểu đồ giá các quận thuộc thủ đô Hà Nội</h2>
	<canvas id="districtChart"></canvas>
</div>
<div class="chart">
	<h2>Biểu đồ giá <?= !isset($ward['district_name']) ? '' : 'các phường thuộc quận ' . $ward['district_name'] ?></h2>
	<canvas id="wardChart"></canvas>
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
					console.log(response);
					$('.ward_id').html('<option value="">--Chọn Phường--</option>');
					$('.ward_id').append(response);

					if (selectedWardId) {
						$('.ward_id').val(selectedWardId);
					}
				}
			});
		});
	});
</script>
<?php
require 'partials/footer.php';
