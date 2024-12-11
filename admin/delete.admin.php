<?php
require '../models/Database.php';
require '../function.php';

$db = new Database();

if (isset($_POST['report_id'])) {
    $report_id = $_POST['report_id'];
    $delete_report = $db->query("DELETE FROM `reports` WHERE report_id = :report_id", [
        'report_id' => $report_id
    ]);
    header('Location: /Datn/admin/home.admin.php/reports');
    exit();
}
if (isset($_POST['comment_id'])) {
    $comment_id = $_POST['comment_id'];
    $delete_comment = $db->query("DELETE FROM `comments` WHERE comment_id = :comment_id", [
        'comment_id' => $comment_id
    ]);
    header('Location: /Datn/admin/home.admin.php/comments');
    exit();
}

if (isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];
    $delete_user = $db->query("DELETE FROM `users` WHERE user_id = :user_id", [
        'user_id' => $user_id
    ]);
    header('Location: /Datn/admin/home.admin.php/users');
    exit();
}

if (isset($_POST['post_id'])) {
    $post_id = $_POST['post_id'];
    $delete_post = $db->query("DELETE FROM `posts` WHERE post_id = :post_id", [
        'post_id' => $post_id
    ]);
    header('Location: /Datn/admin/home.admin.php/posts');
    exit();
}
