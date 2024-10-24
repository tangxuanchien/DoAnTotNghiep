<?php
$id = $_GET['id'];
require '../models/Database.php';
$db = new Database();
$property = $db->query("SELECT * FROM `properties` where property_id = $id")->fetch(PDO::FETCH_ASSOC);
$location = $db->query("
SELECT w.ward_name, d.district_name, w.ward_id FROM `wards` w 
INNER JOIN districts d on d.district_id = w.district_id
where d.district_id = :district_id and w.ward_id = :ward_id", [
        'district_id' => 1,
        'ward_id' => 9
])->fetch(PDO::FETCH_ASSOC);
?>
<div class="position-relative">
        <div id="carouselAutoplaying" class="carousel slide container-detail" data-bs-ride="carousel" data-bs-interval="3000">
                <div class="carousel-inner">
                        <div class="carousel-indicators">
                                <button type="button" data-bs-target="#carouselAutoplaying" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#carouselAutoplaying" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#carouselAutoplaying" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-item active">
                                <img src="/Datn/images/slide1.jpg" class="d-block w-100" alt="Banner 1">
                        </div>
                        <div class="carousel-item">
                                <img src="/Datn/images/slide2.jpg" class="d-block w-100" alt="Banner 2">
                        </div>
                        <div class="carousel-item">
                                <img src="/Datn/images/slide3.jpg" class="d-block w-100" alt="Banner 3">
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselAutoplaying" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselAutoplaying" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                        </button>
                </div>
                <div class="mt-3">
                        <h4><?= $property['title'] ?></h4>
                        <i class="fa-solid fa-location-dot"></i> <?= 'Phường ' .$location['ward_name'] . ', Quận ' . $location['district_name']. ', TP.Hà Nội, Việt Nam' ?></br>
                        Diện tích: <b><?= $property['area'] ?></b></br>
                        Giá bán trên mét vuông: <b><?= $property['price_per_m2'] ?>tr/m2</b></br>
                        Phòng ngủ: <b><?= $property['num_bedrooms'] ?></b></br>
                        Phòng vệ sinh: <b><?= $property['num_bathrooms'] ?></b>Tiêu đề bài đăng: <b><?= $property['title'] ?></b></br>
                        Mô tả dự án: <b><?= $property['description'] ?></b></br>
                        Giá bán: <b><?= $property['price'] ?>VND (Có thương lượng)</b></br>
                        Diện tích: <b><?= $property['area'] ?></b></br>
                        Giá bán trên mét vuông: <b><?= $property['price_per_m2'] ?>tr/m2</b></br>
                        Phòng ngủ: <b><?= $property['num_bedrooms'] ?></b></br>
                        Phòng vệ sinh: <b><?= $property['num_bathrooms'] ?></b>Tiêu đề bài đăng: <b><?= $property['title'] ?></b></br>
                        Mô tả dự án: <b><?= $property['description'] ?></b></br>
                        Giá bán: <b><?= $property['price'] ?>VND (Có thương lượng)</b></br>
                        Diện tích: <b><?= $property['area'] ?></b></br>
                        Giá bán trên mét vuông: <b><?= $property['price_per_m2'] ?>tr/m2</b></br>
                        Phòng ngủ: <b><?= $property['num_bedrooms'] ?></b></br>
                        Phòng vệ sinh: <b><?= $property['num_bathrooms'] ?></b>Tiêu đề bài đăng: <b><?= $property['title'] ?></b></br>
                        Mô tả dự án: <b><?= $property['description'] ?></b></br>
                        Giá bán: <b><?= $property['price'] ?>VND (Có thương lượng)</b></br>
                        Diện tích: <b><?= $property['area'] ?></b></br>
                        Giá bán trên mét vuông: <b><?= $property['price_per_m2'] ?>tr/m2</b></br>
                        Phòng ngủ: <b><?= $property['num_bedrooms'] ?></b></br>
                        Phòng vệ sinh: <b><?= $property['num_bathrooms'] ?></b>Tiêu đề bài đăng: <b><?= $property['title'] ?></b></br>
                        Mô tả dự án: <b><?= $property['description'] ?></b></br>
                        Giá bán: <b><?= $property['price'] ?>VND (Có thương lượng)</b></br>
                        Diện tích: <b><?= $property['area'] ?></b></br>
                        Giá bán trên mét vuông: <b><?= $property['price_per_m2'] ?>tr/m2</b></br>
                        Phòng ngủ: <b><?= $property['num_bedrooms'] ?></b></br>
                        Phòng vệ sinh: <b><?= $property['num_bathrooms'] ?></b>Tiêu đề bài đăng: <b><?= $property['title'] ?></b></br>
                        Mô tả dự án: <b><?= $property['description'] ?></b></br>
                        Giá bán: <b><?= $property['price'] ?>VND (Có thương lượng)</b></br>
                        Diện tích: <b><?= $property['area'] ?></b></br>
                        Giá bán trên mét vuông: <b><?= $property['price_per_m2'] ?>tr/m2</b></br>
                        Phòng ngủ: <b><?= $property['num_bedrooms'] ?></b></br>
                        Phòng vệ sinh: <b><?= $property['num_bathrooms'] ?></b>Tiêu đề bài đăng: <b><?= $property['title'] ?></b></br>
                        Mô tả dự án: <b><?= $property['description'] ?></b></br>
                        Giá bán: <b><?= $property['price'] ?>VND (Có thương lượng)</b></br>
                        Diện tích: <b><?= $property['area'] ?></b></br>
                        Giá bán trên mét vuông: <b><?= $property['price_per_m2'] ?>tr/m2</b></br>
                        Phòng ngủ: <b><?= $property['num_bedrooms'] ?></b></br>
                        Phòng vệ sinh: <b><?= $property['num_bathrooms'] ?></b>Tiêu đề bài đăng: <b><?= $property['title'] ?></b></br>
                        Mô tả dự án: <b><?= $property['description'] ?></b></br>
                        Giá bán: <b><?= $property['price'] ?>VND (Có thương lượng)</b></br>
                        Diện tích: <b><?= $property['area'] ?></b></br>
                        Giá bán trên mét vuông: <b><?= $property['price_per_m2'] ?>tr/m2</b></br>
                        Phòng ngủ: <b><?= $property['num_bedrooms'] ?></b></br>
                        Phòng vệ sinh: <b><?= $property['num_bathrooms'] ?></b>Tiêu đề bài đăng: <b><?= $property['title'] ?></b></br>
                        Mô tả dự án: <b><?= $property['description'] ?></b></br>
                        Giá bán: <b><?= $property['price'] ?>VND (Có thương lượng)</b></br>
                        Diện tích: <b><?= $property['area'] ?></b></br>
                        Giá bán trên mét vuông: <b><?= $property['price_per_m2'] ?>tr/m2</b></br>
                        Phòng ngủ: <b><?= $property['num_bedrooms'] ?></b></br>
                        Phòng vệ sinh: <b><?= $property['num_bathrooms'] ?></b>
                </div>

        </div>
        <div class="detail-fixed">
                <div class="detail-left">
                        <div class="detail-info-seller">
                                <img src="/Datn/images/avatar.jpg" alt="avatar" style="border-radius: 50px; width: 80px; margin: 0 20px 10px 0; border: 2px solid black">
                                <b>HIEUTHUHAI</b> <i class="fa-solid fa-briefcase"></i></br>
                                <b>21 Tin đăng</b></br>
                                Mức độ uy tín: <b>5.0</b></br>
                                Sản phẩm: <b>Ai cũng phải bắt đầu từ rang cơm</b></br>
                                <button class="btn btn-primary mt-3">Liên hệ người bán</button>
                        </div>
                        <div class="detail-support">
                                <ul>
                                        <li><a href="http://"></a:href><i class="fa-solid fa-headset"></i> Cần hỗ trợ</a></li>
                                        <li><a href="http://"><i class="fa-solid fa-triangle-exclamation"></i> Báo cáo bài viết</a></li>
                                </ul>
                        </div>
                </div>
        </div>
</div>