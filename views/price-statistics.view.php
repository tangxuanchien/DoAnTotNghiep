<?php
session_start();
require '../function.php';
require '../models/Database.php';

$db = new Database();
$ward_id = trim($_POST['ward_id']);
$title = "Thống kê giá bán";
$login = check_login($_SESSION['name']);

$districts = $db->query("SELECT * FROM `districts`")->fetchAll(PDO::FETCH_ASSOC);

$ward = $db->query("
SELECT * FROM `wards` w 
INNER JOIN districts d ON d.district_id = w.district_id 
WHERE ward_id = :ward_id", [
	'ward_id' => $ward_id
])->fetch(PDO::FETCH_ASSOC);

$wards = $db->query("SELECT * FROM `wards` WHERE district_id = :district_id", [
	'district_id' => $ward['district_id']
])->fetchAll(PDO::FETCH_ASSOC);

if (isset($ward['ward_name'])) {
	$banner = "Thống kê giá bán của phường " . $ward['ward_name'];
} else $banner = '';

$types = $db->query("select * from `property_types`")->fetchAll(PDO::FETCH_ASSOC);

$statistic_of_ward = $db->query("Select count(*) AS total, REPLACE(CAST(avg(price_per_m2) AS DECIMAL(5, 1)), '.', ',') AS avg_ward from `properties` where ward_id = :ward_id", [
	'ward_id' => $ward_id
])->fetch(PDO::FETCH_ASSOC);


$statistic_of_district = $db->query("SELECT CAST(avg(price_per_m2) AS DECIMAL(5, 0)) AS avg_district FROM `properties` WHERE ward_id IN (SELECT ward_id FROM `wards` WHERE district_id = :district_id)", [
	'district_id' => $ward['district_id']
])->fetch(PDO::FETCH_ASSOC);

$avg_wards = $db->query("
	SELECT 
	d.district_name, w.ward_id, w.ward_name, CAST(AVG(p.price_per_m2) AS DECIMAL(5,1)) AS avg_ward
	FROM 
	properties p
	INNER JOIN wards w ON p.ward_id = w.ward_id
	INNER JOIN districts d ON w.district_id = d.district_id
	WHERE d.district_id = :district_id
	GROUP BY w.ward_id", [
	'district_id' => $ward['district_id']
])->fetchAll(PDO::FETCH_ASSOC);


$avg_districts = $db->query("
	SELECT 
		CAST(AVG(properties.price_per_m2) AS DECIMAL(5,1)) AS avg_district
	FROM 
		properties
	INNER JOIN wards ON properties.ward_id = wards.ward_id
	INNER JOIN districts ON wards.district_id = districts.district_id
	GROUP BY districts.district_id")->fetchAll(PDO::FETCH_ASSOC);

$backgroundColors = randomRGBAColors(count($districts));
$borderColors = borderColors(count($districts));

require 'partials/header.php';

require 'partials/navigation.php';

require 'partials/banner.php';

?>
<form action="/Datn/views/price-statistics.view.php?ward_id=<?= $ward_id ?>" method="post">
	<div class="select-ward">
		<select class="type_id form-select w-auto" name="type_id">
			<option value="">--Chọn loại hình--</option>
			<?php foreach ($types as $type): ?>
				<option value="<?= $type['type_id'] ?>" <?= isset($_POST['type_id']) && $_POST['type_id'] == $type['type_id'] ? 'selected' : '' ?>>
					<?= $type['type_name'] ?>
				</option>
			<?php endforeach ?>
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
	<?php elseif ($_SERVER['QUERY_STRING'] != ""): ?>
		<h2 class="text-danger"><i class="fa-solid fa-xmark text-danger"></i> Chưa có bất động sản nào được rao bán ở đây</h2>
	<?php endif ?>
</div>
<div class="chart">
	<h2>Biểu đồ giá các quận thuộc thủ đô Hà Nội</h2>
	<canvas id="districtChart"></canvas>
</div>
<div class="chart">
	<h2>Biểu đồ giá <?= $_SERVER['QUERY_STRING'] == "" ? '' : 'các phường thuộc quận ' . $ward['district_name'] ?></h2>
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
