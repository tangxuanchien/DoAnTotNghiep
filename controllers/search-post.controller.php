<?php

require '../models/Database.php';

if(!isset($SESSION['user_id'])){
    $user_id = '';
} else {
    $user_id = $_SESSION['user_id'];
}
$limit = 8;

$status = 'available';
$db = new Database();

$sort_by_created_at = check_isset($_POST['sort_by_created_at']);
$sort_by_price = check_isset($_POST['sort_by_price']);
$type = check_isset($_POST['type']);
$district_id = check_isset($_POST['district_id']);
$ward_id = check_isset($_POST['ward_id']);

$sort = [];
if ($sort_by_price == 'price_DESC') {
    $sort['price'] = 'pr.price DESC';
} else if ($sort_by_price == 'price_ASC') {
    $sort['price'] = 'pr.price ASC';
}

if ($sort_by_created_at == 'created_at_DESC') {
    $sort['created_at'] = 'p.created_at DESC';
} else if ($sort_by_created_at == 'created_at_ASC') {
    $sort['created_at'] = 'p.created_at ASC';
}
$order_by = implode(', ', $sort);

if (empty($order_by)) {
    $order_by = 'p.created_at DESC';
}

$sort_filter = [];
if(!empty($district_id)){
    $sort_filter['district_id'] = 'AND d.district_id = '.$district_id;
}
if(!empty($type)){
    $sort_filter['type'] = 'AND pr.type = "'.$type.'"';
}
if(!empty($ward_id)){
    $sort_filter['ward_id'] = 'AND w.ward_id = '.$ward_id;
}
if(!empty($_POST['price_range']) AND ($_POST['price_range'] != '0000 AND 0000')){
    $sort_filter['price'] = 'AND pr.price BETWEEN '.$_POST['price_range'];
}
$filter = implode(' ', $sort_filter);

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
$filter
AND i.image_id = (
SELECT MIN(image_id)
FROM property_images
WHERE property_id = pr.property_id)
ORDER BY $order_by", [
    'status' => $status
])->fetchAll(PDO::FETCH_ASSOC);

$post_saves = $db->query("
SELECT *
FROM `post_saves`
WHERE user_sid = :user_sid", [
    'user_sid' => $user_id
])->fetchAll(PDO::FETCH_ASSOC);

$districts = $db->query("SELECT * FROM `districts`")->fetchAll(PDO::FETCH_ASSOC);

if (!isset($_POST['ward_id'])) {
	$ward_id = 0;
} else {
	$ward_id = $_POST['ward_id'];
};

$ward = $db->query("
SELECT * FROM `wards`
WHERE ward_id = :ward_id", [
	'ward_id' => $ward_id
])->fetch(PDO::FETCH_ASSOC);

