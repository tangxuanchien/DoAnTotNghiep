<?php
session_start();
require '../function.php';
require '../models/Database.php';

$user_id = $_SESSION['user_id'];
$content = $_POST['content'];
$post_id = $_POST['post_id'];
$created_comment_at = get_time();
$updated_comment_at = get_time();

$db = new Database();
$last_comment_id = $db->query("SELECT max(comment_id) as id FROM `comments`")->fetch(PDO::FETCH_ASSOC);
$comment_id = $last_comment_id['id'] + 1;

$comment = $db->query("
INSERT INTO comments (comment_id, post_id, user_id, content, status_comment, created_comment_at, updated_comment_at) 
VALUES (:comment_id, :post_id, :user_id, :content, :status_comment, :created_comment_at, :updated_comment_at)", [
    'comment_id' => $comment_id,
    'post_id' => $post_id,
    'user_id' => $user_id,
    'content' => $content,
    'status_comment' => 'approved',
    'created_comment_at' => $created_comment_at,
    'updated_comment_at' => $updated_comment_at
]);

header('Location: /Datn/views/detail-post.view.php?post_id='.$post_id);
exit();
