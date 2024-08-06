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
        width: 80%;
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

    .row .col input[type="text"],
    .row .col input[type="email"],
    .row .col textarea {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }



    button.btn_capnhat {
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
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
        background-color: #007bff;
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

    .text_error {
        color: red;
        font-size: 14px;
        font-weight: bold;
        display: block;
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
}
?>

<body>
    <div class="container" style="display: flex;">
        <div>
            <h2 class="txt_title">Thông tin</h2>
            <div class="avatar">
                <div class="center-image">

                    <img id="avatar-image" src="<?php echo isset($item['user_avater']) ? $item['user_avater'] : ''; ?>">
                </div>
                <div style="padding-top: 10px;">
                    <span> UserName: <span style="font-weight: bold; color: #4CAF50;"><?php echo isset($item['username']) ? $item['username'] : ''; ?></span></span>
                </div>
            </div>
        </div>

        <form class="update_info_user">
            <div>
                <div class="row">
                    <div class="col">
                        <label for="lastName">Last Name:</label>
                        <input type="text" id="lastName" name="lastName" disabled value="<?php echo isset($item['lastName']) ? $item['lastName'] : ''; ?>">
                    </div>
                    <div class="col">
                        <label for="fristName">first name:</label>
                        <input type="text" id="fristName" name="fristName" disabled value="<?php echo isset($item['firstName']) ? $item['firstName'] : ''; ?>">
                    </div>

                </div>

                <div class="row">
                    <div class="col">
                        <label for="phone">Số Điện Thoại:</label>
                        <input type="text" id="phone" name="phone" disabled value="<?php echo isset($item['phoneNumber']) ? $item['phoneNumber'] : ''; ?>">
                    </div>
                    <div class="col">
                        <label for="email">Địa chỉ Email:</label>
                        <input type="email" id="email" name="email" disabled value="<?php echo isset($item['email']) ? $item['email'] : ''; ?>">
                    </div>

                </div>


                <div class="row">
                    <div class="col">
                        <label for="adress">Địa chỉ cụ thể:</label>
                        <input type="text" id="adress" name="adress" disabled value="<?php echo isset($item['address']) ? $item['address'] : ''; ?>">
                    </div>

                </div>
            </div>


            <div class="chucNang">
                <a href="?page=update_imformation_user&id=<?php echo $item['userID'] ?>" class="btn_capnhat" id="btn_capNhat">Cập Nhật Thông Tin</a>
                <a href="?page=doiMatKhau_user&id=<?php echo $item['userID'] ?>" class="btn_doimatkhau" id="btn_doimatkhau">Đổi mật khẩu</a>
            </div>

        </form>

    </div>
</body>