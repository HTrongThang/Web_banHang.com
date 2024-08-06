<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

class mailer
{
    //Instantiation and passing `true` enables exceptions
    public function datHangMail($tieude, $noiDung, $mailDatHang)
    {
        try {
            $mail = new PHPMailer(true);

            // Server settings
            $mail->isSMTP(); //Send using SMTP
            $mail->Host       = 'smtp.gmail.com'; //Set the SMTP server to send through
            $mail->SMTPAuth   = true; //Enable SMTP authentication
            $mail->Username   = 'hatrongthang741@gmail.com'; //SMTP username
            $mail->Password   = 'b e y q d y o n g h x h m d l t'; //SMTP password
            $mail->SMTPSecure = 'tls';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Bật mã hóa SSL
            $mail->Port       = 465; //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->CharSet = "UTF-8";
            //người gửi
            $mail->setFrom('hatrongthang741@gmail.com', 'hasiki');
            //người nhận
            $mail->addAddress($mailDatHang, 'HTT');
            //người nhận phản hồi sẽ được gửi lại đây
            $mail->addReplyTo('hatrongthang741@gmail.com', 'hasiki');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');

            //Attachments
            //đính kèm file gửi cho khách hàng
            // $mail->addAttachment('/var/tmp/file.tar.gz'); //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg'); //Optional name

            //Content
            $mail->isHTML(true); //hỏi email của chúng ta có được gừi định dạng html                              
            $mail->Subject = $tieude;
            $mail->Body = $noiDung;

            $mail->send();
        } catch (Exception $e) {
            echo "email không được gửi thành công   : {$mail->ErrorInfo}";
        }
    }
}
