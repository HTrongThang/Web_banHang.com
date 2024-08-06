<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
    }

    .container {
        max-width: 800px;
        margin: 50px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        color: #333;
        font-size: 30px;
        font-weight: 900;
        font-family: emoji;
    }

    h2 {
        font-weight: bold;
        font-size: 20px;
        padding-bottom: 10px;
    }

    p {
        margin-bottom: 10px;
        color: #555;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th,
    td {
        padding: 10px;
        border-bottom: 1px solid #ddd;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
        font-weight: bold;
        color: #333;
    }

    .btn-container {
        text-align: center;
        margin-top: 20px;
    }

    .btn {
        display: inline-block;
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .btn:hover {
        background-color: #0056b3;
    }

    strong {
        color: #007bff;
    }
</style>

<?php
echo "<script>alert('Bạn đã đặt hàng thành công');</script>";

$sql_select_order = "SELECT * FROM `orders` WHERE `orderID`=$id_order";
$result_order = $connect->query($sql_select_order);

?>

<body>
    <div class="container">
        <?php
        if ($result_order->num_rows > 0) {
            $rowz_select_order = $result_order->fetch_assoc();
        ?>
            <h1>Đơn hàng đã đặt thành công</h1>
            <p><strong>Tên:</strong> <?php echo $rowz_select_order['name_customers'] ?></p>
            <p><strong>Địa chỉ:</strong> <?php echo $rowz_select_order['address'] ?></p>
            <p><strong>Email:</strong> <?php echo $rowz_select_order['email'] ?></p>
            <p><strong>Mã đơn hàng:</strong> <?php echo $rowz_select_order['code_order'] ?></p>
            <p><strong>Ngày đặt hàng:</strong> <?php echo $rowz_select_order['orderDate'] ?></p>
            <p><strong>Ngày dự kiến giao hàng:</strong><?php echo $rowz_select_order['shipDate'] ?></p>
            <p><strong>Ghi Chú:</strong><?php echo $rowz_select_order['note'] ?></p>

            <p>Cảm ơn <strong style="font-weight: bold; color: #333;"><?php echo $rowz_select_order['name_customers'] ?></strong> đã đặt hàng của chúng tôi. Đơn hàng của bạn<strong style="font-weight: bold; color: #333;"> đang chờ được xác nhận</strong> và
                sẽ được xử lý trong thời gian sớm nhất.</p>
            <p>Vui lòng kiểm tra email của bạn để biết thêm thông tin chi tiết về đơn hàng.</p>

            <!-- Thông tin sản phẩm -->
            <div class="order-details">
                <h2>Thông tin sản phẩm</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql_select_order_detail = "SELECT * FROM `order_details` WHERE `orderID`=$id_order";
                        $result_select_order_detail = $connect->query($sql_select_order_detail);
                        foreach ($result_select_order_detail as $item) {
                        ?>
                            <tr>
                                <td><?php echo  $item['productCode'] ?></td>
                                <td><?php echo  number_format($item['price'], 0, '.', '.') ?></td>
                                <td><?php echo  $item['quantity'] ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <p style="    float: right;"><strong style="padding-right: 5px; margin-bottom: 20px;">Tổng tiền:</strong><?php echo  number_format($rowz_select_order['totalPrice'], 0, '.', '.') ?>VND</p>

            <div class="btn-container">
                <a href="index.php" class="btn" style="padding: 8px !important;">Trở lại trang chủ</a>
            </div>
        <?php
        }
        ?>

    </div>
</body>