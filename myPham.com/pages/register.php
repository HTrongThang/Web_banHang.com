<?php
require 'sendmail/index.php';

$response = array('status' => '', 'message' => '');

if (empty($_POST['userName'])) {
    $response['message'] = "Vui lòng nhập tên đăng nhập";
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    exit;
} else {
    $userName = $_POST['userName'];

    $userNameRegex = '/^[A-Za-z0-9_.]{6,32}$/';
    if (!preg_match($userNameRegex, $userName)) {
        $response['message'] = "Tên đăng nhập chỉ được chứa chữ cái, số, dấu chấm và dấu gạch dưới";
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        exit;
    }
}

$passError = '';

if (empty($_POST['passwoord'])) {
    $response['message'] = "Vui lòng nhập mật khẩu";
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    exit;
} else {
    $password = $_POST['passwoord'];

    $passwordRegex = '/^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/';
    if (strlen($password) === 0) {
        $passError = "Vui lòng nhập mật khẩu!";
        $response['message'] = $passError;
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        exit;
    } elseif (strlen($password) < 6) {
        $passError = "Mật khẩu phải có ít nhất 6 ký tự!";
        $response['message'] = $passError;
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        exit;
    } elseif (strlen($password) > 32) {
        $passError = "Mật khẩu không được vượt quá 32 ký tự";
        $response['message'] = $passError;
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        exit;
    } elseif (!preg_match($passwordRegex, $password)) {
        $passError = "Mật khẩu không đáp ứng yêu cầu: phải bắt đầu bằng chữ cái đầu viết hoa, bao gồm chữ cái, số, và các ký tự đặc biệt.";
        $response['message'] = $passError;
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        exit;
    }
}

if (empty($_POST['confirmPassword'])) {
    $response['message'] = "Vui lòng nhập xác nhận mật khẩu";
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    exit;
} else {
    $confirmPassword = $_POST['confirmPassword'];

    if ($confirmPassword !== $password) {
        $response['message'] = "Xác nhận mật khẩu không khớp";
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        exit;
    }
}



if (empty($_POST['email'])) {
    $response['message'] = "Vui lòng nhập email";
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    exit;
} else {
    $email = $_POST['email'];
}

$emailRegex = "/^[A-Za-z0-9_.]{6,32}@([a-zA-Z0-9]{2,12})(\.[a-zA-Z]{2,12})+$/";
if (!preg_match($emailRegex, $email)) {
    $response['message'] = "Email không hợp lệ. Vui lòng kiểm tra lại!. Hãy nhập đúng định dạng";
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    exit;
}


$sql_checkUserName = "SELECT * FROM users WHERE username = '$userName'";
$result_check_name = $connect->query($sql_checkUserName);
if ($result_check_name->num_rows > 0) {
    $response['message'] = 'Tên đăng nhập đã tồn tại. Vui lòng chọn tên khác!';
    echo json_encode($response, JSON_UNESCAPED_UNICODE);

    exit;
}

$sql_checkemail = "SELECT * FROM users WHERE email = '$email'";
$result_check_email = $connect->query($sql_checkemail);
if ($result_check_email->num_rows > 0) {
    $response['message'] = 'Email đã tồn tại. Vui lòng đăng ký email khác!';
    echo json_encode($response, JSON_UNESCAPED_UNICODE);

    exit;
}

$token = bin2hex(random_bytes(4));
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$statusToken = 0;
date_default_timezone_set('Asia/Ho_Chi_Minh'); // Đặt múi giờ thành GMT+7
$current_date = date("Y-m-d H:i:s");

$sql = "INSERT INTO `users`(`username`, `password`, `firstName`, `lastName`, `email`, `phoneNumber`, `address`, `userTypeID`, `user_avater`, `token`, `isSTatus_token`, `isTime`) 
        VALUES ('$userName','$hashed_password','','','$email','','','1','public/images/user.png','$token','$statusToken','$current_date ')";

$result_register = $connect->query($sql);
if ($result_register) {
    $tieude = "Xác nhận đăng ký tài khoản";
    $noiDung = "Nhấp vào liên kết sau để xác nhận đăng ký: http://localhost/project/Web_banHang.com/myPham.com/?page=Token_register&code=$token";
    $noiDung .= "<br>" . "Thông báo: Đây là email xác nhận đăng ký tài khoản.";
    $noiDung .= "<br>" . "Xin vui lòng không trả lời email này.";

    $mailDangKy = $email;
    $mailer = new mailer();
    $mailer->datHangMail($tieude, $noiDung, $mailDangKy);

    $response['status'] = 'success';
    $response['message'] = 'Chúng tôi đã gửi mail xác nhận. Vui lòng kiểm tra email mới nhất để bấm xác nhận!';
} else {
    $response['message'] = 'Đã có lỗi xảy ra trong quá trình đăng ký. Vui lòng thử lại sau!';
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);
