<?php
require '../models/Database.php';
require '../function.php';

$db = new Database();

if (isset($_POST['comment_id'])) {
    $comment_id = $_POST['comment_id'];
    $delete_comment = $db->query("UPDATE `comments` SET status_comment = 'rejected' WHERE comment_id = :comment_id", [
        'comment_id' => $comment_id
    ]);
    header('Location: /Datn/admin/home.admin.php/comments');
    exit();
}

if (isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];
    $delete_user = $db->query("UPDATE `users` SET role = 'delete' WHERE user_id = :user_id", [
        'user_id' => $user_id
    ]);
    header('Location: /Datn/admin/home.admin.php/users');
    exit();
}

if (isset($_POST['post_id'])) {
    $post_id = $_POST['post_id'];
    $delete_post = $db->query("UPDATE `posts` SET status = 'delete' WHERE post_id = :post_id", [
        'post_id' => $post_id
    ]);
    header('Location: /Datn/admin/home.admin.php/posts');
    exit();
}

// XÓA CỨNG BÀI ĐĂNG
// if (isset($_POST['post_id'])) {
//     $post_id = $_POST['post_id'];
//     $property = $db->query("
//     SELECT * FROM `properties` pr 
//     INNER JOIN posts p ON p.property_id = pr.property_id 
//     WHERE p.post_id = :post_id", [
//         'post_id' => $post_id
//     ])->fetch(PDO::FETCH_ASSOC);
//     $property_id = $property['property_id'];
//     $delete_post = $db->query("DELETE FROM `posts` WHERE post_id = :post_id", [
//         'post_id' => $post_id
//     ]);
//     $delete_image = $db->query("DELETE FROM `property_images` WHERE property_id = :property_id", [
//         'property_id' => $property_id
//     ]);
//     $delete_property = $db->query("DELETE FROM `properties` WHERE property_id = :property_id", [
//         'property_id' => $property_id
//     ]);
//     header('Location: /Datn/admin/home.admin.php/posts');
//     exit();
// }
