<?php
require '../models/Database.php';

$user_id = $_SESSION['user_id'];
$limit = 8;

$status = 'available';
$db = new Database();
$posts = $db->query("
SELECT *, (SELECT COUNT(*) FROM property_images WHERE property_id = pr.property_id) AS total_images
FROM `posts` p
INNER JOIN properties pr on pr.property_id = p.property_id
INNER JOIN users u on u.user_id = p.user_id
INNER JOIN wards w on w.ward_id = pr.ward_id
INNER JOIN districts d on d.district_id = w.district_id 
LEFT JOIN post_saves ps on ps.post_sid = p.post_id
INNER JOIN property_images i on i.property_id = pr.property_id
WHERE p.status = :status
AND pr.title like '%$search%'
AND i.image_id = (
SELECT MIN(image_id)
FROM property_images
WHERE property_id = pr.property_id)
ORDER BY p.post_id
LIMIT $limit", [
    'status' => $status
])->fetchAll(PDO::FETCH_ASSOC);

$post_saves = $db->query("
SELECT *
FROM `post_saves`
WHERE user_sid = :user_sid", [
    'user_sid' => $user_id
])->fetchAll(PDO::FETCH_ASSOC);
