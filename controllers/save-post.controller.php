<?php
session_start();
require '../models/Database.php';
require '../function.php';

$db = new Database();
$post_id = $_GET['post_id'];
$user_id = $_SESSION['user_id'];

$last_post_save_id = $db->query("SELECT max(post_save_id) as max FROM `post_saves`")->fetch(PDO::FETCH_ASSOC);
$post_save_id = $last_post_save_id['max'] + 1;
$created_at = get_time();

$check_save = $db->query("
SELECT *
FROM `post_saves`
WHERE post_sid = :post_sid
AND user_sid = :user_sid", [
    'post_sid' => $post_id,
    'user_sid' => $user_id
])->fetch(PDO::FETCH_ASSOC);


if (!$check_save) {
    $save = $db->query(
        "INSERT INTO `post_saves` (`post_save_id`, `post_sid`, `user_sid`, `created_save_at`) 
                        VALUES (:post_save_id, :post_sid, :user_sid, :created_save_at)",
        [
            'post_save_id' => $post_save_id,
            'post_sid' => $post_id,
            'user_sid' => $user_id,
            'created_save_at' => $created_at,
        ]
    );
} else {
    $post_save = $check_save['post_save_id'];
    $not_save = $db->query("DELETE FROM `post_saves` WHERE post_save_id = :post_save_id", [
        'post_save_id' => $post_save
    ]);
}

header('Location: /Datn/views/all-posts.view.php?page_number=1');
exit();
