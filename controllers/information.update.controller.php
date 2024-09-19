<?php
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = $_POST['password'];
$citizen_id = $_POST['citizen_id'];
$id = $_GET['id'];
require '../models/Database.php';
$db = new Database();
$property = $db->query("UPDATE `users` SET name='$name', phone='$phone', email='$email', password='$password', citizen_id='$citizen_id' WHERE user_id = $id")->fetch(PDO::FETCH_ASSOC);

session_start();
$_SESSION['name'] = $name;
header('Location: /Datn/views/information.view.php'); 
exit();