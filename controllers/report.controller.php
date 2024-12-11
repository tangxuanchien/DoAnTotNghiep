<?php
session_start();
require '../models/Database.php';
require '../function.php';

$db = new Database();
$last_report_id = $db->query("SELECT max(report_id) as max FROM `reports`")->fetch(PDO::FETCH_ASSOC);
if(isset($last_report_id)){
    $report_id = $last_report_id['max'] + 1;
} else{
    $report_id = 1;
}
$content_report = $_POST['content_report'];
$type_report = $_POST['type_report'];
$created_report_at = get_time();
$post_report_id = $_POST['post_report_id'];
$user_report_id = $_SESSION['user_id'];

$report = $db->query("
INSERT INTO reports (report_id, content_report, type_report, created_report_at, post_report_id, user_report_id) 
VALUES (:report_id, :content_report, :type_report, :created_report_at, :post_report_id, :user_report_id)", [
    'report_id' => $report_id,
    'content_report' => $content_report,
    'type_report' => $type_report,
    'created_report_at' => $created_report_at,
    'post_report_id' => $post_report_id,
    'user_report_id' => $user_report_id,
]);

$_SESSION['error_report'] = 'Báo cáo thành công';
header('Location: /Datn/views/detail-post.view.php?post_id='.$post_report_id);
exit();
// var_dump($content_report, $type_report, $post_report_id, $user_report_id, $report_id);
