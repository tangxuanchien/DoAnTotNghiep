<?php
$property_id = $_GET['property_id'];
require '../models/Database.php';
$db = new Database();
$post = $db->query("
        SELECT * FROM `posts` p 
        INNER JOIN users u on u.user_id = p.user_id
        inner join properties pr on pr.property_id = p.property_id
        where p.property_id = :property_id", [
        'property_id' => $property_id
])->fetch(PDO::FETCH_ASSOC);
$user_id = $post['user_id'];


$post_available = $db->query("
        SELECT count(p.property_id) as total FROM `posts` p 
        INNER JOIN users u on u.user_id = p.user_id
        inner join properties pr on pr.property_id = p.property_id
        where p.user_id = :user_id
        AND p.status = 'available'", [
        'user_id' => $user_id
])->fetch(PDO::FETCH_ASSOC);

$post_sold = $db->query("
        SELECT count(p.property_id) as total FROM `posts` p 
        INNER JOIN users u on u.user_id = p.user_id
        inner join properties pr on pr.property_id = p.property_id
        where p.user_id = :user_id
        AND p.status = 'sold'", [
        'user_id' => $user_id
])->fetch(PDO::FETCH_ASSOC);

$slides = $db->query("
        SELECT * FROM `property_images` 
        where property_id = :property_id", [
        'property_id' => $property_id
])->fetchAll(PDO::FETCH_ASSOC);

$first_slide = $db->query("
        SELECT min(image_id) as min, count(*) as total FROM `property_images` 
        where property_id = :property_id", [
        'property_id' => $property_id
])->fetch(PDO::FETCH_ASSOC);

$location = $db->query("
        SELECT w.ward_name, d.district_name, d.district_id, p.property_id FROM `properties` p 
        INNER JOIN wards w on w.ward_id = p.ward_id
        INNER JOIN districts d on d.district_id = w.district_id
        where p.property_id = :property_id", [
        'property_id' => $property_id
])->fetch(PDO::FETCH_ASSOC);

$district_id = $location['district_id'];
$posts_related = $db->query("
        SELECT * FROM `posts` p
        inner join properties pr on pr.property_id = p.property_id
        inner join users u on u.user_id = p.user_id
        inner join wards w on w.ward_id = pr.ward_id
        inner join districts d on d.district_id = w.district_id 
        inner join property_images i on i.property_id = pr.property_id
        where d.district_id = :district_id
        and pr.property_id != :property_id
        and i.image_id = (
        SELECT MIN(image_id)
        FROM property_images
        WHERE property_id = pr.property_id)", [
        'district_id' => $district_id,
        'property_id' => $property_id
])->fetchAll(PDO::FETCH_ASSOC);

$posts_other = $db->query("
SELECT *, (SELECT COUNT(*) FROM property_images WHERE property_id = pr.property_id) AS total_images
FROM `posts` p
INNER JOIN properties pr on pr.property_id = p.property_id
INNER JOIN users u on u.user_id = p.user_id
INNER JOIN wards w on w.ward_id = pr.ward_id
INNER JOIN districts d on d.district_id = w.district_id 
INNER JOIN property_images i on i.property_id = pr.property_id
WHERE u.user_id = :user_id
AND pr.property_id != :property_id
AND i.image_id = (
SELECT MIN(image_id)
FROM property_images
WHERE property_id = pr.property_id)", [
        'user_id' => $user_id,
        'property_id' => $property_id
])->fetchAll(PDO::FETCH_ASSOC);

$created_at = $post['created_user_at'];
$formatted_create_at = date("d-m-Y", strtotime($created_at));
