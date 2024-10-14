<!-- <style>
  .container{
    text-align: center;
    margin: 50px 50px;
  }
  .label{
    padding: 0 20px;
  }
</style>
<div class="container">
  <form action="#" method="POST"></form>
  <label for="email" class="label">Vui lòng nhập địa chỉ email của bạn</label></br>
  <input type="email" name="email" placeholder="Ví dụ: nguyenvana@gmail.com"></br>
  <button type="submit">Xác thực</button>
</div> -->
<?php
// Gọi thư viện PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Tải thư viện tự động của Composer
require 'vendor/autoload.php';

// Tạo đối tượng PHPMailer
$mail = new PHPMailer(true);

try {
    // Cấu hình server SMTP
    $mail->isSMTP();
    $mail->Host       = 'smtp.example.com'; // SMTP server của bạn (ví dụ: smtp.gmail.com cho Gmail)
    $mail->SMTPAuth   = true;
    $mail->Username   = 'your-email@example.com'; // Địa chỉ email SMTP
    $mail->Password   = 'your-email-password';   // Mật khẩu email
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Mã hóa TLS hoặc SSL
    $mail->Port       = 587; // Cổng cho TLS (thường là 587), SSL (465)

    // Người gửi và người nhận
    $mail->setFrom('your-email@example.com', 'Your Name');
    $mail->addAddress('recipient@example.com', 'Recipient Name'); // Địa chỉ người nhận

    // Nội dung email
    $mail->isHTML(true); // Đặt định dạng email thành HTML
    $mail->Subject = 'Test email from PHPMailer'; // Tiêu đề email
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>'; // Nội dung HTML
    $mail->AltBody = 'This is the plain text for non-HTML mail clients'; // Nội dung dạng text (cho máy không hỗ trợ HTML)

    // Gửi email
    $mail->send();
    echo 'Email has been sent';
} catch (Exception $e) {
    echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
