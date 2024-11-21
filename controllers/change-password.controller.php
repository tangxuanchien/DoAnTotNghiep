<?php
session_start();
require '../models/Database.php';

$user_id = $_SESSION['user_id'];
$current_password = $_POST['current_password'];
$new_password = $_POST['new_password'];
$confirm_password = $_POST['confirm_password'];

$db = new Database();
$change_password = $db->query("SELECT * FROM `users` WHERE user_id = :user_id", [
    'user_id' => $user_id
])->fetch(PDO::FETCH_ASSOC);
if (!password_verify($current_password, $change_password['password'])) {
    $_SESSION['error_change_password'] = 'Mật khẩu cũ không trùng khớp';
    header('Location: /Datn/views/change-password.view.php');
    exit();
}
if ($new_password != $confirm_password) {
    $_SESSION['error_change_password'] = 'Hai mật khẩu mới không trùng khớp';
    header('Location: /Datn/views/change-password.view.php');
    exit();
}
if (password_verify($new_password, $change_password['password'])) {
    $_SESSION['error_change_password'] = 'Mật khẩu mới không được trùng với mật khẩu cũ';
    header('Location: /Datn/views/change-password.view.php');
    exit();
}

$hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
$update_password = $db->query("UPDATE `users` SET password='$hashed_password' WHERE user_id = $user_id");



$_SESSION['error_change_password'] = 'Đổi mật khẩu thành công';
header('Location: /Datn/views/change-password.view.php');
exit();
