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

<script>
    $(document).ready(function() {
        $("#status").change(function() {
            var txt_select = $(this).val();
            var txt_id = <?php echo json_encode($_GET['id']); ?>;
            var data = {
                txt_select: txt_select,
                txt_id: txt_id
            };

            $.ajax({
                url: '?page=update_status_order',
                method: 'POST',
                data: data,
                dataType: 'text',
                success: function(response) {
                    alert(response);
                    location.reload();
                }
            });
        });
    });
</script>

<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php require 'inc/sidebar.php'; ?>
        <div id="content" class="fl-right">

            <div class="section" id="detail-page">
                <section class="content">
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title"> <i class="fa-solid fa-cart-shopping"></i> Chi tiết đơn hàng </h2>
                        </div>
                        <?php
                        $status_colors = array(
                            1 => '#0dcaf0',
                            2 => 'blue',
                            3 => 'green',
                            4 => 'purple',
                            5 => 'red'
                        );
                        $id = $_GET['id'];
                        $sql_select_order_by_id = "SELECT * FROM `orders` WHERE `orderID`=$id";
                        $result_sql_select_order_by_id = $connect->query($sql_select_order_by_id);
                        if ($result_sql_select_order_by_id->num_rows > 0) {
                            $row_sql_select_order_by_id = $result_sql_select_order_by_id->fetch_assoc();
                            $color = $status_colors[$row_sql_select_order_by_id['orderStatusID']];

                        ?>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="" style="margin: 0px;">
                                            <label>Mã đơn hàng</label>
                                            <p class="form-control"><?php echo $row_sql_select_order_by_id['code_order']; ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="">
                                            <label>Họ tên khách</label>
                                            <p class="form-control"><?php echo $row_sql_select_order_by_id['name_customers']; ?></p>

                                        </div>

                                    </div>


                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="">
                                            <label>Tổng tiền</label>
                                            <p class="form-control"><?php echo  number_format($row_sql_select_order_by_id['totalPrice'], 0, '.', '.')  ?> VND</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="">
                                            <label>Số điện thoại</label>
                                            <p class="form-control"><?php echo $row_sql_select_order_by_id['phone']; ?></p>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="">
                                            <label>Ngày đặt</label>
                                            <p class="form-control"><?php echo $row_sql_select_order_by_id['shipDate']; ?></p>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="">
                                            <label>Email</label>
                                            <p class="form-control"><?php echo $row_sql_select_order_by_id['email']; ?></p>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">

                                        <label for="status">Tình trạng đơn hàng:</label>
                                        <select class="form-control" name="status" id="status" style="color: <?php echo $color;  ?>;">
                                            <?php

                                            $sql_update_order_status = "SELECT * FROM `order_status`";
                                            $result__update_order_status = $connect->query($sql_update_order_status);
                                            foreach ($result__update_order_status as $item_sta) {
                                                $colors = $status_colors[$item_sta['orderStatusID']];

                                            ?>
                                                <option value="<?php echo  $item_sta['orderStatusID'] ?>" <?php echo ($item_sta['orderStatusID'] == $row_sql_select_order_by_id['orderStatusID'] ? "selected" : " ") ?> style="color: <?php echo  $colors;  ?>;"><?php echo $item_sta['orderStatusName'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-12">
                                        <table class="table table-bordered">
                                            <div class="col-12">
                                                <h2 class="card-title" style="text-align: center; font-weight: bold;"> Chi tiết sản phẩm</h2>
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
                                                $sql_details_order_product = "SELECT * FROM `order_details` WHERE `orderID`=$id";
                                                $details_order_product = $connect->query($sql_details_order_product);
                                                if ($details_order_product->num_rows > 0) {
                                                    $stt = 1;
                                                    foreach ($details_order_product as $item) {
                                                        $productId = $item['productID'];
                                                        $sql_getProductNameByID = "SELECT `productName` FROM `product` WHERE `productID`=$productId";
                                                        $resultProductName = $connect->query($sql_getProductNameByID);
                                                        $rowProductName = $resultProductName->fetch_assoc();
                                                        $productName = $rowProductName['productName'];

                                                ?>
                                                        <tr>
                                                            <td><?php echo $stt; ?></td>
                                                            <td><?php echo $productName; ?></td>
                                                            <td><?php echo $item['quantity']; ?></td>
                                                            <td><?php echo number_format($item['price'], 0, '.', '.') ?> VND</td>
                                                            <td><?php $tatol = (int)$item['price'] * (int)$item['quantity'];
                                                                echo number_format($tatol, 0, '.', '.')
                                                                ?> VND</td>
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

                                                <p class="total-price">Tổng tiền: <strong> <?php echo  number_format($row_sql_select_order_by_id['totalPrice'], 0, '.', '.')  ?> VND</strong></p>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        <?php
                        }
                        ?>

                        <!-- /.card-body -->

                        <!-- /.card-footer-->
                    </div>
                    <!-- /.card -->

                </section>
            </div>
        </div>
    </div>