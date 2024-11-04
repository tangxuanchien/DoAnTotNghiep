<?php
require '../models/Database.php';

$page_number = $_GET['page_number'];
$limit = 10;
if ($page_number == 1) {
    $offset = 0;
} else
    $offset = $limit * ($page_number - 1);

$db = new Database();
$properties = $db->query("SELECT * FROM `properties` LIMIT $limit OFFSET $offset")->fetchAll(PDO::FETCH_ASSOC);
$total_properties = $db->query("SELECT Count(property_id) FROM `properties`")->fetch(PDO::FETCH_ASSOC);
$residual_page_number = ((int)$total_properties["Count(property_id)"] % $limit);
$last_page_numbers = ($residual_page_number === 0) ? ((int)$total_properties["Count(property_id)"] / $limit) : (((int)$total_properties["Count(property_id)"] - $residual_page_number) / $limit) + 1;
$total_pages = range(1, $last_page_numbers);

foreach ($properties as $property):
    $property_id = $property['property_id'];
    $date = date_parse($property['created_at']);
    $images = $db->query("SELECT * FROM `property_images` where property_id = $property_id")->fetchAll(PDO::FETCH_ASSOC);

    foreach ($images as $image):
?>
        <div class="post-lists">
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
        <li>
            <a href="<?= checkpagenumber($page_number, 1, '', '/Datn/views/property-all.view.php?page_number=' . ($page_number - 1)) ?>" style="color: <?= ($page_number == 1) ? 'gray' : 'black' ?>">
                <i class="fa-solid fa-angles-left" style="color: <?= ($page_number == 1) ? 'gray' : 'black' ?>"></i> Trước
            </a>
        </li>
        <?php
        foreach ($total_pages as $number) : ?>
            <li>
                <form action="/Datn/views/property-all.view.php?page_number=<?= $number ?>" method="post">
                    <button type="submit" style="background-color: <?= ($number == $page_number) ? '#6e9eeb' : 'white' ?>"><?= $number ?></button>  
                </form>
            </li>
        <?php endforeach ?>
        <li>
            <a href="<?= checkpagenumber($page_number, $last_page_numbers, '', '/Datn/views/property-all.view.php?page_number=' . ($page_number + 1)) ?>" style="color: <?= ($page_number == $last_page_numbers) ? 'gray' : 'black' ?>">
                Sau <i class="fa-solid fa-angles-right" style="color: <?= ($page_number == $last_page_numbers) ? 'gray' : 'black' ?>"></i>
            </a>
        </li>
    </ul>
</div>