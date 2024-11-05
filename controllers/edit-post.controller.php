<?php
session_start();
require '../vendor/autoload.php';
require '../models/Database.php';
require '../function.php';

use Cloudinary\Cloudinary;

$db = new Database();

$property_id = $_GET['property_id'];
if (empty($_POST['keep_images'])) {
    $_POST['keep_images'] = 'no';
}

$title = $_POST['title'];
$description = $_POST['description'];
$price = $_POST['price'];
$area = $_POST['area'];
$contact_info = $_POST['contact_info'];
$num_bedrooms = $_POST['num_bedrooms'];
$num_bathrooms = $_POST['num_bathrooms'];
$type_id = $_POST['type_id'];
$ward_id = $_POST['ward_id'];
$updated_at = get_time();
$price_per_m2 = get_price_per_m2($price, $area);

$cloudinary = new Cloudinary([
    'cloud' => [
        'cloud_name' => 'djdf56dfq',
        'api_key'    => '894865379752411',
        'api_secret' => 'r0PTYEveaKAKL5gSXPO5ZVPFBcU',
    ],
]);

if (
    empty($title) or empty($description) or empty($price) or empty($area) or empty($description)
    or empty($contact_info) or empty($num_bedrooms) or empty($type_id) or empty($ward_id) or empty($_FILES['image']['name'][0])
) {
    $_SESSION['error_edit_post'] = 'Bạn đang để trống nội dung';
    header('Location: /Datn/views/edit-post.view.php?property_id=' . $property_id);
} else {
    $property = $db->query(
        "UPDATE `properties` 
        SET title = :title, description = :description, price = :price, price_per_m2 = :price_per_m2,
        area = :area, type_id = :type_id, ward_id = :ward_id, contact_info = :contact_info,
        num_bedrooms = :num_bedrooms, num_bathrooms = :num_bathrooms
        WHERE property_id = :property_id",
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
        "UPDATE `posts` SET updated_at = :updated_at",
        [
            'updated_at' => $updated_at
        ]
    );


    if ($_POST['keep_images'] == 'no') {
        if (!empty($_FILES['image'])) {
            $files = $_FILES['image'];
            $count_files = count($files['name']);

            $delete_images_server = $db->query("SELECT * FROM `property_images` WHERE property_id = :property_id", [
                'property_id' => $property_id
            ])->fetchAll(PDO::FETCH_ASSOC);
            foreach ($delete_images_server as $delete_image_server) {
                $cloudinary->uploadApi()->destroy($delete_image_server['public_id']);
            }

            $delete_images_sql = $db->query("DELETE FROM `property_images` WHERE property_id = :property_id", [
                'property_id' => $property_id
            ]);

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
                    "INSERT `property_images` (`image_id`, `property_id`, `image_url`, `created_at`, `public_id`) 
                                       VALUES (:image_id, :property_id, :image_url, :created_at, :public_id)",
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
    }
    $_SESSION['error_edit_post'] = '';
    header('Location: /Datn/views/manage-posts.view.php');
    exit();
}
