<?php
session_start();
require '../function.php';
require '../models/Database.php';

$title = "Thống kê giá bán";
$banner = "Thống kê giá bán";
$login = check_login($_SESSION['name']);
$db = new Database();
$districts = $db->query("SELECT * FROM `districts`")->fetchAll(PDO::FETCH_ASSOC);
$types = $db->query("select * from `property_types`")->fetchAll(PDO::FETCH_ASSOC);
$statistic_of_ward = $db->query("Select count(*) AS total, REPLACE(CAST(avg(price_per_m2) AS DECIMAL(5, 1)), '.', ',') AS avg_ward from `properties` where ward_id = :ward_id", [
	'ward_id' => 21
])->fetch(PDO::FETCH_ASSOC);
$statistic_of_district = $db->query("SELECT CAST(avg(price_per_m2) AS DECIMAL(5, 1)) AS avg_district FROM `properties` WHERE ward_id IN (SELECT ward_id FROM `wards` WHERE district_id = :district_id)", [
	'district_id' => 1
])->fetch(PDO::FETCH_ASSOC);

$ward_price = floatval(str_replace(',', '.', $statistic_of_ward['avg_ward']));


$price_difference = $ward_price - $statistic_of_district['avg_district'];

require 'partials/header.php';

require 'partials/navigation.php';

require 'partials/banner.php';

?>
<div class="select-ward">
	<select class="type_id" name="type_id">
		<option value="">--Chọn loại hình--</option>
		<?php
		foreach ($types as $type):
		?>
			<option value="<?= $type['type_id'] ?>"><?= $type['type_name'] ?></option>
		<?php endforeach ?>
	</select>
	<select class="district_id" name="district_id">
		<option value="">--Chọn Quận--</option>
		<?php
		foreach ($districts as $district):
		?>
			<option value="<?= $district['district_id'] ?>"><?= $district['district_name'] ?></option>
		<?php endforeach ?>
	</select>
	<select class="ward_id" name="ward_id">
		<option value="">--Chọn Phường--</option>
	</select>
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
					+<?= $price_difference ?>
				<?php else: ?>
					<?= $price_difference ?>
				<?php endif ?>
			</div>
		</li>
	</ul>
</div>
<div class="chart">
	<canvas id="myChart"></canvas>
</div>

<script>
	var xValues = ['Hai Bà Trưng', 'Thanh Xuân', 'Nam Từ Liêm', 'Bắc Từ Liêm', 'Tây Hồ', 'Cầu Giấy', 'Hoàng Mai', 'Long Biên', 'Hà Đông', 'Ba Đình', 'Hoàn Kiếm', 'Đống Đa'];
	var yValues = [1000, 1200, 900, 1500];
	var ctx = document.getElementById('myChart').getContext('2d');
	var myChart = new Chart(ctx, {
		type: 'bar',
		data: {
			labels: xValues,
			datasets: [{
				label: 'Giá nhà đất (VNĐ/m2)',
				data: yValues,
				backgroundColor: [
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
					'rgba(75, 192, 192, 0.2)'
				],
				borderColor: [
					'rgba(255, 99, 132, 1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)'
				],
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
			var district_id = $('.district_id').val();
			$.ajax({
				url: '../controllers/get_wards.php',
				type: 'POST',
				data: {
					district_id: district_id
				},
				success: function(response) {
					$('.ward_id').html('<option value="">--Chọn Phường--</option>');
					$('.ward_id').append(response);
				}
			});
		});
	});
</script>
<?php
require 'partials/footer.php';
