<?php
require 'vendor/autoload.php';

use Cloudinary\Cloudinary;

$cloudinary = new Cloudinary([
    'cloud' => [
        'cloud_name' => 'djdf56dfq',
        'api_key'    => '894865379752411',
        'api_secret' => 'r0PTYEveaKAKL5gSXPO5ZVPFBcU',
    ],
]);

function extractPublicId($url) {
    $parts = parse_url($url);
    $path = $parts['path'];
    $segments = explode('/', $path);
    $publicId = $segments[4];
    return $publicId;
}

$url = "https://res.cloudinary.com/djdf56dfq/image/upload/v1726156562/mdkh3pjuwqtzfccqe44d.jpg";
$publicId = extractPublicId($url);
echo $publicId;


// if (isset($_FILES['image'])) {
//     $file = $_FILES['image']['tmp_name'];
//     $upload = $cloudinary->uploadApi()->upload($file);
//     echo "Image uploaded successfully. URL: " . $upload['secure_url'] . "</br>";
//     echo "id: " . $upload['public_id'];
// }
