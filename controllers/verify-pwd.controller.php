<?php
session_start();
require '../function.php';
require '../models/Database.php';

$entered_code = $_POST['verification_code'];
$email = $_GET['email'];

$db = new Database();
$user = $db->query("SELECT * FROM `users` where email = :email", [
    'email' => $email,
])->fetch(PDO::FETCH_ASSOC);

$verification = $db->query("SELECT * FROM `password_resets` where user_id = :user_id", [
    'user_id' => $user['user_id'],
])->fetch(PDO::FETCH_ASSOC);

if (password_verify($entered_code, $verification['verification_code'])) {
    header('Location: /Datn/views/reset-pwd.view.php?uuid='.$verification['uuid'].'&verification_code='.$verification['verification_code']);
} else {
    $_SESSION['error_verify'] = 'Sai mã xác nhận';
    header('Location: /Datn/views/verify-pwd.view.php?email=' . $email);
}
