<?php
session_start();
require '../models/Database.php';

$name = $_POST['name'];
$phone = $_POST['phone'];
$citizen_id = $_POST['citizen_id'];
$introduce = $_POST['introduce'];
$user_id = $_GET['user_id'];
$db = new Database();

if($_SESSION['method'] == 'local'){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $property = $db->query("UPDATE `users` SET name='$name', phone='$phone', email='$email', introduce='$introduce', citizen_id='$citizen_id' WHERE user_id = $user_id")->fetch(PDO::FETCH_ASSOC);
} else {
    $property = $db->query("UPDATE `users` SET name='$name', phone='$phone', introduce='$introduce', citizen_id='$citizen_id' WHERE user_id = $user_id")->fetch(PDO::FETCH_ASSOC);
}

$_SESSION['name'] = $name;
header('Location: /Datn/views/information.view.php'); 
exit();