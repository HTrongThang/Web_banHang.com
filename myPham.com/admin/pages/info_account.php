<?php
$username = $_SESSION["user"];
$sql_query_user_id = "SELECT `userID` FROM `users` WHERE `username`='$username'";
$result_sql_query_user_id = $connect->query($sql_query_user_id);

if ($result_sql_query_user_id->num_rows > 0) {
    $row_sql_query = $result_sql_query_user_id->fetch_assoc();
    $user_id = $row_sql_query['userID'];

    $sql_query_info = "SELECT * FROM `users` WHERE `userID`='$user_id'";
    $resut_sql_query_info = $connect->query($sql_query_info);
    $item = $resut_sql_query_info->fetch_assoc();

    if (isset($_POST['btn_capNhat'])) {

        $last_name = isset($_POST['Last_name']) ? $_POST['Last_name'] : "";
        $fristName = isset($_POST['firstName']) ? $_POST['firstName'] : "";
        $phone = isset($_POST['tel']) ? $_POST['tel'] : "";
        $email = isset($_POST['email']) ? $_POST['email'] : "";
        $tinh = isset($_POST['tinh']) && $_POST['tinh'] !== '-1' ? $_POST['tinh'] : '';
        $quan = isset($_POST['quan']) && $_POST['quan'] !== '-1' ? $_POST['quan'] : '';
        $xa = isset($_POST['xa']) && $_POST['xa'] !== '-1' ? $_POST['xa'] : '';

        $diachi = isset($_POST['address']) ? $_POST['address'] : '';
        $diachiCuThe = $diachi . " " . $xa . " " . $quan . " " . $tinh;


        $targetDir = 'public/images/';
        $thumbImgName = $_FILES['thumb_img']['name'];
        $thumbImgTmpName = $_FILES['thumb_img']['c'];
        $thumbImgTargetPath = $targetDir . basename($thumbImgName);
        $thumbImgExtension = pathinfo($thumbImgTargetPath, PATHINFO_EXTENSION);

        if (move_uploaded_file($thumbImgTmpName, $thumbImgTargetPath)) {
            $img_ava = $thumbImgTargetPath;
        }
        $update_sql = "UPDATE `users` 
    SET 
    `firstName`='$fristName',
    `lastName`='$last_name',
    `email`='$email',
    `phoneNumber`='$phone',
    `user_avater`=' $img_ava',
    `address`='$diachiCuThe'
    WHERE `userID`='$user_id'";


        $result_update = $connect->query($update_sql);
        if ($result_update) {
            echo '<script>
            alert("Bạn đã cập nhật thông tin thành công");
            </script>';
            header("Location: ?page=info_account");
            exit;
        } else {
            echo '<script>
            alert("Bạn đã cập nhật thông tin không thành công");
        </script>';
        }
    }
}
?>

<style>
    .avatar_usser {
        text-align: center;

    }

    .avatar_usser img {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        margin-bottom: 10px;
    }

    input[type="file"] {
        display: block;
        margin: 0 auto;
    }

    .center-image {
        text-align: center;
    }

    .center-image img {
        display: block;
        margin: 0 auto;
    }
</style>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<div id="main-content-wp" class="info-account-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="?page=add_acount" title="" id="add-new" class="fl-left">Thêm mới</a>
            <h3 id="index" class="fl-left">Cập nhật tài khoản</h3>
        </div>
    </div>
    <div class="wrap clearfix">
        <div id="sidebar" class="fl-left">
            <ul id="list-cat">
                <li>
                    <a href="?page=change_pass" title="">Đổi mật khẩu</a>
                </li>
                <li>
                    <a href="?page=list_post" title="">Thoát</a>
                </li>
            </ul>
        </div>
        <div id="content" class="fl-right">
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" style="width: 100%; float: left; "  enctype="multipart/form-data">
                        <div class="container">
                            <div class="row">
                                <div class="col-9">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="Last_name">Last Name: </label>
                                            <input type="text" name="Last_name" id="Last_name" style="width: 100%;" value="<?php echo isset($item['lastName']) ? $item['lastName'] : ''; ?>">
                                        </div>
                                        <div class="col-6">
                                            <label for="firstName">First Name: </label>
                                            <input type="text" name="firstName" id="firstName" style="width: 100%;" value="<?php echo isset($item['firstName']) ? $item['firstName'] : ''; ?>">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6">
                                            <label for="tel">Số điện thoại</label>
                                            <input type="tel" name="tel" id="tel" value="<?php echo isset($item['phoneNumber']) ? $item['phoneNumber'] : ''; ?>">
                                        </div>
                                        <div class="col-6">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" id="email" value="<?php echo isset($item['email']) ? $item['email'] : ''; ?>">
                                        </div>
                                    </div>



                                    <div class="row">
                                        <div class="col-4">
                                            <label for="diachi">Tỉnh/Thành phố</label>
                                            <select name="tinh" id="province" class="Province">
                                                <option value="-1">Chọn tỉnh thành</option>
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <label for="quan">Quận/Huyện</label>
                                            <select name="quan" id="district" class="Province">
                                                <option value="-1">Chọn quận/huyện</option>
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <label for="xa">Phường/Xã</label>
                                            <select name="xa" id="town" class="Province">
                                                <option value="-1">Chọn phường/xã</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <label for="address">Địa chỉ cụ thể</label>
                                            <input type="text" name="address" id="address" style="width: 100%;" value="<?php echo isset($item['address']) ? $item['address'] : ''; ?>">
                                        </div>
                                    </div>


                                </div>
                                <div class="col-3">
                                    <div class="avatar_usser">
                                        <div class="center-image">

                                            <img id="avatar-image" src="<?php echo isset($item['user_avater']) ? $item['user_avater'] : ''; ?>">
                                        </div>
                                        <div style="padding-top: 10px;">
                                            <span> UserName: <span style="font-weight: bold; color: #4CAF50;"><?php echo isset($item['username']) ? $item['username'] : ''; ?></span></span>
                                        </div>
                                        <input type="file" name="thumb_img" id="avatar-input" class="file-input" value="<?php echo isset($item['user_avater']) ? $item['user_avater'] : ''; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" name="btn_capNhat" id="btn-submit">Cập nhật</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
</div>
</div>

<script>
    document.getElementById('avatar-input').addEventListener('change', function() {
        var file = this.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('avatar-image').setAttribute('src', event.target.result);
            };
            reader.readAsDataURL(file);
        }
    });
</script>
<script src="api/api.js"></script>
<script src="api/data.json"></script>