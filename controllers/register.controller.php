<?php
session_start();
require '../vendor/autoload.php';
require '../models/Database.php';
require '../function.php';

use Cloudinary\Cloudinary;

$db = new Database();
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$citizen_id = $_POST['citizen_id'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$method = 'local';
$created_at = get_time();
$cloudinary = new Cloudinary([
    'cloud' => [
        'cloud_name' => 'djdf56dfq',
        'api_key'    => '894865379752411',
        'api_secret' => 'r0PTYEveaKAKL5gSXPO5ZVPFBcU',
    ],
]);

if ($password != $confirm_password) {
    $_SESSION['error_register'] = 'Hai mật khẩu mới không trùng khớp';
    header('Location: /Datn/views/register.view.php');
    exit();
} else {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $user = $db->query(
        "INSERT INTO `users` (`user_id`, `name`, `email`, `phone`, `password`, `citizen_id`, `method`, `created_at`) 
             VALUES (:user_id, :name, :email, :phone, :password, :citizen_id, :method, :created_at)",
        [
            'user_id' => NULL,
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'password' => $hashed_password,
            'citizen_id' => $citizen_id,
            'method' => $method,
            'created_at' => $created_at
        ]
    );
    $file = '../images/man.png';
    $upload = $cloudinary->uploadApi()->upload($file, [
        'transformation' => [
            'aspect_ratio' => '1:1',
            'crop' => 'auto',
            'gravity' => 'auto',
            'width' => 500,
            'radius' => 'max',
            'quality' => 'auto',
            'fetch_format' => 'auto'
        ]
    ]);

    $public_id = $upload['public_id'];
    $avatar = $upload['secure_url'];
    $_SESSION['error_register'] = '';
    $_SESSION['error-login'] = 'Đăng kí thành công';
}
header('Location: /Datn/views/login.view.php');
exit();
