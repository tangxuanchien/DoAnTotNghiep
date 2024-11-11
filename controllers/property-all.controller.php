<?php
require '../models/Database.php';

$page_number = $_GET['page_number'];
$limit = 10;
if ($page_number == 1) {
    $offset = 0;
} else {
    $offset = $limit * ($page_number - 1); }

$status = 'available';
$db = new Database();
$posts = $db->query("
SELECT *, (SELECT COUNT(*) FROM property_images WHERE property_id = pr.property_id) AS total_images
FROM `posts` p
INNER JOIN properties pr on pr.property_id = p.property_id
INNER JOIN users u on u.user_id = p.user_id
INNER JOIN wards w on w.ward_id = pr.ward_id
INNER JOIN districts d on d.district_id = w.district_id 
INNER JOIN property_images i on i.property_id = pr.property_id
WHERE p.status = :status
AND i.image_id = (
SELECT MIN(image_id)
FROM property_images
WHERE property_id = pr.property_id)
LIMIT $limit OFFSET $offset", [
    'status' => $status
])->fetchAll(PDO::FETCH_ASSOC);
$total_properties = $db->query("SELECT Count(property_id) FROM `properties`")->fetch(PDO::FETCH_ASSOC);

$residual_page_number = ((int)$total_properties["Count(property_id)"] % $limit);
$last_page_numbers = ($residual_page_number === 0) ? ((int)$total_properties["Count(property_id)"] / $limit) : (((int)$total_properties["Count(property_id)"] - $residual_page_number) / $limit) + 1;
$total_pages = range(1, $last_page_numbers);
