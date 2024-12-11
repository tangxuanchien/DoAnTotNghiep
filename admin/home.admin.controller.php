<?php
require '../models/Database.php';
require '../function.php';

$db = new Database();
$posts = $db->query("
SELECT * 
FROM `posts` p
inner join properties pr on pr.property_id = p.property_id
inner join users u on u.user_id = p.user_id
inner join wards w on w.ward_id = pr.ward_id
inner join districts d on d.district_id = w.district_id 
ORDER BY p.post_id")->fetchAll(PDO::FETCH_ASSOC);

$comments = $db->query("
SELECT * 
FROM `comments` c
inner join users u on u.user_id = c.user_id 
ORDER BY c.comment_id")->fetchAll(PDO::FETCH_ASSOC);

$users = $db->query("
SELECT * 
FROM `users`
ORDER BY user_id")->fetchAll(PDO::FETCH_ASSOC);
