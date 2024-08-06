<?php
if (isset($_POST['btn-submit'])) {
    $lastName = isset($_POST['Last_name']) ? $_POST['Last_name'] : "";
    $firstName = isset($_POST['firstName']) ? $_POST['firstName'] : "";
    $username = isset($_POST['username']) ? $_POST['username'] : "";
    $pass = isset($_POST['pass']) ? $_POST['pass'] : "";

    $email = isset($_POST['email']) ? $_POST['email'] : "";
    $tel = isset($_POST['tel']) ? $_POST['tel'] : "";
    $address = isset($_POST['address']) ? $_POST['address'] : "";

    $tinh = isset($_POST['tinh']) ? $_POST['tinh'] : '';
    $quan = isset($_POST['quan']) ? $_POST['quan'] : '';
    $xa = isset($_POST['xa']) ? $_POST['xa'] : '';

    $diachiCuThe = $address . " " . $xa . " " . $quan . " " . $tinh;


    $targetDir = 'public/images/';
    $thumbImgName = $_FILES['thumb_img']['name'];
    $thumbImgTmpName = $_FILES['thumb_img']['tmp_name'];
    $thumbImgTargetPath = $targetDir . basename($thumbImgName);
    $thumbImgExtension = pathinfo($thumbImgTargetPath, PATHINFO_EXTENSION);

    if (move_uploaded_file($thumbImgTmpName, $thumbImgTargetPath)) {
        $img_ava = $thumbImgTargetPath;
    }
    $statusToken = 1;
    date_default_timezone_set('Asia/Ho_Chi_Minh'); // Đặt múi giờ thành GMT+7
    $current_date = date("Y-m-d H:i:s");
    $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

    $token = bin2hex(random_bytes(4));


    $sql_insert_acount = "INSERT INTO `users`( `username`, `password`, `firstName`, `lastName`, `email`, `phoneNumber`, `address`, `userTypeID`, `user_avater`, `token`, `isSTatus_token`, `isTime`)
     VALUES ('$username','$hashed_password','$firstName','$lastName','$email','$tel','$diachiCuThe','2','$img_ava','$token','$statusToken','$current_date')";

    $result__insert_acount = $connect->query($sql_insert_acount);
    if ($result__insert_acount) {
        echo '<script >
        alert("Đã thêm thành công tài khoản")
    </script>';
        require 'list_salesStaff.php';
    } else {
        echo '<script >
        alert("Đã thêm tài khoản không thành công")
    </script>';
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
                    <div class="section" id="title-page">
                        <div class="clearfix">
                            <h3 id="index" class="fl-left"> <i class="fa-regular fa-user"></i> Tạo mới tài khoản</h3>
                        </div>
                    </div>
                    <form method="POST" style="width: 100%; float: left;  " enctype="multipart/form-data">
                        <div class="container">
                            <div class="row">
                                <div class="col-9">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="Last_name">Last Name: </label>
                                            <input type="text" name="Last_name" id="Last_name" style="width: 100%;">
                                        </div>
                                        <div class="col-6">
                                            <label for="firstName">First Name: </label>
                                            <input type="text" name="firstName" id="firstName" style="width: 100%;">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6">
                                            <label for="username">Tên đăng nhập</label>
                                            <input type="text" name="username" id="username" style="width: 100%;">
                                        </div>
                                        <div class="col-6">
                                            <label for="pass">password</label>
                                            <input type="password" name="pass" id="pass">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" id="email">
                                        </div>
                                        <div class="col-6">
                                            <label for="tel">Số điện thoại</label>
                                            <input type="tel" name="tel" id="tel">
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
                                            <input type="text" name="address" id="address" style="width: 100%;">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <button type="submit" name="btn-submit" id="btn-submit">Tạo mới</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                        <div class="avatar_usser">
                                            <div class="center-image">
                                                <img id="avatar-image" src="public/images/images.png">
                                            </div>
                                            <div>
                                            </div>
                                            <input type="file" name="thumb_img" id="avatar-input" class="file-input" value="<?php echo isset($item['user_avater']) ? $item['user_avater'] : ''; ?>">
                                        </div>

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