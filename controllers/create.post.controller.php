<?php
session_start();
require '../vendor/autoload.php';
require '../models/Database.php';
require '../function.php';
use Cloudinary\Cloudinary;

$db = new Database();
$post = $db->query("SELECT max(post_id) as last_post_id FROM `posts`")->fetch(PDO::FETCH_ASSOC);

$property_id = $_GET['property_id'];
$user_id = $_GET['user_id'];
$post_id = $post['last_post_id'] + 1;
$status = 'available';

$title = $_POST['title'];
$description = $_POST['description'];
$price = $_POST['price'];
$area = $_POST['area'];
$contact_info = $_POST['contact_info'];
$num_bedrooms = $_POST['num_bedrooms'];
$num_bathrooms = $_POST['num_bathrooms'];
$type_id = $_POST['type_id'];
$ward_id = $_POST['ward_id'];
$created_at = get_time();
$updated_at = get_time();
$price_per_m2 = get_price_per_m2($price, $area);

if (
    empty($title) or empty($description) or empty($price) or empty($area) or empty($description)
    or empty($contact_info) or empty($num_bedrooms) or empty($type_id) or empty($ward_id)
) {
    $_SESSION['error_post'] = 'Bạn đang để trống nội dung';
    header('Location: /Datn/views/create.post.view.php');
} else {
    $property = $db->query(
        "INSERT INTO `properties` (`property_id`, `title`, `description`, `price`, `area`, `price_per_m2`,
                               `type_id`, `ward_id`, `contact_info`, `num_bedrooms`, `num_bathrooms`) 
                               VALUES (:property_id, :title, :description, :price, :area, :price_per_m2,
                                :type_id, :ward_id, :contact_info, :num_bedrooms, :num_bathrooms)",
        [
            'property_id' => $property_id,
            'title' => $title,
            'description' => $description,
            'price' => $price,
            'area' => $area,
            'price_per_m2' => $price_per_m2,
            'type_id' => $type_id,
            'ward_id' => $ward_id,
            'num_bedrooms' => $num_bedrooms,
            'num_bathrooms' => $num_bathrooms,
            'contact_info' => $contact_info
        ]
    );
    $post = $db->query(
        "INSERT INTO `posts` (`post_id`, `property_id`, `user_id`, `status`, `created_at`, `updated_at`) 
                               VALUES (:post_id, :property_id, :user_id, :status, :created_at, :updated_at)",
        [
            'post_id' => $post_id,
            'property_id' => $property_id,
            'user_id' => $user_id,
            'status' => $status,
            'created_at' => $created_at,
            'updated_at' => $updated_at
        ]
    );

    $_SESSION['error_post'] = '';
}

$cloudinary = new Cloudinary([
    'cloud' => [
        'cloud_name' => 'djdf56dfq',
        'api_key'    => '894865379752411',
        'api_secret' => 'r0PTYEveaKAKL5gSXPO5ZVPFBcU',
    ],
]);

if (!empty($_FILES['image'])) {
    $files = $_FILES['image'];
    $count_files = count($files['name']);

    for ($i = 0; $i < $count_files; $i++) {
        $file = $files['tmp_name'][$i];

        $upload = $cloudinary->uploadApi()->upload($file, [
            'transformation' => [
                'width' => 1920,
                'height' => 1280,
                'crop' => 'fill',
                'quality' => 'auto',
                'fetch_format' => 'auto'
            ]
        ]);
        $public_id = $upload['public_id'];
        $image_url = $upload['secure_url'];
        $image = $db->query(
            "INSERT INTO `property_images` (`image_id`, `property_id`, `image_url`, `public_id`) 
                                       VALUES (:image_id, :property_id, :image_url, :public_id)",
            [
                'image_id' => NULL,
                'property_id' => $property_id,
                'image_url' => $image_url,
                'created_at' => $created_at,
                'public_id' => $public_id
            ]
        );
    }
}

header('Location: /Datn');
exit();
