<?php
require 'sendmail/index.php';

$email = $_POST['email'];
$sql_check_email = "SELECT * FROM `users` WHERE `email`='$email'";
$resul_check_email = $connect->query($sql_check_email);
if ($resul_check_email->num_rows > 0) {
    $token = bin2hex(random_bytes(4));
    $password = bin2hex(random_bytes(6));

    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $current_date = date("Y-m-d H:i:s");
    $sql_update_token = "UPDATE `users` SET `token`='$token', `isTime`='$current_date' WHERE `email`='$email'";
    $resul_update_token = $connect->query($sql_update_token);
    if ($resul_update_token) {
        $tieude = "Xác nhận quên mật khẩu tài khoản hasaki";
        $noiDung = "Nhấp vào liên kết sau để xác nhận đặt lại mật khẩu: https://hatrongthang412003.id.vn/index.php?page=resetPassword&token=$token&mk=$password";
        $noiDung .= "<br>Mật khẩu mới của bạn là:$password";

        $noiDung .= "<br>Thông báo: Đây là email xác nhận quên mật khẩu tài khoản.";
        $noiDung .= "<br>Xin vui lòng không trả lời email này.";

        $mailDangKy = $email;
        $mailer = new mailer();
        $mailer->datHangMail($tieude, $noiDung, $mailDangKy);

        /*echo "Hệ thống đã gửi mail xác nhận về gmail của bạn. Vui lòng kiểm tra trong hòm thư";*/
    } else {
        echo "Quên mật khẩu không thành công. Email không tồn tại!";
    }
} else {
    echo "Địa chỉ mail của bạn không tồn tại trong hệ thống";   
}
