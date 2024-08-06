<style>
    .width_input {
        width: 100%;
    }
</style>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $passOld = $_POST['pass-old'];
    $passNew = $_POST['pass-new'];
    $confirmPass = $_POST['confirm-pass'];
    $username = $_SESSION["user"];

    if ($passNew !== $confirmPass) {
        echo '<script>
                alert("Xác nhận mật khẩu không khớp. Vui lòng thử lại sau.");
            </script>';
    } else {
        $hashedPassword = password_hash($passNew, PASSWORD_DEFAULT);

        $sql_check_username = "SELECT `userID` FROM `users` WHERE `username` = '$username'";
        $result = $connect->query($sql_check_username);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user_id = $row['userID'];

            $update_change_pass = "UPDATE `users` SET `password` = '$hashedPassword' WHERE `userID` ='$user_id'";
            $result_update = $connect->query($update_change_pass);

            if ($result_update) {
                echo '<script>
                        alert("Cập nhật mật khẩu thành công.");
                        window.location.href = "?page=info_account";
                    </script>';
                    
            } else {
                echo '<script>
                        alert("Có lỗi xảy ra. Vui lòng thử lại sau.");
                    </script>';
            }
        } else {
            echo '<script>
                    alert("Không tìm thấy người dùng.");
                </script>';
        }
    }
}
?>

<script>
    alert("Xác nhận mật khẩu không khớp vui lòng thử lại sau");
</script>

<div id="main-content-wp" class="change-pass-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="?page=add_cat" title="" id="add-new" class="fl-left">Thêm mới</a>
            <h3 id="index" class="fl-left">Cập nhật tài khoản</h3>
        </div>
    </div>
    <div class="wrap clearfix">
        <div id="sidebar" class="fl-left">
            <ul id="list-cat">
                <li>
                    <a href="?page=info_account" title="">Cập nhật thông tin</a>
                </li>
                <li>
                    <a href="?page=list_post" title="">Thoát</a>
                </li>
            </ul>
        </div>
        <div id="content" class="fl-right">
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" style="width: 70%;">
                        <div class="container">
                            <div class="row">
                                <div class="col-8">
                                    <label for="old-pass">Mật khẩu cũ</label>
                                    <input type="password" name="pass-old" id="pass-old">
                                    <label for="new-pass">Mật khẩu mới</label>
                                    <input type="password" name="pass-new" id="pass-new">
                                    <label for="confirm-pass">Xác nhận mật khẩu</label>
                                    <input type="password" name="confirm-pass" id="confirm-pass">
                                </div>
                                <div class="col-4">
                                    <div class="avatar_usser">
                                        <div class="center-image">

                                            <img id="avatar-image" src="<?php echo isset($item['user_avater']) ? $item['user_avater'] : ''; ?>">
                                        </div>
                                        <div style="padding-top: 10px;">
                                            <span> UserName: <span style="font-weight: bold; color: #4CAF50;"><?php echo isset($item['username']) ? $item['username'] : ''; ?></span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="btn-submit" id="btn-submit">Cập nhật</button>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>