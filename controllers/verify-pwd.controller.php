<?php
session_start();
require '../function.php';
require '../models/Database.php';

$verification_code = $_POST['verification_code'];
$db = new Database();
$verification = $db->query("SELECT * FROM `password-resets` where verification_code = :verification_code", [
    'verification_code' => $verification_code
])->fetch(PDO::FETCH_ASSOC);

if (empty($verification['user_id'])) {
    $_SESSION['error_verify'] = 'Sai mã xác nhận';
    header('Location: /Datn/views/verify-pwd.view.php');
}
header('Location: /Datn/views/reset-pwd.view.php');
