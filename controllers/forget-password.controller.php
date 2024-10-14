<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../models/Database.php';
require '../vendor/autoload.php';

$mail = new PHPMailer(true);

try {
  // Cấu hình server SMTP
  $mail->isSMTP();
  $mail->Host       = 'smtp.gmail.com'; 
  $mail->SMTPAuth   = true;
  $mail->Username   = 'tmtmganga@gmail.com'; 
  $mail->Password   = 'mtzr uqwd nwsl ovig';   
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
  $mail->Port       = 587; 

  $mail->setFrom('tmtmganga@gmail.com', 'HANOIHOME');
  $mail->addAddress('tangxuanchien511@gmail.com', 'Chien Thu Hai');

  $confirm_number = rand(100000, 999999);
  $db = new Database();

  // Nội dung email
  $mail->isHTML(true);
  $mail->CharSet = 'UTF-8';
  $mail->Subject = 'Mã xác minh mật khẩu của bạn'; // Title
  $mail->Body    = 'Mã xác nhận của bạn là <b>in bold!</b>';
  $mail->AltBody = 'Mã xác nhận của bạn là'.$confirm_number;



  $mail->send();

} catch (Exception $e) {
  echo "Email chưa được gửi. Mailer Error: {$mail->ErrorInfo}";
}
?>