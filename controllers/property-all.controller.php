<?php
require '../models/Database.php';

$page_number = $_GET['page_number'];
$limit = 3;
if ($page_number == 1) {
    $offset = 0;
} else
    $offset = $limit * ($page_number - 1);

function checkpagenumber($condition_a, $condition_b, $result_a, $result_b)
{
    if ($condition_a == $condition_b) {
        return $result_a;
    } else
        return $result_b;
}

$db = new Database();
$properties = $db->query("SELECT * FROM `properties` LIMIT $limit OFFSET $offset")->fetchAll(PDO::FETCH_ASSOC);
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
        <li>
            <a href="<?= checkpagenumber($page_number, 1, '', '/Datn/views/property-all.view.php?page_number=' . ($page_number - 1)) ?>" class="<?= checkpagenumber($page_number, 1, 'a-inactive', '') ?>">
                <i class="fa-solid fa-angles-left"></i> Trước
            </a>
        </li>
        <?php if ($page_number > 2) : ?>
            <li><a href="/Datn/views/property-all.view.php?page_number=1">1</li>
            <li>...</li>
        <?php endif ?>
        <li class='page-current'>
            <a href="/Datn/views/property-all.view.php?page_number=<?= $page_number ?>"><?= $page_number ?></a>
        </li>
        <li>
            <a href="/Datn/views/property-all.view.php?page_number=<?= $page_number + 1 ?>"><?= $page_number + 1 ?></a>
        </li>
        <li>
            <a href="/Datn/views/property-all.view.php?page_number=<?= $page_number + 2 ?>"><?= $page_number + 2 ?></a>
        </li>
        <?php if (($page_number + 2) < $last_page_number) : ?>
            <li>...</li>
            <li>
                <a href="#"><?= $last_page_number ?></a>
            </li>
        <?php endif ?>
        <li>
            <a href="/Datn/views/property-all.view.php?page_number=<?= $page_number + 1 ?>">Sau <i class="fa-solid fa-angles-right"></i></a>
        </li>
    </ul>
</div>