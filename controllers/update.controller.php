<?php
$body = $_POST['body'];
$id = $_GET['id'];
require '/models/Database.php';
$db = new Database();
$property = $db->query("UPDATE `notes` SET body='$body' WHERE id = $id");

header('Location: /Datn'); 
exit();