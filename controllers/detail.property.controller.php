<?php
$id = $_GET['id'];
require '../models/Database.php';
$db = new Database();
$property = $db->query("SELECT * FROM `properties` where property_id = $id")->fetch(PDO::FETCH_ASSOC);
?>
<div class="carousel slide container-detail" data-bs-ride="carousel" data-bs-interval="3000">
        <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
                <div class="carousel-item active">
                        <img src="/Datn/images/slide1.jpg" class="d-block w-100" alt="Banner 1">
                </div>
                <div class="carousel-item">
                        <img src="/Datn/images/slide2.jpg" class="d-block w-100" alt="Banner 2">
                </div>
                <div class="carousel-item">
                        <img src="/Datn/images/slide3.jpg" class="d-block w-100" alt="Banner 3">
                </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
        </button>
        <div>
                Tiêu đề bài đăng: <b><?= $property['title'] ?></b></br>
                Mô tả dự án: <b><?= $property['description'] ?></b></br>
                Giá bán: <b><?= $property['price'] ?>VND (Có thương lượng)</b></br>
                Diện tích: <b><?= $property['area'] ?></b></br>
                Giá bán trên mét vuông: <b><?= $property['price_per_m2'] ?>tr/m2</b></br>
                Phòng ngủ: <b><?= $property['num_bedrooms'] ?></b></br>
                Phòng vệ sinh: <b><?= $property['num_bathrooms'] ?></b>
        </div>
</div>