<?php
session_start();
require '../function.php';
require '../models/Database.php';

$phone = trim($_POST['phone']);
$password = trim($_POST['password']);
$db = new Database();
$user = $db->query("SELECT * FROM `users` where phone = :phone", [
    'phone' => $phone
])->fetch(PDO::FETCH_ASSOC);

if ($user) {
    if ($user['role'] == 'delete') {
        $_SESSION['error-login'] = 'Tài khoản đã bị tạm ngưng';
        header('Location: /Datn/views/login.view.php');
        exit();
    }
    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['method'] = 'local';
        $_SESSION['avatar'] = $user['avatar'];
        $_SESSION['error-login'] = '';
        if ($user['role'] == 'admin') {
            header('Location: /Datn/admin/home.admin.php/posts');
            exit();
        } else {
            header('Location: /Datn');
            exit();
        }
    } else {
        $_SESSION['error-login'] = 'Sai thông tin đăng nhập';
    }
} else {
    $_SESSION['error-login'] = 'Sai thông tin đăng nhập';
}
header('Location: /Datn/views/login.view.php');
exit();
