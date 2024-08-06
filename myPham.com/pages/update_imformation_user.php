<style>
    .container {
        width: 80%;
        margin: 0 auto;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-top: 30px;
    }

    .txt_title {
        text-align: center;
        color: #333;
        font-size: 24px;
        margin-bottom: 20px;
        text-transform: uppercase;
        padding-right: 20px;
    }


    form.update_info_user {
        width: 100%;

    }


    .row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
    }

    .col {
        flex: 1;
        margin-right: 10px;
    }

    .row .col label {
        font-weight: bold;
    }

    .row .col input[type="text"],
    .row .col input[type="email"],
    .row .col textarea {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .row .col_dress .col-4 select,
    .row .col_dress .col-4 textarea {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }


    .btn_capnhat {
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .text_error {
        color: red;
        font-size: 14px;
        font-weight: bold;
        display: block;
    }

    btn_capnhat:hover {
        background-color: #0056b3;
    }

    .col_dress {
        display: flex;
        flex-wrap: wrap;
    }

    .col-4 {
        flex: 0 0 calc(33.33% - 10px);
        margin-right: 10px;
    }

    .avatar {
        text-align: center;
    }

    .avatar img {
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

    .chucNang {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .chucNang a {
        text-decoration: none;
    }

    .btn_thontin {
        padding: 10px 20px;
        margin: 0 10px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn_thontin:hover {
        background-color: #45a049;
    }
</style>
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

        $last_name = isset($_POST['LastName']) ? $_POST['LastName'] : "";
        $fristName = isset($_POST['firstName']) ? $_POST['firstName'] : "";
        $phone = isset($_POST['phone']) ? $_POST['phone'] : "";
        $email = isset($_POST['email']) ? $_POST['email'] : "";
        $tinh = isset($_POST['tinh']) && $_POST['tinh'] !== '-1' ? $_POST['tinh'] : '';
        $quan = isset($_POST['quan']) && $_POST['quan'] !== '-1' ? $_POST['quan'] : '';
        $xa = isset($_POST['xa']) && $_POST['xa'] !== '-1' ? $_POST['xa'] : '';

        $diachi = isset($_POST['diachi']) ? $_POST['diachi'] : '';
        $diachiCuThe = $diachi . " " . $xa . " " . $quan . " " . $tinh;


        $targetDir = 'public/images/';
        $thumbImgName = $_FILES['thumb_img']['name'];
        $thumbImgTmpName = $_FILES['thumb_img']['tmp_name'];
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
            header("Location: ?page=info_user");
            exit;
        } else {
            echo '<script>
            alert("Bạn đã cập nhật thông tin không thành công");
        </script>';
        }
    }
}
?>

<script>
    function checkduLieu() {
        var fullname = document.getElementById('firstName').value.trim();
        var email = document.getElementById('email').value.trim();
        var phone = document.getElementById('phone').value.trim();
        var diachi = document.getElementById('diachi').value.trim();
        var tinh = document.querySelector('select[name="tinh"]').value;
        var quan = document.querySelector('select[name="quan"]').value;
        var xa = document.querySelector('select[name="xa"]').value;

        var isValid = true;

        if (fullname === '' || email === '' || phone === '' || diachi === '') {
            alert('Vui lòng điền đầy đủ thông tin và chọn địa chỉ.');
            isValid = false;
        }

        var emailError = document.getElementById('emailError');
        var emailRegex = /^[A-Za-z0-9_.]{6,32}@([a-zA-Z0-9]{2,12})(\.[a-zA-Z]{2,12})+$/;

        if (email.length === 0) {
            emailError.textContent = "Vui lòng nhập email của bạn";
            isValid = false;
        } else if (!emailRegex.test(email)) {
            emailError.textContent = "Email không hợp lệ. Vui lòng kiểm tra lại!";
            isValid = false;
        } else {
            emailError.textContent = "";
        }

        var sdtError = document.getElementById('sdtError');
        var phoneRegex = /^0[0-9]{9}$/;

        if (phone.length === 0) {
            sdtError.textContent = "Vui lòng nhập số điện thoại của bạn";
            isValid = false;
        } else if (!phoneRegex.test(phone)) {
            sdtError.textContent = "Số điện thoại không hợp lệ!";
            isValid = false;
        } else {
            sdtError.textContent = "";
        }

        var addressError = document.getElementById('addressError');

        if (diachi.length < 50) {
            if (tinh === '-1' || quan === '-1' || xa === '-1') {
                alert('Vui lòng điền đầy đủ chọn địa chỉ.');
                return false;

            }
        }
        if (diachi.length === 0) {
            addressError.textContent = "Vui lòng nhập địa chỉ của bạn";
            isValid = false;
        } else {
            addressError.textContent = "";
        }

        return isValid;
    }
</script>


<body>
    <div class="container">


        <form action="" style="display: flex;" method="post" class="update_info_user" enctype="multipart/form-data" onsubmit="return checkduLieu()">
            <div style="padding-right: 30px;">
                <h2 class="txt_title">Cập nhật thông tin</h2>
                <div class="avatar">
                    <div class="center-image">
                        <img id="avatar-image" src="<?php echo isset($item['user_avater']) ? $item['user_avater'] : ''; ?>">
                    </div>
                    <div style="padding-top: 10px;">
                        <span> UserName: <span style="font-weight: bold; color: #4CAF50;"><?php echo isset($item['username']) ? $item['username'] : ''; ?></span></span>
                    </div>
                    <input type="file" name="thumb_img" id="avatar-input" class="file-input" value="<?php echo isset($item['user_avater']) ? $item['user_avater'] : ''; ?>">
                </div>
            </div>

            <div>
                <div class="row">
                    <div class="col">
                        <label for="firstName">First Name:</label>
                        <input type="text" id="firstName" name="firstName" value="<?php echo isset($item['firstName']) ? $item['firstName'] : ''; ?>">
                    </div>
                    <div class="col">
                        <label for="LastName">Last Name:</label>
                        <input type="text" id="LastName" name="LastName" value="<?php echo isset($item['lastName']) ? $item['lastName'] : ''; ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="phone">Số Điện Thoại:</label>
                        <input type="text" id="phone" name="phone" value="<?php echo isset($item['phoneNumber']) ? $item['phoneNumber'] : ''; ?>">
                        <span class="text_error" id="sdtError"></span>
                    </div>
                    <div class="col">
                        <label for="email">Địa chỉ Email:</label>
                        <input type="email" id="email" name="email" value="<?php echo isset($item['email']) ? $item['email'] : ''; ?>">
                        <span class="text_error" id="emailError"></span>
                    </div>
                </div>

                <div class="row">
                    <div class="col_dress">
                        <div class="col-4">
                            <label for="tinh">Tỉnh/Thành phố</label>
                            <select name="tinh" id="tinh" class="province">
                                <option value="-1">Chọn tỉnh thành</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <label for="quan">Quận/Huyện</label>
                            <select name="quan" id="quan" class="district">
                                <option value="-1">Chọn quận/huyện</option>
                            </select>
                        </div>
                        <div class="col-4" style="float: right;">
                            <label for="xa">Phường/Xã</label>
                            <select name="xa" id="xa" class="town">
                                <option value="-1">Chọn phường/xã</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="diachi">Địa chỉ cụ thể:</label>
                        <input type="text" id="diachi" name="diachi" value="<?php echo isset($item['address']) ? $item['address'] : ''; ?>">
                        <span class="text_error" id="addressError"></span>
                    </div>
                </div>

                <div class="chucNang">
                    <button type="submit" class="btn_capnhat" name="btn_capNhat" id="btn_capNhat">Cập Nhật Thông Tin</button>
                    <a href="?page=info_user" class="btn_thontin" id="btn_thontin">Thông tin tài khoản</a>
                </div>
            </div>
        </form>


    </div>
</body>
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