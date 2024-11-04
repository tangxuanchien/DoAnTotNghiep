<?php
require '../models/Database.php';
require '../function.php';

$property_id = $_GET['property_id'];

$db = new Database();
$property = $db->query(
    "UPDATE `posts` SET status = (:status) WHERE property_id = :property_id",
    [
        'status' => 'sold',
        'property_id' => $property_id
    ]
);

header('Location: /Datn/views/manage-posts.view.php');
exit();
