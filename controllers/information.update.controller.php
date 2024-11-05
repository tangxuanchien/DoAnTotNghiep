<?php
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$password = $_POST['password'];
$citizen_id = $_POST['citizen_id'];
$id = $_GET['id'];
require '../models/Database.php';
$db = new Database();

if($_SESSION['method'] == 'local'){
    $property = $db->query("UPDATE `users` SET name='$name', phone='$phone', email='$email', citizen_id='$citizen_id' WHERE user_id = $id")->fetch(PDO::FETCH_ASSOC);
} else {
    $property = $db->query("UPDATE `users` SET name='$name', phone='$phone', citizen_id='$citizen_id' WHERE user_id = $id")->fetch(PDO::FETCH_ASSOC);
}

session_start();
$_SESSION['name'] = $name;
header('Location: /Datn/views/information.view.php'); 
exit();