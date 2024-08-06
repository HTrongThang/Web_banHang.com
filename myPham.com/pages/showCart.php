<style>
    table.table th,
    table.table td {
        padding: 8px 12px;
        text-align: center;
    }

    table.table th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    table.table tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .fixed_fotter {
        position: fixed;
        width: 100%;
        bottom: 0;
    }
</style>
<?php
$status_colors = array(
    1 => '#0dcaf0',
    2 => 'blue',
    3 => 'green',
    4 => 'purple',
    5 => 'red'
);
?>
<section class="content">
    <div class="card">
        <div class="card-header" style="text-align: center; text-transform: uppercase; font-size: 20px; font-weight: 900; padding: 20px 0px;">
            <h3 class="card-title"><i class="fa-solid fa-cart-plus"></i> Danh Sách Đơn Hàng </h3>
        </div>

        <div class="card-body">
            <div class=" container table-responsive" style="display: flex; justify-content: center;">
                <table class="table table-bordered " style="width: 90%;  box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.5);">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Mã Đơn Hàng</th>
                            <th>Tên Khách Hàng</th>
                            <th>Điện Thoại</th>
                            <th>Tổng Tiền</th>
                            <th>Trạng Thái</th>
                            <th>Ngày Tạo</th>
                            <th>Dự kiến ngày giao</th>

                            <th>Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $username = $_SESSION["user"];
                        $sql_query_user_id = "SELECT `userID` FROM `users` WHERE `username`='$username'";
                        $result_sql_query_user_id = $connect->query($sql_query_user_id);

                        if ($result_sql_query_user_id->num_rows > 0) {
                            $row_sql_query = $result_sql_query_user_id->fetch_assoc();
                            $user_id = $row_sql_query['userID'];

                            $sql_query_order = "SELECT * FROM `orders` WHERE `id_user`='$user_id' ORDER BY `orderDate` DESC";
                            $resut_sql_query_order = $connect->query($sql_query_order);

                            if ($resut_sql_query_order->num_rows > 0) {
                                $stt = 1;
                                while ($item = $resut_sql_query_order->fetch_assoc()) {
                        ?>
                                    <tr>
                                        <td><?php echo $stt; ?></td>
                                        <td><?php echo $item['code_order']; ?></td>
                                        <td><?php echo $item['name_customers']; ?></td>
                                        <td><?php echo $item['phone']; ?></td>
                                        <td><?php echo  number_format($item['totalPrice'], 0, '.', '.')  ?> VND</td>
                                        <td><span class="tbody-text" style=" font-weight: bold;   background: <?php $id_status = $item['orderStatusID'];
                                                                                                                echo $status_colors[$id_status]; ?>; color: white; padding: 5px; border-radius: 10px;"><?php
                                                                                                                                                                                                            $sql_select_status = "SELECT * FROM `order_status`";
                                                                                                                                                                                                            $result_select_status = $connect->query($sql_select_status);
                                                                                                                                                                                                            foreach ($result_select_status as $item_sta) {
                                                                                                                                                                                                                if ($item_sta['orderStatusID'] == $item['orderStatusID']) {
                                                                                                                                                                                                                    echo $item_sta['orderStatusName'];
                                                                                                                                                                                                                    break;
                                                                                                                                                                                                                }
                                                                                                                                                                                                            }
                                                                                                                                                                                                            ?></span></td>
                                        <td><?php echo $item['orderDate']; ?></td>
                                        <td><?php echo $item['shipDate']; ?></td>

                                        <td>
                                            <a href="?page=show_detail_cart&id=<?php echo $item['orderID'] ?>">
                                                <button type="button" class="btn btn-outline-primary">Xem chi tiết</button>
                                            </a>
                                        </td>
                                    </tr>
                        <?php
                                    $stt++;
                                }
                            }
                        }
                        ?>




                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>