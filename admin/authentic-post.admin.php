<?php
require '../models/Database.php';
require '../function.php';

$post_id = $_POST['post_id'];
$db = new Database();
$posts = $db->query("
UPDATE `posts` SET authentic = :authentic WHERE post_id = :post_id", [
    'authentic' => 1,
    'post_id' => $post_id
]);

header('Location: /Datn/admin/home.admin.php/posts');
exit();

