<?php
session_start();
require "function.php";
$phone = $_POST['phone'];
$password = $_POST['password'];
require '/models/Database.php';
$db = new Database();
$propertys = $db->query("SELECT * FROM `users`")->fetchAll(PDO::FETCH_ASSOC);
$text = 'Bạn đã nhập sai tài khoản hoặc mật khẩu';

foreach ($propertys as $property) :
    if ($property['phone'] == $phone && $property['password'] == $password) :
        $_SESSION['id'] = $property['id'];
        $_SESSION['name'] = $property['name'];
        $_SESSION['error'] = "";
        header('Location: /Datn/index.php');
        exit();
    else: ($property['phone'] != $phone || $property['password'] != $password);
        $_SESSION['error'] = "Sai tài khoản hoặc mật khẩu !";
    endif;
endforeach;
header('Location: /Datn/views/login.view.php');
