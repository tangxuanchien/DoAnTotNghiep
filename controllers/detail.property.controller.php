<?php
$id = $_GET['id'];
require '../models/Database.php';
$db = new Database();
$property = $db->query("SELECT * FROM `properties` where property_id = $id")->fetch(PDO::FETCH_ASSOC); 
?>

<div>
        Tiêu đề bài đăng: <b><?= $property['title']?></b></br>
        Mô tả dự án: <b><?= $property['description']?></b></br>
        Giá bán: <b><?= $property['price']?>VND (Có thương lượng)</b></br>
        Diện tích: <b><?= $property['area']?></b></br>
        Giá bán trên mét vuông: <b><?= $property['price_per_m2']?>tr/m2</b></br>
        Phòng ngủ: <b><?= $property['num_bedrooms']?></b></br>
        Phòng vệ sinh: <b><?= $property['num_bathrooms']?></b>
</div>