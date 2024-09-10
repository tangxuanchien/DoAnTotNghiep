<?php
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = $_POST['password'];

require '../models/Database.php';

$db = new Database();
$property = $db->query(
    "INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`) VALUES (:id, :name, :email, :phone, :password)",
    [
        'id' => NULL,
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'password' => $password
    ]
)->fetch(PDO::FETCH_ASSOC);

header('Location: /Datn/index.php');
exit();
