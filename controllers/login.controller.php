<?php
session_start();
require '../function.php';
require '../models/Database.php';

$phone = $_POST['phone'];
$password = $_POST['password'];
$db = new Database();
$propertys = $db->query("SELECT * FROM `users`")->fetchAll(PDO::FETCH_ASSOC);
$text = 'Bạn đã nhập sai tài khoản hoặc mật khẩu';

foreach ($propertys as $property) :
    if ($property['phone'] == $phone && $property['password'] == $password) :
        $_SESSION['id'] = $property['user_id'];
        $_SESSION['name'] = $property['name'];
        $_SESSION['error'] = "";
        header('Location: /Datn');
        exit();
    else: ($property['phone'] != $phone || $property['password'] != $password);
        $_SESSION['error'] = 1;
    endif;
endforeach;
header('Location: /Datn/views/login.view.php');
