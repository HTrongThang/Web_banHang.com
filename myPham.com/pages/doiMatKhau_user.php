<style>
    .text_error {
        color: red;
        font-size: 14px;
        font-weight: bold;
        display: block;
    }

    .container {
        width: 50%;
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
        width: 70%;
        padding: 0px 30px;
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

    .row .col input[type="password"],
    .row .col textarea {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
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

    .btn_capnhat {
        padding: 10px 20px;
        margin: 0 10px;
        background-color: #007bff;

        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn_capnhat:hover {
        background-color: #45a049;
    }

    .btn_doimatkhau {
        padding: 10px 20px;
        margin: 0 10px;
        background-color: #FFFF00;
        color: #333;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn_doimatkhau:hover {
        background-color: #d32f2f;
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

    if (isset($_POST['btn_doimatkhau'])) {
        $mkCu = isset($_POST['mkCu']) ? $_POST['mkCu'] : "";
        $mkMoi = isset($_POST['mkNew']) ? $_POST['mkNew'] : "";
        $username = $_SESSION["user"];


        $sql_query_user_info = "SELECT * FROM `users` WHERE `username`='$username'";
        $result_query_user_info = $connect->query($sql_query_user_info);

        if ($result_query_user_info->num_rows > 0) {
            $row_user_info = $result_query_user_info->fetch_assoc();
            $hashedPassword = $row_user_info['password'];

            if (password_verify($mkCu, $hashedPassword)) {
                $hashedNewPassword = password_hash($mkMoi, PASSWORD_DEFAULT);

                $update_password_query = "UPDATE `users` SET `password`='$hashedNewPassword' WHERE `username`='$username'";
                $result_update_password = $connect->query($update_password_query);

                if ($result_update_password) {
                    echo '<script>
                    alert("Mật khẩu đã được cập nhật thành công");
                    window.location.href = "?page=info_user";
                    </script>';
                } else {
                    echo '<script>
                    alert("Đã xảy ra lỗi. Vui lòng thử lại sau.");
                    window.location.href = "?page=doiMatKhau_user";
                    </script>';
                }
            } else {
                echo '<script>
                alert("Mật khẩu cũ không chính xác. Vui lòng thử lại.");
                window.location.href = "?page=doiMatKhau_user";
                </script>';
            }
        } else {
            echo '<script>
            alert("Không tìm thấy thông tin người dùng. Vui lòng thử lại sau.");
            window.location.href = "?page=doiMatKhau_user";
            </script>';
        }
    }
}
?>
<script>
    function validateForm() {
        var mkCu = document.getElementById("mkCu").value;
        var mkMoi = document.getElementById("mkNew").value;
        var xnMK = document.getElementById("xnMK").value;
        var passError = document.getElementById('passwordError');
        var pass_oldError = document.getElementById('passwor_olddError');
        var pass_newError = document.getElementById('passwordNew_Error');

        var passwordRegex = /^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/;

        if (mkCu == "" || mkMoi == "" || xnMK == "") {
            alert("Vui lòng điền đầy đủ thông tin mật khẩu.");
            return false;
        }

        if (mkMoi != xnMK) {
            alert("Mật khẩu mới và xác nhận mật khẩu không khớp nhau.");
            return false;
        }


        if (mkCu.length === 0) {
            passError.textContent = "Vui lòng nhập mật khẩu!";
            return false;
        } else if (mkCu.length < 6) {
            passError.textContent = "Mật khẩu phải có ít nhất 6 ký tự!";
            return false;
        } else if (mkCu.length > 32) {
            NameError.textContent = "Mật khẩu không được vượt quá 32 ký tự";
            return false;
        } else if (!passwordRegex.test(mkCu)) {
            passError.textContent = "Mật khẩu không đáp ứng yêu cầu: phải bắt đầu bằng chữ cái đầu viết hoa, bao gồm chữ cái, số, và các ký tự đặc biệt.";
            return false;
        } else {
            passError.textContent = "";
        }

        if (mkMoi.length === 0) {
            pass_oldError.textContent = "Vui lòng nhập mật khẩu!";
            return false;
        } else if (mkMoi.length < 6) {
            pass_oldError.textContent = "Mật khẩu phải có ít nhất 6 ký tự!";
            return false;
        } else if (mkMoi.length > 32) {
            pass_oldError.textContent = "Mật khẩu không được vượt quá 32 ký tự";
            return false;
        } else if (!passwordRegex.test(mkMoi)) {
            pass_oldError.textContent = "Mật khẩu không đáp ứng yêu cầu: phải bắt đầu bằng chữ cái đầu viết hoa, bao gồm chữ cái, số, và các ký tự đặc biệt.";
            return false;
        } else {
            pass_oldError.textContent = "";
        }


        return true;
    }
</script>

<body>
    <div class="container" style="display: flex;">
        <div>
            <h2 class="txt_title">Đổi mật khẩu</h2>
            <div class="avatar">
                <div class="center-image">
                    <img id="avatar-image" src="<?php echo isset($item['user_avater']) ? $item['user_avater'] : ''; ?>">
                </div>
                <div style="padding-top: 10px;">
                    <span> UserName: <span style="font-weight: bold; color: #4CAF50;"><?php echo isset($item['username']) ? $item['username'] : ''; ?></span></span>
                </div>
            </div>
        </div>


        <form class="update_info_user" method="post" onsubmit="return validateForm()">
            <div>
                <div class="row">
                    <div class="col">
                        <label for="mkCu">Mật khẩu cũ:</label>
                        <input type="password" id="mkCu" name="mkCu">
                        <span class="text_error" id="passwordError"> </span>

                    </div>

                </div>
                <div class="row">

                    <div class="col">
                        <label for="mkNew">Mật Khẩu mới:</label>
                        <input type="password" id="mkNew" name="mkNew">
                        <span class="text_error" id="passwor_olddError"> </span>

                    </div>

                </div>
                <div class="row">

                    <div class="col">
                        <label for="xnMK">Nhập lại mật khẩu:</label>
                        <input type="password" id="xnMK" name="xnMK">
                        <span class="text_error" id="passwordNew_Error"> </span>

                    </div>
                </div>


            </div>


            <div class="chucNang">
                <button type="submit" class="btn_doimatkhau" name="btn_doimatkhau" id="btn_doimatkhau">Đổi mật khẩu</button>

                <a href="?page=info_user" class="btn_thontin" id="btn_thontin">Thông tin tài khoản </a>
            </div>

        </form>

    </div>
</body>