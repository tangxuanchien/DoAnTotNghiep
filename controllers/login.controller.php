<?php
session_start();
require '../function.php';
require '../models/Database.php';

$phone = $_POST['phone'];
$password = $_POST['password'];
$db = new Database();
$users = $db->query("SELECT * FROM `users`")->fetchAll(PDO::FETCH_ASSOC);

foreach ($users as $user) :
    if ($user['phone'] == $phone && $user['password'] == $password) :
        $_SESSION['id'] = $user['user_id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['method'] = 'local';
        header('Location: /Datn');
        exit();
    else: ($user['phone'] != $phone || $user['password'] != $password);
        $_SESSION['error'] = 1;
    endif;
endforeach;
header('Location: /Datn/views/login.view.php');