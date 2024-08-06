<?php
$code = $_GET['code'];
$sql = "SELECT * FROM `users` WHERE `token`='$code'";
$result_sql = $connect->query($sql);

if ($result_sql->num_rows > 0) {
    $rowz_result_sql = $result_sql->fetch_assoc();
    date_default_timezone_set('Asia/Ho_Chi_Minh'); 

    $confirmTime = strtotime($rowz_result_sql['isTime']);
    $email = $rowz_result_sql['email'];
    $current_time = time();
    $end_time = $confirmTime + (5 * 60);

    if ($current_time <= $end_time) {
        $update_register_login = "UPDATE `users` SET `isSTatus_token`='1' WHERE `email`='$email' and `token`='$code'";
        $result_sql_token = $connect->query($update_register_login);
        echo '<script>
        alert("Xác nhận đăng ký thành công. Bạn có thể đăng nhập !");
        setTimeout(function() {
            window.location.href = "?page=showLogin";
        }, 10); 
    </script>';
    } else {
        $delete_register_login = "DELETE FROM `users` WHERE `token`='$code'";
        $result_sql__delet_token = $connect->query($delete_register_login);
        echo '<script>
        alert("Mã xác nhận đăng ký đã hết hạn. Vui lòng đăng ký lại !");
        setTimeout(function() {
            window.location.href = "?page=showLogin";
        }, 10); 
    </script>';
    }
} else {
    echo '<script>
    alert("Mã xác nhận không hợp lệ. Vui lòng kiểm tra lại email mới nhất !");
    setTimeout(function() {
        window.location.href = "?page=showLogin";
    }, 10); 
</script>';
}
