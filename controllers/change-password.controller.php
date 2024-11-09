<?php
require '../models/Database.php';

$user_id = $_SESSION['user_id'];
$current_password = $_POST['current_password'];
$new_password = $_POST['new_password'];
$confirm_password = $_POST['confirm_password'];

if($new_password != $confirm_password){
    $_SESSION['error_change_password'] = 'Hai mật khẩu không khớp nhau';
}

$db = new Database();
