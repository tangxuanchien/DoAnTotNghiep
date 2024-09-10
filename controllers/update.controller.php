<?php
$body = $_POST['body'];
$id = $_GET['id'];
require '/models/Database.php';
$db = new Database();
$property = $db->query("UPDATE `notes` SET body='$body' WHERE id = $id")->fetch(PDO::FETCH_ASSOC);

header('Location: /Datn/index.php'); 
exit();