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
$created_user_at = get_time();
$cloudinary = new Cloudinary([
    'cloud' => [
        'cloud_name' => 'djdf56dfq',
        'api_key'    => '894865379752411',
        'api_secret' => 'r0PTYEveaKAKL5gSXPO5ZVPFBcU',
    ],
]);
$user = $db->query("SELECT max(user_id) as last_id FROM `users`")->fetch(PDO::FETCH_ASSOC);
$user_id = $user['last_id'] + 1;

$check_phone = $db->query("SELECT phone FROM `users` WHERE phone = :phone",[
    'phone' => $phone
])->fetch(PDO::FETCH_ASSOC);
$check_email = $db->query("SELECT email FROM `users` WHERE email = :email",[
    'email' => $email
])->fetch(PDO::FETCH_ASSOC);

if ($check_email){
    $_SESSION['error_register'] = 'Email này đã tồn tại';
    header('Location: /Datn/views/register.view.php');
    exit();
}
if ($check_phone){
    $_SESSION['error_register'] = 'Số điện thoại này đã tồn tại';
    header('Location: /Datn/views/register.view.php');
    exit();
}
if ($password != $confirm_password) {
    $_SESSION['error_register'] = 'Hai mật khẩu mới không trùng khớp';
    header('Location: /Datn/views/register.view.php');
    exit();
} else {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

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
        $user = $db->query(
            "INSERT INTO `users` (`user_id`, `name`, `email`, `phone`, `password`, `citizen_id`, `avatar`, `public_id`, `method`, `created_user_at`) 
                 VALUES (:user_id, :name, :email, :phone, :password, :citizen_id, :avatar, :public_id, :method, :created_user_at)",
            [
                'user_id' => $user_id,
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'password' => $hashed_password,
                'citizen_id' => $citizen_id,
                'avatar' => $avatar,
                'public_id' => $public_id,
                'method' => $method,
                'created_user_at' => $created_user_at
            ]
        );
    $_SESSION['error_register'] = '';
    $_SESSION['error-login'] = 'Đăng kí thành công';
}
header('Location: /Datn/views/login.view.php');
exit();
