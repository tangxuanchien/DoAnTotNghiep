<?php
require '../models/Database.php';
require '../function.php';

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$citizen_id = $_POST['citizen_id'];
$password = $_POST['password'];
$created_at = get_time();


$db = new Database();
$property = $db->query(
    "INSERT INTO `users` (`user_id`, `name`, `email`, `phone`, `password`, `citizen_id`, `created_at`) VALUES (:user_id, :name, :email, :phone, :password, :citizen_id, :created_at)",
    [
        'user_id' => NULL,
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'password' => $password,
        'citizen_id' => $citizen_id,
        'created_at' => $created_at
    ]
)->fetch(PDO::FETCH_ASSOC);

header('Location: /Datn/views/login.view.php');

// echo '<script>
// alert("Dang ki thanh cong");
// window.location.href="/Datn/views/login.view.php";
// </script>';