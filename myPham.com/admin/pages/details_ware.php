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

    .col-md-6 {
        padding-right: 15px;
        padding-left: 15px;
    }

    .table {
        margin-bottom: 20px;
    }

    .table th,
    .table td {
        padding: 10px;
        text-align: center;
    }

    .table thead th {
        background-color: #62a9d3;
        color: black;
    }



    .col-12 h2 {
        font-size: 24px;
        color: #007bff;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        font-weight: bold;
    }

    button.btn {
        margin-top: 10px;
    }

    select.form-control {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    button.btn-primary {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }

    button.btn-primary:hover {
        background-color: #0056b3;
    }

    .product-quantity,
    .total-price {
        font-size: 16px;
        color: #333;
    }


    .total-price strong {
        font-size: 18px;

    }
</style>



<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php require 'inc/sidebar.php'; ?>
        <div id="content" class="fl-right">

            <div class="section" id="detail-page">
                <section class="content">
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title"> <i class="fa-solid fa-cart-shopping"></i> Chi tiết đơn hàng nhập </h2>
                        </div>
                        <?php

                        $id = $_GET['id'];
                        $sql_select_order_by_id = "SELECT * FROM `tbl_warehousereceipt` WHERE `id_PN`=$id";
                        $result_sql_select_order_by_id = $connect->query($sql_select_order_by_id);
                        if ($result_sql_select_order_by_id->num_rows > 0) {
                            $row_sql_select_order_by_id = $result_sql_select_order_by_id->fetch_assoc();

                        ?>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="" style="margin: 0px;">
                                            <label>Mã đơn hàng</label>
                                            <p class="form-control"><?php echo $row_sql_select_order_by_id['code_PN']; ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="">
                                            <label>Nhà cung cấp</label>
                                            <p class="form-control"><?php
                                                                    $id_NCC = $row_sql_select_order_by_id['id_NCC'];
                                                                    $sql = "SELECT `tenNCC` FROM `tbl_supplier` WHERE `id` = $id_NCC";
                                                                    $result = $connect->query($sql);

                                                                    if ($result->num_rows > 0) {
                                                                        $row = $result->fetch_assoc();
                                                                        $tenNCC = $row['tenNCC'];
                                                                        echo $tenNCC;
                                                                    } else {
                                                                        echo "Không tìm thấy nhà cung cấp";
                                                                    }
                                                                    ?>

                                            </p>

                                        </div>

                                    </div>


                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="">
                                            <label>Tổng tiền</label>
                                            <p class="form-control"><?php echo  number_format($row_sql_select_order_by_id['totalCost'], 0, '.', '.')  ?> VND</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="">
                                            <label>Ngày đặt</label>
                                            <p class="form-control"><?php echo $row_sql_select_order_by_id['dateAdded']; ?></p>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="">
                                            <label>Nhân viên đặt</label>
                                            <p class="form-control">
                                                <?php
                                                // Lấy ra tên của nhân viên dựa trên userID
                                                $userID = $row_sql_select_order_by_id['userID'];;
                                                $sql = "SELECT `firstName`, `lastName` FROM `users` WHERE `userID` = $userID";
                                                $result = $connect->query($sql);

                                                // Kiểm tra và hiển thị tên nhân viên
                                                if ($result->num_rows > 0) {
                                                    $row = $result->fetch_assoc();
                                                    $fullName = $row['firstName'] . ' ' . $row['lastName'];
                                                    echo $fullName;
                                                } else {
                                                    echo "Không tìm thấy thông tin nhân viên";
                                                }
                                                ?>

                                        </div>
                                    </div>

                                </div>


                                <div class="row">

                                    <div class="col-12">
                                        <table class="table table-bordered">
                                            <div class="col-12">
                                                <h2 class="card-title" style="text-align: center; font-weight: bold;"> Chi tiết sản phẩm nhập hàng</h2>
                                            </div>
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Tên sản phẩm</th>
                                                    <th>Giá</th>
                                                    <th>Số lượng</th>
                                                    <th>Thành tiền</th>
                                                </tr>

                                            </thead>
                                            <tbody>

                                                <?php
                                                $sql_details_order_product = "SELECT * FROM `tbl_warehousereceipt_details` WHERE `id_PN`=$id";
                                                $details_order_product = $connect->query($sql_details_order_product);
                                                if ($details_order_product->num_rows > 0) {
                                                    $stt = 1;
                                                    foreach ($details_order_product as $item) {
                                                ?>
                                                        <tr>
                                                            <td><?php echo $stt; ?></td>
                                                            <td><?php
                                                                $productID = $item['id_product'];
                                                                $sql = "SELECT `productName` FROM `product` WHERE `productID` = $productID";
                                                                $result = $connect->query($sql);
                                                                if ($result->num_rows > 0) {
                                                                    $row = $result->fetch_assoc();
                                                                    $productName = $row['productName'];
                                                                    echo $productName;
                                                                } else {
                                                                    echo "Không tìm thấy thông tin sản phẩm";
                                                                }        ?></td>
                                                            <td><?php echo $item['quantity']; ?></td>
                                                            <td><?php echo number_format($item['price'], 0, '.', '.') ?> VND</td>
                                                            <td><?php echo number_format($item['totalCost'], 0, '.', '.') ?> VND</td>
                                                        </tr>
                                                <?php
                                                    }
                                                }
                                                ?>


                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row " style="margin-top: 10px;padding-right: 30px;">
                                        <div class="col-12">
                                            <div style="float: right;">

                                                <p class="total-price">Tổng tiền: <strong> <?php echo  number_format($row_sql_select_order_by_id['totalCost'], 0, '.', '.')  ?> VND</strong></p>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        <?php
                        }
                        ?>


                    </div>

                </section>
            </div>
        </div>
    </div>