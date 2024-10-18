<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../models/Database.php';
require '../function.php';
require '../vendor/autoload.php';

$mail = new PHPMailer(true);

$email = $_POST['email'];
$verification_code = rand(100000, 999999);
$created_at = get_time();
$expires_at = get_time_extra();

$db = new Database();
$user = $db->query('Select * from `users` where email = :email', [
  'email' => $email
])->fetch(PDO::FETCH_ASSOC);

if (empty($user['email'])) {
  $_SESSION['error-reset'] = 'Vui lòng nhập email của bạn !';
  header('Location: /Datn/views/reset-pwd.view.php');
} else {
  try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'tmtmganga@gmail.com';
    $mail->Password   = 'mtzr uqwd nwsl ovig';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    $mail->setFrom('tmtmganga@gmail.com', 'HANOIHOME');
    $mail->addAddress($user['email'], $user['name']);



    // Nội dung email
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';
    $mail->Subject = 'XÁC MINH TÀI KHOẢN'; // Title
    $mail->Body    = '<div>Mã xác nhận tài khoản của bạn là: <b>' . $verification_code . '</b></div>
                      <div>Vui lòng nhập đúng mã xác nhận để đăng nhập. Mã xác nhận có hiệu lực 60 giây</div>';
    $mail->AltBody = 'Mã xác nhận tài khoản: ' . $verification_code;
    $mail->send();

    $user_id = $user['user_id'];
    $verification = $db->query("SELECT * FROM `password_resets`where user_id = :user_id", [
      'user_id' => $user_id
    ])->fetch(PDO::FETCH_ASSOC);

    if (empty($verification['user_id'])) {
      $create_verify = $db->query(
        "INSERT INTO `password_resets` (`user_id`, `verification_code`, `created_at`, `expires_at`) 
                               VALUES (:user_id, :verification_code, :created_at, :expires_at)",
        [
          'user_id' => $user_id,
          'verification_code' => $verification_code,
          'created_at' => $created_at,
          'expires_at' => $expires_at
        ]
      )->fetch(PDO::FETCH_ASSOC);
    } else {
      $update_verify = $db->query("UPDATE `password_resets` SET user_id='$user_id', verification_code='$verification_code', created_at='$created_at', expires_at='$expires_at' WHERE user_id = $user_id")->fetch(PDO::FETCH_ASSOC);
    }
  } catch (Exception $e) {
    echo "Email chưa được gửi. Mailer Error: {$mail->ErrorInfo}";
  }
  header('Location: /Datn/views/verify-pwd.view.php?email='.$email);
}
