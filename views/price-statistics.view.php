<?php
session_start();
require '../function.php';

$title = "Thống kê giá bán";
$banner = "Thống kê giá bán";
$login = check_login($_SESSION['name']);

require 'partials/header.php';

require 'partials/navigation.php';

require 'partials/banner.php';


 
$test = array(
	array("label"=> "Phú Thượng", "y"=> 51),
	array("label"=> "Lạc Long Quân", "y"=> 41),
	array("label"=> "Kumar Sangakkara", "y"=> 38),
	array("label"=> "Jacques Kallis", "y"=> 45),
	array("label"=> "Mahela Jayawardene", "y"=> 34),
	array("label"=> "Hashim Amla", "y"=> 28),
	array("label"=> "Brian Lara", "y"=> 34),
	array("label"=> "Virat Kohli", "y"=> 20),
	array("label"=> "Rahul Dravid", "y"=> 36),
	array("label"=> "AB de Villiers", "y"=> 21)
);
 
$odi = array(
	array("label"=> "Phú Thượng", "y"=> 49),
	array("label"=> "Lạc Long Quân", "y"=> 30),
	array("label"=> "Kumar Sangakkara", "y"=> 25),
	array("label"=> "Jacques Kallis", "y"=> 17),
	array("label"=> "Mahela Jayawardene", "y"=> 19),
	array("label"=> "Hashim Amla", "y"=> 26),
	array("label"=> "Brian Lara", "y"=> 19),
	array("label"=> "Virat Kohli", "y"=> 32),
	array("label"=> "Rahul Dravid", "y"=> 12),
	array("label"=> "AB de Villiers", "y"=> 25)
);
 
$t20 = array(
	array("label"=> "Phú Thượng", "y"=> 0),
	array("label"=> "Lạc Long Quân", "y"=> 0),
	array("label"=> "Kumar Sangakkara", "y"=> 0),
	array("label"=> "Jacques Kallis", "y"=> 0),
	array("label"=> "Mahela Jayawardene", "y"=> 1),
	array("label"=> "Hashim Amla", "y"=> 0),
	array("label"=> "Brian Lara", "y"=> 0),
	array("label"=> "Virat Kohli", "y"=> 0),
	array("label"=> "Rahul Dravid", "y"=> 0),
	array("label"=> "AB de Villiers", "y"=> 0)
);
	
?>
<!DOCTYPE HTML>
<html>
<head>  
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: true,
	theme: "light1", // "light1", "light2", "dark1", "dark2"
	title:{
		text: "Bieu do thong ke gia quan Tay Ho"
	},
	axisX:{
		reversed: true
	},
	axisY:{
		includeZero: true
	},
	toolTip:{
		shared: true
	},
	data: [{
		type: "stackedBar",
		name: "Test",
		dataPoints: <?php echo json_encode($test, JSON_NUMERIC_CHECK); ?>
	},{
		type: "stackedBar",
		name: "ODI",
		dataPoints: <?php echo json_encode($odi, JSON_NUMERIC_CHECK); ?>
	},{
		type: "stackedBar",
		name: "T20",
		indexLabel: "#total",
		indexLabelPlacement: "outside",
		indexLabelFontSize: 15,
		indexLabelFontWeight: "bold",
		dataPoints: <?php echo json_encode($t20, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
</body>
</html>   

<?php
require 'partials/footer.php';