<?php
require '../models/Database.php';

$id = $_GET['id'];
$page_number = $_GET['page_number'];
$limit = 5;

$db = new Database();
$properties = $db->query("SELECT * FROM `properties` WHERE property_id >= $id LIMIT $limit")->fetchAll(PDO::FETCH_ASSOC);
$total_properties = $db->query("SELECT Count(property_id) FROM `properties`")->fetch(PDO::FETCH_ASSOC);
$residual_page_number = ((int)$total_properties["Count(property_id)"] % $limit);
$last_page_number = ($residual_page_number === 0) ? ((int)$total_properties["Count(property_id)"] / $limit) : (((int)$total_properties["Count(property_id)"] - $residual_page_number) / $limit) + 1;
foreach ($properties as $property):
    $property_id = $property['property_id'];
    $date = date_parse($property['created_at']);
    $images = $db->query("SELECT * FROM `property_images` where property_id = $property_id")->fetchAll(PDO::FETCH_ASSOC);

    foreach ($images as $image):
?>
        <div class="property-lists">
            <ul>
                <li>
                    <img src="<?= $image['image_url'] ?>" alt="image_property" width="150px">
                </li>
                <li>
                    <div>
                        <h5><?= $property['title'] ?></h5>
                        <p>Ngày đăng: <?= $date['day'] . '-' . $date['month'] . '-' . $date['year'] ?></p>
                    </div>
                </li>
            </ul>
        </div>
<?php
    endforeach;
endforeach ?>
<div class="page-numbers">
    <ul>
        <li><a href="/Datn/views/property-all.view.php?page_number=<?= $page_number - 1 ?>&id=1"><i class="fa-solid fa-angles-left"></i> Trước</a></li>

        <li><a href="/Datn/views/property-all.view.php?page_number=<?= $page_number ?>&id=<?= $property_id ?>"><?= $page_number ?></a></li>
        <li><a href="/Datn/views/property-all.view.php?page_number=<?= $page_number + 1 ?>&id=<?= $property_id + 1 ?>"><?= $page_number + 1 ?></a></li>
        <li><a href="/Datn/views/property-all.view.php?page_number=<?= $page_number + 2 ?>&id=<?= $property_id + 2 ?>"><?= $page_number + 2 ?></a></li>
        <li>...</li>
        <li><a href="#"><?= $last_page_number ?></a></li>
        <li><a href="/Datn/views/property-all.view.php?page_number=<?= $page_number + 1 ?>&id=1">Sau <i class="fa-solid fa-angles-right"></i></a></li>
    </ul>
</div>