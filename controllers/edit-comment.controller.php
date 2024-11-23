<?php
session_start();
require '../function.php';
require '../models/Database.php';


$comment_id = $_GET['comment_id'];

$db = new Database();
$comment = $db->query("SELECT * FROM `comments` WHERE comment_id = :comment_id",[
    'comment_id' => $comment_id
])->fetch(PDO::FETCH_ASSOC);
$post_id = $comment['post_id'];
$content = $_POST['content'];
$updated_comment_at = get_time();

$comment_edit = $db->query("
UPDATE `comments` 
SET content = '$content', updated_comment_at = '$updated_comment_at'
WHERE comment_id = :comment_id",[
    'comment_id' => $comment_id
]);

header('Location: /Datn/views/detail-post.view.php?post_id='.$post_id);
exit();