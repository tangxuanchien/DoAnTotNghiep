<?php
$body = $_POST['body'];
$id = $_GET['id'];
require '../models/Database.php';
require
$db = new Database();
$todo = $db->query("UPDATE `notes` SET body='$body' WHERE id = $id")->fetch(PDO::FETCH_ASSOC);

header('Location: /ToDoApp/index.php'); 
exit();