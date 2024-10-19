<?php
session_start();
require '../function.php';

$title = "Thống kê giá bán";
$banner = "Thống kê giá bán";
$login = check_login($_SESSION['name']);

require 'partials/header.php';

require 'partials/navigation.php';

require 'partials/banner.php';

?>

<body>
	<canvas id="myChart"></canvas>
	<script>
		var xValues = ['Hai Bà Trưng', 'Thanh Xuân', 'Nam Từ Liêm', 'Bắc Từ Liêm'];
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
	</script>
</body>

<?php
require 'partials/footer.php';
