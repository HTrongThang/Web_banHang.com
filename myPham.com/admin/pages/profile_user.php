<style>
    .card {
        margin-bottom: 20px;
    }

    .card-title {
        font-weight: 500;
        font-size: 20px;

        font-family: ui-serif;
    }

    .card-header {
        background-color: #62a9d3;
        color: black;
        padding: 10px;
    }

    .card-body {
        padding: 20px;
    }


    .form-group {
        margin-bottom: 20px;
    }

    label {
        font-weight: bold;
    }


    select.form-control {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }


    .container {
        width: 100%;
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
        float: right;
        margin-right: 20px;
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

    .row .col select {
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

    .avatar_user_info {
        text-align: center;
    }

    .avatar_user_info img {
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
</style>
<?php
$id = $_GET['id'];

$sql = "SELECT * FROM users WHERE userID = $id";

$result = $connect->query($sql);

if ($result->num_rows > 0) {
    $row_user = $result->fetch_assoc();
}

$sql_count_order = "SELECT COUNT(*) AS total_orders
FROM orders
JOIN order_details ON orders.orderID = order_details.orderID
WHERE orders.id_user = '$id'";
$result_count = $connect->query($sql_count_order);

if ($result_count->num_rows > 0) {
    $row = $result_count->fetch_assoc();
    $total_orders = $row['total_orders'];
}

$sql_total_amount = "SELECT SUM(order_details.price * order_details.quantity) AS total_amount
                     FROM orders
                     JOIN order_details ON orders.orderID = order_details.orderID
                     WHERE orders.id_user = '$id'";
$result_total_amount = $connect->query($sql_total_amount);

if ($result_total_amount->num_rows > 0) {
    $row = $result_total_amount->fetch_assoc();
    $total_amount = $row['total_amount'];
}
?>



<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php require 'inc/sidebar.php'; ?>
        <div id="content" class="fl-right">

            <div class="section" id="detail-page">
                <section class="content">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title"> <i class="fa-regular fa-user" aria-hidden="true"></i> Thông tin người dùng</h2>
                        </div>
                        <div class="container" style="display: flex;">
                            <div class="avatar_user_info">
                                <div class="center-image">

                                    <img id="avatar-image" src="/project/Web_banHang.com/myPham.com/<?php echo isset($row_user['user_avater']) ? trim($row_user['user_avater']) : ''; ?>">

                                </div>
                                <div style="padding-top: 10px;">
                                    <span> UserName: <span style="font-weight: bold; color: #4CAF50;"><?php echo isset($row_user['username']) ? $row_user['username'] : ''; ?></span></span>
                                </div>
                            </div>

                            <form class="update_info_user">
                                <div>
                                    <div class="row">
                                        <div class="col">
                                            <label for="lastName">Last Name:</label>
                                            <input type="text" id="lastName" name="lastName" disabled value="<?php echo isset($row_user['lastName']) ? $row_user['lastName'] : ''; ?>">
                                        </div>
                                        <div class="col">
                                            <label for="fristName">First name:</label>
                                            <input type="text" id="fristName" name="fristName" disabled value="<?php echo isset($row_user['firstName']) ? $row_user['firstName'] : ''; ?>">
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <label for="phone">Số Điện Thoại:</label>
                                            <input type="text" id="phone" name="phone" disabled value="<?php echo isset($row_user['phoneNumber']) ? $row_user['phoneNumber'] : ''; ?>">
                                        </div>
                                        <div class="col">
                                            <label for="email">Địa chỉ Email:</label>
                                            <input type="email" id="email" name="email" disabled value="<?php echo isset($row_user['email']) ? $row_user['email'] : ''; ?>">
                                        </div>

                                    </div>


                                    <div class="row">
                                        <div class="col">
                                            <label for="adress">Địa chỉ cụ thể:</label>
                                            <input type="text" id="adress" name="adress" disabled value="<?php echo isset($row_user['address']) ? $row_user['address'] : ''; ?>">
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label for="lastName">Tổng đơn hàng:</label>
                                            <input type="text" id="lastName" name="lastName" disabled value="<?php echo $total_orders ?>">
                                        </div>
                                        <div class="col">
                                            <label for="fristName">Tổng tiền:</label>
                                            <input type="text" id="fristName" name="fristName" disabled value="<?php echo number_format($total_amount, 0, ',', '.') ?> VND">
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label for="activation">Kích hoạt tài khoản:</label>
                                            <select id="activation" name="activation">
                                                <option value="" selected>Vui lòng chọn kích hoạt tài khoản mới ?</option>

                                                <option value="1">Có</option>
                                                <option value="0">Không</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="upgrade">Nâng cấp tài khoản:</label>
                                            <select id="upgrade" name="upgrade">
                                                <option value="" selected>Vui lòng chọn nâng cấp user ?</option>

                                                <option value="user">User</option>
                                                <option value="admin">Admin</option>
                                            </select>
                                        </div>
                                    </div>
                            

                            </form>

                        </div>


                    </div>

                </section>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#activation').change(function() {
            var selectedValue = $(this).val();
            $.ajax({
                url: '?page=xuLykichHoat',
                method: 'POST',
                data: {
                    activationValue: selectedValue,
                    iduser: <?php echo $id; ?>

                },
                success: function(response) {
                    alert(response);
                }
            });
        });
        $('#upgrade').change(function() {
            var selectedValue = $(this).val();
            $.ajax({
                url: '?page=xuLyNangCap',
                method: 'POST',
                data: {
                    activationValue: selectedValue,
                    iduser: <?php echo $id; ?>

                },
                success: function(response) {
                    alert(response);
                }
            });
        });

    });
</script>