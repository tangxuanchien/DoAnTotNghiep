<?php
require 'models/Database.php';
require 'function.php';
if (!isset($_SESSION['method'])) {
    $method = '';
} else {
    $method = $_SESSION['method'];
}

$db = new Database();
$posts = $db->query("
SELECT * FROM `posts` p
inner join properties pr on pr.property_id = p.property_id
inner join users u on u.user_id = p.user_id
inner join wards w on w.ward_id = pr.ward_id
inner join districts d on d.district_id = w.district_id 
inner join property_images i on i.property_id = pr.property_id 
WHERE i.image_id = (
SELECT MIN(image_id)
FROM property_images
WHERE property_id = pr.property_id)
LIMIT 9")->fetchAll(PDO::FETCH_ASSOC);

$districts = $db->query("SELECT * FROM `districts`")->fetchAll(PDO::FETCH_ASSOC);

?>
