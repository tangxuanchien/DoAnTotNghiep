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

var_dump(password_verify($password, $user['password']));
if ($user) {
    if (password_verify($password, $user['password'])) {
        $_SESSION['id'] = $user['user_id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['method'] = 'local';
        $_SESSION['error-login'] = '';
        header('Location: /Datn');
        exit();
    } else {
        $_SESSION['error-login'] = 'Sai thông tin đăng nhập';
    }
} else {
    $_SESSION['error-login'] = 'Sai thông tin đăng nhập';
}
header('Location: /Datn/views/login.view.php');
exit();
