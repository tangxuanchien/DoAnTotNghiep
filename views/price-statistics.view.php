<?php
session_start();
require '../function.php';
require '../models/Database.php';

$ward_id = trim($_POST['ward_id']);

$title = "Thống kê giá bán";
$login = check_login($_SESSION['name']);
if (isset($ward['ward_name'])) {
	$banner = "Thống kê giá bán của phường " . $ward['ward_name'];
} else $banner = '';

$db = new Database();
$districts = $db->query("SELECT * FROM `districts`")->fetchAll(PDO::FETCH_ASSOC);

$ward = $db->query("SELECT ward_name, district_id FROM `wards` where ward_id = :ward_id", [
	'ward_id' => $ward_id
])->fetch(PDO::FETCH_ASSOC);


$types = $db->query("select * from `property_types`")->fetchAll(PDO::FETCH_ASSOC);

$statistic_of_ward = $db->query("Select count(*) AS total, REPLACE(CAST(avg(price_per_m2) AS DECIMAL(5, 1)), '.', ',') AS avg_ward from `properties` where ward_id = :ward_id", [
	'ward_id' => $ward_id
])->fetch(PDO::FETCH_ASSOC);

$statistic_of_district = $db->query("SELECT CAST(avg(price_per_m2) AS DECIMAL(5, 0)) AS avg_district FROM `properties` WHERE ward_id IN (SELECT ward_id FROM `wards` WHERE district_id = :district_id)", [
	'district_id' => $ward['district_id']
])->fetch(PDO::FETCH_ASSOC);

$statistic_of_districts = $db->query("
SELECT 
    CAST(AVG(properties.price_per_m2) AS DECIMAL(5,1)) AS avg_district
FROM 
    properties
INNER JOIN wards ON properties.ward_id = wards.ward_id
INNER JOIN districts ON wards.district_id = districts.district_id
GROUP BY districts.district_id")->fetchAll(PDO::FETCH_ASSOC);
$yValues_statistic = array_map(function ($row) {
	return floatval($row['avg_district']);
}, $statistic_of_districts);

$ward_price = floatval(str_replace(',', '.', $statistic_of_ward['avg_ward']));
$price_difference = $ward_price - $statistic_of_district['avg_district'];
$backgroundColors = randomRGBAColors(count($districts));
$borderColors = borderColors(count($districts));

require 'partials/header.php';

require 'partials/navigation.php';

require 'partials/banner.php';

?>
<form action="/Datn/views/price-statistics.view.php?ward_id=<?= $ward_id ?>" method="post">
	<div class="select-ward">
		<select class="type_id" name="type_id">
			<option value="">--Chọn loại hình--</option>
			<?php
			foreach ($types as $type):
			?>
				<option value="<?= $type['type_id'] ?>" <?= isset($_POST['type_id']) && $_POST['type_id'] == $type['type_id'] ? 'selected' : '' ?>>
					<?= $type['type_name'] ?>
				</option>
			<?php endforeach ?>
		</select>
		<select class="district_id" name="district_id">
			<option value="">--Chọn Quận--</option>
			<?php
			foreach ($districts as $district):
			?>
				<option value="<?= $district['district_id'] ?>" <?= isset($_POST['district_id']) && $_POST['district_id'] == $district['district_id'] ? 'selected' : '' ?>>
					<?= $district['district_name'] ?>
				</option>
			<?php endforeach ?>
		</select>
		<select class="ward_id" name="ward_id">
			<option value="">--Chọn Phường--</option>
		</select>
		<button type="submit">Áp dụng</button>
</form>

</div>
<div class="statistic-label">
	<ul>
		<li>
			Giá bán trung bình
			<div class="statistic-number">
				<?= $statistic_of_ward['avg_ward'] ?>tr/m2
			</div>
		</li>
		<li class="border-left">
			Tổng số bất động sản đang bán
			<div class="statistic-number">
				<?= $statistic_of_ward['total'] ?>
			</div>
		</li>
		<li class="border-left">
			So với giá của quận
			<div class="statistic-number">
				<?php if ($price_difference > 0) : ?>
					+<?= $price_difference ?>tr/m2
				<?php else: ?>
					<?= $price_difference ?>tr/m2
				<?php endif ?>
			</div>
		</li>
	</ul>
</div>
<div class="mt-4">
	<h2>Giá bán trung bình các quận thuộc thủ đô Hà Nội</h2>
</div>
<div class="chart">
	<canvas id="districtChart"></canvas>
</div>
<div class="chart">
<canvas id="wardChart"></canvas>
</div>

<script>
	var backgroundColors = <?= json_encode($backgroundColors); ?>;
	var borderColors = <?= json_encode($borderColors); ?>;

	var xDistricts = <?= json_encode(array_column($districts, 'district_name')); ?>;
	var yDistricts = <?= json_encode($yValues_statistic) ?>;

	var xWards = <?= json_encode(array_column($districts, 'district_name')); ?>;
	var yWards = <?= json_encode($yValues_statistic) ?>;


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
