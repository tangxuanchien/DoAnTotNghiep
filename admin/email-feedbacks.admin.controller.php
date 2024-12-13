<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Ramsey\Uuid\Uuid;

require '../models/Database.php';
require '../function.php';
require '../vendor/autoload.php';

$mail = new PHPMailer(true);

$email = $_POST['email'];
$title = $_POST['title'];
$content = $_POST['content'];
$uuid = Uuid::uuid4()->toString();

$db = new Database();
$user = $db->query('Select * from `users` where email = :email', [
    'email' => $email
])->fetch(PDO::FETCH_ASSOC);

if (!$user['email']) {
    $_SESSION['email-success'] = 'Email không tồn tại !';
    header('Location: /Datn/admin/home.admin.php/email-feedbacks');
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
        $mail->Subject = 'Phản hồi khách hàng ' . $user['name'] . ': ' . $title;
        $mail->Body    = '<p>'.$content.'</p>';
        $mail->AltBody = $content;
        $mail->send();
    } catch (Exception $e) {
        echo "Email chưa được gửi. Mailer Error: {$mail->ErrorInfo}";
        $_SESSION['email-success'] = 'Gửi email thất bại';
    }
    $_SESSION['email-success'] = 'Gửi email thành công';
    header('Location: /Datn/admin/home.admin.php/email-feedbacks');
}
