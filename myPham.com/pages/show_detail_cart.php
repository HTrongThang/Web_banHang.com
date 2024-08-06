<style>
    #main-content-wp {
        padding: 20px;
    }

    .card {
        border-radius: 10px;
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    .card-header {
        background-color: #007bff;
        color: #fff;
        padding: 15px 20px;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .card-body {
        padding: 30px;
    }

    .form-control {
        display: block;
        width: 100%;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .huydon button {
        background-color: red;
        color: white;
        border: none;
        padding: 5px 20px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .huydon button:hover {
        background-color: darkred;
    }


    .form-control:focus {
        color: #495057;
        background-color: #fff;
        border-color: #80bdff;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .table-bordered {
        border: 1px solid #dee2e6;
        border-collapse: collapse;
        width: 100%;
    }

    .table-bordered th,
    .table-bordered td {
        padding: 12px 15px;
        text-align: center;
    }
</style>
<script>
    function deleteOrder(   , tg) {
        var txt_id = id;
        var txt_tg = tg;

        $.ajax({
            url: '?page=huyDotHang',
            method: 'POST',
            data: {
                id: txt_id,
                tg: txt_tg
            },
            dataType: 'json',
            success: function(response) {
                if (response === true) {
                    alert('Bạn đã hủy thành công đơn hàng');
                    window.location.href = '?page=showCart';
                } else {
                    alert('Hủy đơn không thành công. Chỉ được phép hủy đơn đang chờ xác nhận');
                }
            }
        });
    }
</script>
<div id="main-content-wp" class="list-product-page" style="display: flex; justify-content: center;">
    <div class="section" id="detail-page" style="width: 80%;">
        <section class="content">
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
                                <select class="form-control" name="status" id="status" style="color: <?php echo $color; ?>">
                                    <?php
                                    $id_status = $row_sql_select_order_by_id['orderStatusID'];
                                    $sql_update_order_status = "SELECT `orderStatusID`, `orderStatusName` FROM `order_status` WHERE `orderStatusID`='$id_status'";
                                    $result__update_order_status = $connect->query($sql_update_order_status);

                                    if ($result__update_order_status->num_rows > 0) {
                                        $row_update_order_status = $result__update_order_status->fetch_assoc();
                                        $selected_status_id = $row_update_order_status['orderStatusID'];
                                        $selected_status_name = $row_update_order_status['orderStatusName'];
                                    ?>
                                        <option value="<?php echo $selected_status_id ?>" style="color: <?php echo $color; ?>" selected><?php echo $selected_status_name ?></option>
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
                                        ?>
                                                <tr>
                                                    <td><?php echo $stt; ?></td>
                                                    <td><?php echo $item['productID']; ?></td>
                                                    <td><?php echo $item['quantity']; ?></td>
                                                    <td><?php echo number_format($item['price'], 0, '.', '.') ?> VND</td>
                                                    <td><?php $tatol = (int)$item['price'] * (int)$item['quantity'];
                                                        echo number_format($tatol, 0, '.', '.')
                                                        ?> VND</td>
                                                </tr>
                                        <?php
                                                $stt++;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row" style="margin-top: 10px; padding-right: 30px;">
                                <div class="col-12">
                                    <div style="float: right;">
                                        <p class="total-price">Tổng tiền: <strong><?php echo  number_format($row_sql_select_order_by_id['totalPrice'], 0, '.', '.')  ?> VND</strong></p>
                                    </div>
                                    <div class="huydon">
                                        <button onclick="deleteOrder(<?php echo $item['orderID'] ?>, <?php echo $row_sql_select_order_by_id['orderStatusID'] ?>)">Hủy đơn hàng</button>
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