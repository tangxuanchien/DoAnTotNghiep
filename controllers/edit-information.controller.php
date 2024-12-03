<?php
session_start();
require '../vendor/autoload.php';
require '../models/Database.php';
require '../function.php';

use Cloudinary\Cloudinary;

$name = $_POST['name'];
$phone = $_POST['phone'];
$citizen_id = $_POST['citizen_id'];
$introduce = $_POST['introduce'];
$user_id = $_POST['user_id'];
$db = new Database();
$cloudinary = new Cloudinary([
    'cloud' => [
        'cloud_name' => 'djdf56dfq',
        'api_key'    => '894865379752411',
        'api_secret' => 'r0PTYEveaKAKL5gSXPO5ZVPFBcU',
    ],
]);

if (empty($_POST['keep_images'])) {
    $_POST['keep_images'] = 'no';
}

if ($_SESSION['method'] == 'local') {
    $email = $_POST['email'];
    $property = $db->query("UPDATE `users` SET name='$name', phone='$phone', email='$email', introduce='$introduce', citizen_id='$citizen_id' WHERE user_id = $user_id")->fetch(PDO::FETCH_ASSOC);
} else {
    $property = $db->query("UPDATE `users` SET name='$name', phone='$phone', introduce='$introduce', citizen_id='$citizen_id' WHERE user_id = $user_id")->fetch(PDO::FETCH_ASSOC);
}

if ($_FILES['image']['name'] != "" and $_POST['keep_images'] == 'no' and ($_FILES['image']['type'] == 'image/jpeg' or $_FILES['image']['type'] == 'image/png')) {
    $delete_image_server = $db->query("SELECT * FROM `users` WHERE user_id = :user_id", [
        'user_id' => $user_id
    ])->fetch(PDO::FETCH_ASSOC);

    if (isset($delete_image_server['public_id']) && !empty($delete_image_server['public_id'])) {
        $cloudinary->uploadApi()->destroy($delete_image_server['public_id']);
    }
        $file = $_FILES['image']['tmp_name'];

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
        $update_image = $db->query(
            "UPDATE `users` SET public_id = :public_id, avatar = :avatar WHERE user_id = :user_id",
            [
                'user_id' => $user_id,
                'avatar' => $avatar,
                'public_id' => $public_id
            ]
        );
}

$user = $db->query("SELECT * FROM `users` WHERE user_id = :user_id", [
    'user_id' => $user_id
])->fetch(PDO::FETCH_ASSOC);
$_SESSION['name'] = $user['name'];
$_SESSION['avatar'] = $user['avatar'];
header('Location: /Datn/views/information.view.php');
exit();
