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
$user_id = $comment['user_id'];

if($user_id == $_SESSION['user_id']){
    $comment_delete = $db->query("
    DELETE FROM `comments` WHERE comment_id = :comment_id",[
        'comment_id' => $comment_id
    ]);
}

header('Location: /Datn/views/detail-post.view.php?post_id='.$post_id);
exit();

