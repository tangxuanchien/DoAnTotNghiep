<?php
session_start();
require '../function.php';
require '../models/Database.php';

$confirm_password = $_POST['confirm_password'];
$password = $_POST['password'];
$uuid = $_GET['uuid'];
$verification_code = $_GET['verification_code'];
$db = new Database();

if ($confirm_password !== $password) {
    $_SESSION['error-reset'] = 'Mật khẩu không trùng khớp';
    header('Location: /Datn/views/reset-pwd.view.php?uuid=' . $uuid . '&verification_code=' . $verification_code);
} else {
    $_SESSION['error-reset'] = '';
    $reset = $db->query("SELECT * FROM `password_resets` where verification_code = :verification_code AND uuid = :uuid", [
        'verification_code' => $verification_code,
        'uuid' => $uuid
    ])->fetch(PDO::FETCH_ASSOC);
    $user_id = $reset['user_id'];

    if (empty($reset)) {
        $_SESSION['error-reset'] = 'Bạn chưa xác thực email';
        header('Location: /Datn/views/reset-pwd.view.php?uuid=' . $uuid . '&verification_code=' . $verification_code);
    } else {
        $_SESSION['error-reset'] = '';
        $_SESSION['error-login'] = 'Thay đổi mật khẩu thành công';

        $hash_password = password_hash($password, PASSWORD_DEFAULT);
        $update_verify = $db->query("UPDATE `users` SET password='$hash_password' WHERE user_id = $user_id")->fetch(PDO::FETCH_ASSOC);    
        header('Location: /Datn/views/login.view.php');
    }
}
