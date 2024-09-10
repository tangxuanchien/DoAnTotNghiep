<?php
$id = $_GET['id'];
require '/models/Database.php';
$db = new Database();
$property = $db->query("DELETE FROM `notes` WHERE id = $id")->fetch(PDO::FETCH_ASSOC);

header('Location: /Datn/index.php'); 
exit();
