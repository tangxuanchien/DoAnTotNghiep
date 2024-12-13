<?php
require '../models/Database.php';
require '../function.php';

$db = new Database();

if (isset($_POST['report_id'])) {
    $report_id = $_POST['report_id'];
    $status_report = $_POST['status_report'];
    $update_report = $db->query("UPDATE `reports` SET status_report = :status_report WHERE report_id = :report_id", [
        'report_id' => $report_id,
        'status_report' => $status_report
    ]);
    header('Location: /Datn/admin/home.admin.php/reports');
    exit();
}