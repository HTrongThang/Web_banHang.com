<?php
$token = $_GET['token'];
$password = $_GET['mk'];

$select_user = "SELECT * FROM `users` WHERE `token`='$token'";
$result_select_user = $connect->query($select_user);

if ($result_select_user->num_rows > 0) {
    $row_user = $result_select_user->fetch_assoc();
    date_default_timezone_set('Asia/Ho_Chi_Minh');

    $confirmTime = $row_user['isTime'];
    $current_time = time();
    $end_time = strtotime($confirmTime) + (5 * 60);

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    if ($current_time <= $end_time) {
        $updatePassword = "UPDATE `users` SET `password`='$hashed_password' WHERE `token`='$token'";
        $result_update_password = $connect->query($updatePassword);

        if ($result_update_password) {
            // Mật khẩu đã được cập nhật thành công
            echo '<script>
                alert("Mật khẩu mới đã được cập nhật. Bạn có thể đăng nhập bằng mật khẩu mới hoặc có thể thay đổi lại mật khẩu để an toàn hơn.");

                setTimeout(function() {
                    window.location.href = "?page=showLogin";
                }, 10); 
            </script>';
        } else {
            // Lỗi khi cập nhật mật khẩu
            echo '<script>
                alert("Đã xảy ra lỗi khi cập nhật mật khẩu.");

                setTimeout(function() {
                    window.location.href = "?page=xl_quenMatKhau";
                }, 10); 
            </script>';
        }
    } else {
        // Thời gian xác nhận đã hết hạn
        echo '<script>
            alert("Thời gian xác nhận mật khẩu đã hết hạn. Vui lòng thử lại sau!");

            setTimeout(function() {
                window.location.href = "?page=xl_quenMatKhau";
            }, 10); 
        </script>';
    }
} else {
    // Không tìm thấy người dùng với token cung cấp
    echo '<script>
        alert("Không tìm thấy người dùng.");

        setTimeout(function() {
            window.location.href = "?page=showLogin";
        }, 10); 
    </script>';
}
