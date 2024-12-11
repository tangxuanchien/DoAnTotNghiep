<?php
session_start();
require '../vendor/autoload.php';
require '../models/Database.php';
require '../function.php';

use Cloudinary\Cloudinary;

$db = new Database();

$post_id = $_POST['post_id'];
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
$type = $_POST['type'];
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
$property = $db->query("SELECT * FROM `posts` WHERE post_id = :post_id", [
    "post_id" => $post_id
])->fetch(PDO::FETCH_ASSOC);
$property_id = $property['property_id'];

{
    $property_update = $db->query(
        "UPDATE `properties` 
        SET title = :title, description = :description, price = :price, price_per_m2 = :price_per_m2,
        area = :area, type = :type, ward_id = :ward_id, contact_info = :contact_info,
        num_bedrooms = :num_bedrooms, num_bathrooms = :num_bathrooms
        WHERE property_id = :property_id",
        [
            'property_id' => $property_id,
            'title' => $title,
            'description' => $description,
            'price' => $price,
            'area' => $area,
            'price_per_m2' => $price_per_m2,
            'type' => $type,
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

    if ($_FILES['image']['name'][0] != "" and $_POST['keep_images'] == 'no' and ($_FILES['image']['type'][0] == 'image/jpeg' or $_FILES['image']['type'][0] == 'image/png')) {
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
                "INSERT `property_images` (`image_id`, `property_id`, `image_url`, `public_id`) 
                                       VALUES (:image_id, :property_id, :image_url, :public_id)",
                [
                    'image_id' => NULL,
                    'property_id' => $property_id,
                    'image_url' => $image_url,
                    'public_id' => $public_id
                ]
            );
        }
    }
    $_SESSION['error_edit_post'] = '';

    if(isset($_POST['role'])){
        header('Location: /Datn/admin/home.admin.php/posts');
        exit();   
    } else {
        header('Location: /Datn/views/manage-posts.view.php/available');
        exit();
    }
}
