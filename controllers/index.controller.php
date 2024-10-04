<?php
require 'models/Database.php';
require 'function.php';
$method = $_SESSION['method'];
$id = $_SESSION['id'];
$db = new Database();
$propertys = $db->query("SELECT * FROM `properties` LIMIT 6")->fetchAll(PDO::FETCH_ASSOC);
?>

<style>
    a {
        text-decoration: none;
        color: black;
    }

    td:hover {
        background-color: #e0e0e0;
    }

    
</style>

<form class="d-flex my-3" role="search">
    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Tìm kiếm" id="search">
    <button class="btn btn-outline-success" id="search-btn" type="button"><i class="fa-solid fa-magnifying-glass"></i></button>
</form>

<form action="/Datn/views/create.post.view.php" method="post">
    <button type="submit">Tạo bài đăng mới</button>
</form>

<div id="result">
    <table class="table table-bordered">
        <tbody>
            <script>
                $(document).ready(function() {
                    var initialProperties = $('#properties').html();
                    $('#search').keyup(function(e) {
                        var search = $('#search').val();
                        if (search.length > 0) {
                            $.ajax({
                                url: '../Datn/controllers/get_searchs.php',
                                type: 'POST',
                                data: {
                                    search: search
                                },
                                success: function(response) {
                                    $('#result').html(response);
                                    $('#properties').html("");
                                },
                            });
                        } else {
                            $('#result').html('');
                            $('#properties').html(initialProperties);
                        }
                    });
                });
            </script>
        </tbody>
    </table>
</div>
<div id="div-lists">
    <ul>
        <?php foreach ($propertys as $property) : ?>
            <?php
            $ward_id = $property['ward_id'];
            $property_id = $property['property_id'];
            $wards = $db->query("SELECT * FROM `wards` where ward_id = $ward_id")->fetchAll(PDO::FETCH_ASSOC);
            $images = $db->query("SELECT * FROM `property_images` where property_id = $property_id")->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <?php foreach ($images as $image) : ?>
                <?php foreach ($wards as $ward) : ?>
                    <?php
                    $district_id = $ward['district_id'];
                    $districts = $db->query("SELECT * FROM `districts` WHERE district_id = $district_id")->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                    <?php foreach ($districts as $district) : ?>
                        <li>
                            <div class="card mx-3 mt-3" style="width: 21rem;">
                                <div>
                                    <img src="<?= $image['image_url'] ?>" class="card-img-top" alt="image_house">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"><?= strlen($property['title']) > 80 ? substr_replace($property['title'], ' ...', 80) : $property['title'] ?></h5>
                                    <p>
                                        <i class="fa-solid fa-bed"></i> <?= $property['num_bedrooms'] . " ngủ" ?>
                                        <i class="fa-solid fa-bath" style="margin-left: 10px;"></i> <?= $property['num_bathrooms'] . " tắm" ?>
                                        <i class="fa-solid fa-chart-line" style="margin-left: 10px;"></i> <?= $property['area'] . " m<sup>2</sup>" ?>
                                    </p>
                                    <p class="card-description"><i class="fa-solid fa-location-dot"></i> <?= $ward['ward_name'] . ", " . $district['district_name'] ?></p>
                                    <a href="/Datn/views/detail.property.view.php?id=<?= $property['property_id'] ?>" class="btn btn-primary">Xem chi tiết</a>
                                </div>
                            </div>
                        </li>
                    <?php endforeach ?>
                <?php endforeach ?>
            <?php endforeach ?>
        <?php endforeach ?>
    </ul>
</div>