<?php
require 'vendor/autoload.php';
require '../models/Database.php';
require '../function.php';

use Cloudinary\Cloudinary;
// $id = $_SESSION['id'];

$cloudinary = new Cloudinary([
    'cloud' => [
        'cloud_name' => 'djdf56dfq',
        'api_key'    => '894865379752411',
        'api_secret' => 'r0PTYEveaKAKL5gSXPO5ZVPFBcU',
    ],
]);

if (isset($_FILES['image'])) {
    $file = $_FILES['image']['tmp_name'];
    $upload = $cloudinary->uploadApi()->upload($file, [
        'transformation' => [
            'width' => 1920,  
            'height' => 1280,       
            'crop' => 'fill',      
            'quality' => 'auto',   
            'fetch_format' => 'auto' 
        ]
    ]);
}

// $public_id = $upload['public_id'];
// $image_url = $upload['secure_url'];
// $created_at = get_time();

// $db = new Database();
// $image = $db->query(
//     "INSERT INTO `property_images` (`image_id`, `property_id`, `image_url`, `created_at`, `public_id`) 
//                                VALUES (:image_id, :property_id, :image_url, :created_at, :public_id)",
//     [
//         'image_id' => NULL,
//         'property_id' => $property_id,
//         'image_url' => $image_url,
//         'created_at' => $created_at,
//         'public_id' => $public_id
//     ]
// )->fetch(PDO::FETCH_ASSOC);
// header('Location: /Datn/index.php');
// exit();
