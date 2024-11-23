<?php
require '../models/Database.php';
require '../function.php';

$post_id = $_GET['post_id'];
$status = $_GET['status'];

$db = new Database();
$property = $db->query(
    "UPDATE `posts` SET status = :status WHERE post_id = :post_id",
    [
        'status' => $status,
        'post_id' => $post_id
    ]
);

header('Location: /Datn/views/manage-posts.view.php/available');
exit();
