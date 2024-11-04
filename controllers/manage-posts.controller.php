<?php
require '../models/Database.php';


$user_id = $_SESSION['id'];
$db = new Database();
$my_posts = $db->query("
SELECT *, (SELECT COUNT(*) FROM property_images WHERE property_id = pr.property_id) AS total_images
FROM `posts` p
INNER JOIN properties pr on pr.property_id = p.property_id
INNER JOIN users u on u.user_id = p.user_id
INNER JOIN wards w on w.ward_id = pr.ward_id
INNER JOIN districts d on d.district_id = w.district_id 
INNER JOIN property_images i on i.property_id = pr.property_id
WHERE u.user_id = :user_id
AND p.status = 'available'
AND i.image_id = (
SELECT MIN(image_id)
FROM property_images
WHERE property_id = pr.property_id)", [
    'user_id' => $user_id
])->fetchAll(PDO::FETCH_ASSOC);

$_SESSION['my_posts'] = $my_posts;
