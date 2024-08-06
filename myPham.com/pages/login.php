<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$response = array('status' => '', 'message' => '');

// Kiểm tra tên đăng nhập
if (empty($_POST['userName'])) {
    $response['message'] = "Vui lòng nhập tên đăng nhập";
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    exit;
} else {
    $userName = $_POST['userName'];

    // Kiểm tra định dạng tên đăng nhập
    $userNameRegex = '/^[A-Za-z0-9_.]{6,32}$/';
    if (!preg_match($userNameRegex, $userName)) {
        $response['message'] = "Tên đăng nhập chỉ được chứa chữ cái, số, dấu chấm và dấu gạch dưới";
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        exit;
    }
}

// Kiểm tra mật khẩu
if (empty($_POST['password'])) {
    $response['message'] = "Vui lòng nhập mật khẩu";
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    exit;
} else {
    $password = $_POST['password'];

    // Kiểm tra định dạng mật khẩu
    $passwordRegex = '/^(?=.*[a-zA-Z])(?=.*\d)[A-Za-z\d_\.!@#$%^&*()]{6,31}$/';

    if (!preg_match($passwordRegex, $password)) {
        $response['message'] = "Mật khẩu không đúng định dạng!";
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        exit;
    }
}

// Kiểm tra recaptcha
if (empty($_POST['recaptchaResponse']) || trim($_POST['recaptchaResponse']) === '') {
    $response['message'] = "Vui lòng xác minh bạn không phải là người máy!";
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    exit;
}

$recaptcha = $_POST['recaptchaResponse'];

if (isset($recaptcha) && !empty($recaptcha)) {
    $secret = '6LcpksYpAAAAAClWg1HySCvCBRJs0OAeezZodF0T';
    $verify_response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $recaptcha);
    $response_data = json_decode($verify_response);

    if (!$response_data->success) {
        $response['message'] = 'Xác minh không thành công, vui lòng thử lại';
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        exit;
    }
} else {
    $response['message'] = 'Vui lòng xác minh bạn không phải là người máy';
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    exit;
}

// Kiểm tra đăng nhập
$sql_login = "SELECT `password`, `userTypeID` FROM `users` WHERE `username`='$userName' AND `isSTatus_token`=1";
$result_login = $connect->query($sql_login);

if ($result_login->num_rows > 0) {
    $row = $result_login->fetch_assoc();
    $hashPassword = $row['password'];
    $userTypeID = $row['userTypeID'];

    if (password_verify($password, $hashPassword)) {
        if ($userTypeID == 1) {
            $_SESSION["user"] = $userName;
            $response['status'] = 'success';
        } else if ($userTypeID == 2) {
            $_SESSION["user"] = $userName;
            $response['status'] = 'admin';
        }
    } else {
        $response['message'] = 'Thông tin mật khẩu tài khoản không chính xác';
    }
} else {
    $response['message'] = 'Vui lòng kiểm tra lại tên đăng nhập, hoặc tài khoản chưa được kích hoạt thành công. Vui lòng thử lại';
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);
