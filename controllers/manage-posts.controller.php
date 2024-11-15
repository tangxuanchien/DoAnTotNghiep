<?php
require '../models/Database.php';

$user_id = $_SESSION['user_id'];
$db = new Database();

if(!isset($_SERVER['PATH_INFO'])){
    $_SERVER['PATH_INFO'] = '';
}

switch ($_SERVER['PATH_INFO']) {
    case '/available':
        $status = 'available';
        break;
    case '/for_rent':
        $status = 'for_rent';
        break;
    case '/hide':
        $status = 'hide';
        break;
    case '/sold':
        $status = 'sold';
        break;
    default:
        $status = 'available';
        break;
}

$my_posts = $db->query("
SELECT *, (SELECT COUNT(*) FROM property_images WHERE property_id = pr.property_id) AS total_images
FROM `posts` p
INNER JOIN properties pr on pr.property_id = p.property_id
INNER JOIN users u on u.user_id = p.user_id
INNER JOIN wards w on w.ward_id = pr.ward_id
INNER JOIN districts d on d.district_id = w.district_id 
INNER JOIN property_images i on i.property_id = pr.property_id
WHERE u.user_id = :user_id
AND p.status = :status
AND i.image_id = (
SELECT MIN(image_id)
FROM property_images
WHERE property_id = pr.property_id)
ORDER BY p.created_at DESC", [
    'user_id' => $user_id,
    'status' => $status
])->fetchAll(PDO::FETCH_ASSOC);

$post_saves = $db->query("
SELECT *, (SELECT COUNT(*) FROM property_images WHERE property_id = pr.property_id) AS total_images
FROM `posts` p
INNER JOIN properties pr on pr.property_id = p.property_id
INNER JOIN users u on u.user_id = p.user_id
INNER JOIN wards w on w.ward_id = pr.ward_id
INNER JOIN districts d on d.district_id = w.district_id 
LEFT JOIN post_saves ps on ps.post_sid = p.post_id 
INNER JOIN property_images i on i.property_id = pr.property_id
WHERE ps.user_sid = :user_id
AND p.status = :status
AND i.image_id = (
SELECT MIN(image_id)
FROM property_images
WHERE property_id = pr.property_id)
ORDER BY p.created_at DESC", [
    'user_id' => $user_id,
    'status' => $status
])->fetchAll(PDO::FETCH_ASSOC);

$total_status = ['available', 'sold', 'hide', 'for_rent'];

foreach ($total_status as $type_status) {
    $index = $db->query("
    SELECT count(*) as total
    FROM `posts`
    WHERE user_id = :user_id
    AND status = :status", [
        'user_id' => $user_id,
        'status' => $type_status
    ])->fetch(PDO::FETCH_ASSOC);

    $num_status[$type_status] = $index['total'];
}

$_SESSION['my_posts'] = $my_posts;
