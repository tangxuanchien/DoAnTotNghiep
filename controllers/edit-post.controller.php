<?php
session_start();
require '../function.php';
require '../models/Database.php';

$property_id = $_GET['property_id'];

$db = new Database();
$edit_posts = $db->query("SELECT * FROM `posts` where property_id = :property_id", [
    'property_id' => $property_id
])->fetch(PDO::FETCH_ASSOC);
   
$_SESSION['edit_post'] = $edit_post;