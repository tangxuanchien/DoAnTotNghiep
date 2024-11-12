<?php
require 'models/Database.php';
require 'function.php';
$method = $_SESSION['method'];
// $id = $_SESSION['user_id'];
$db = new Database();
$posts = $db->query("
SELECT * FROM `posts` p
inner join properties pr on pr.property_id = p.property_id
inner join users u on u.user_id = p.user_id
inner join wards w on w.ward_id = pr.ward_id
inner join districts d on d.district_id = w.district_id 
inner join property_images i on i.property_id = pr.property_id 
LIMIT 6")->fetchAll(PDO::FETCH_ASSOC);
?>

<form class="d-flex my-3" role="search">
    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Tìm kiếm" id="search">
    <button class="btn btn-outline-dark" id="search-btn" type="button"><i class="fa-solid fa-magnifying-glass"></i></button>
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
<div class="div-lists">
    <div id="div-lists">
        <ul>
            <?php foreach ($posts as $index => $post) : ?>
                <li>
                    <div class="card mx-3 mt-3 index-card">
                        <div>
                            <a href="<?= $post['image_url'] ?>" data-lightbox="image_property_<?= $index ?>" data-title="Ảnh mô tả">
                                <img src="<?= $post['image_url'] ?>" alt="Thumbnail" class="card-img-top">
                            </a>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?= strlen($post['title']) > 80 ? substr_replace($post['title'], ' ...', 80) : $post['title'] ?></h5>
                            <p>
                                <i class="fa-solid fa-bed"></i> <?= $post['num_bedrooms'] . " ngủ" ?>
                                <i class="fa-solid fa-bath" style="margin-left: 10px;"></i> <?= $post['num_bathrooms'] . " tắm" ?>
                                <i class="fa-solid fa-chart-line" style="margin-left: 10px;"></i> <?= $post['area'] . " m<sup>2</sup>" ?>
                            </p>
                            <p class="card-description"><i class="fa-solid fa-location-dot"></i> <?= 'P. '.$post['ward_name'] . ", Q. " . $post['district_name'] ?></p>
                            <p><i class="fa-solid fa-user-tie"></i> <?= $post['name'] ?></p>
                            <a href="/Datn/views/detail.property.view.php?property_id=<?= $post['property_id'] ?>" class="btn btn-primary">Xem chi tiết</a>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>