<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>



<style>
    .card-body {
        padding: 20px;
        background-color: #f8f9fc;
    }

    .media {
        border-radius: 8px;
        padding: 15px;
        background-color: #fff;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .media-body h5 {
        font-size: 18px;
        margin-bottom: 5px;
    }

    .media-body p {
        font-size: 16px;
        margin-bottom: 0;
    }

    .badge {
        font-size: 14px;
        padding: 8px 12px;
        border-radius: 20px;
    }

    .badge-soft-success {
        background-color: #4caf50;
        color: #fff;
    }

    .text-primary {
        color: #3f51b5;
    }

    .text-muted {
        color: #757575;
    }

    #myChart {
        width: 100%;
        max-width: 600px;
        height: 500px;
        margin: 20px auto;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .font-size-sm {
        font-size: 0.875rem;
        font-weight: bold;
    }

    .fa_zise {
        font-size: 24px;
        margin-right: 10px;

    }

    .fa-money-bill {
        color: #007bff;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        border-right: none;
        border-left: none;
    }

    .table thead tr {
        background-color: #f2f2f2;
    }



    .table tfoot tr {
        background-color: #f2f2f2;
    }

    .table td,
    .table th {
        border: none;
        text-align: left;
        vertical-align: middle !important;
    }

    .table td input[type="checkbox"] {
        margin: 0;
    }

    .btn {

        cursor: pointer;
    }

    .btn:hover {
        background-color: #0056b3;
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
// Truy vấn để lấy tổng số người dùng
$sql_total_users = "SELECT COUNT(*) AS total_users FROM users";
$result_total_users = $connect->query($sql_total_users);
$row_total_users = $result_total_users->fetch_assoc();
$totalUsers = $row_total_users["total_users"];

// Truy vấn để lấy số lượng người dùng trong tháng hiện tại
$currentMonth = date('m');
$currentYear = date('Y');
$sql_current_month = "SELECT COUNT(*) AS total_users 
                     FROM users 
                     WHERE MONTH(isTime) = $currentMonth AND YEAR(isTime) = $currentYear";
$result_current_month = $connect->query($sql_current_month);

$row_current_month = $result_current_month->fetch_assoc();
$totalUsersCurrentMonth = $row_current_month["total_users"];


// Truy vấn để lấy số lượng người dùng trong tháng trước
$lastMonth = date('m', strtotime('-1 month'));
$lastYear = date('Y', strtotime('-1 month'));
$sql_last_month = "SELECT COUNT(*) AS total_users 
                   FROM users 
                   WHERE MONTH(isTime) = $lastMonth AND YEAR(isTime) = $lastYear";

$result_last_month = $connect->query($sql_last_month);
$row_last_month = $result_last_month->fetch_assoc();
$totalUsersLastMonth = $row_last_month["total_users"];


// Tính tỷ lệ tăng trưởng

$growthRateMoney = 0;
if ($totalUsersLastMonth > 0) {
    $growthRate = (($totalUsersCurrentMonth - $totalUsersLastMonth) / $totalUsersLastMonth) * 100;
}

?>
<?php
$num_per_page = 8;

$page = isset($_GET['trang']) ? $_GET['trang'] : 1;

$sql_count = "SELECT COUNT(*) AS total_rows FROM `orders`";
$result_count = $connect->query($sql_count);
$row_count = $result_count->fetch_assoc();
$total_rows = $row_count['total_rows'];



$num_pages = ceil($total_rows / $num_per_page);

$start = ($page - 1) * $num_per_page;


?>

<script>
    function delete_ordee(id, idstatus) {
        var xacNhan = confirm("Bạn có muốn xóa đơn hàng này không");


        if (xacNhan) {
            if (idstatus == 5) {
                $.ajax({
                    url: '?page=delete_order',
                    method: 'POST',
                    data: {
                        id: id
                    },
                    dataType: 'text',
                    success: function(response) {
                        alert(response);
                        location.reload();


                    },
                    error: function() {
                        alert("Có lỗi xảy ra khi xóa đơn hàng!");
                    }
                });
            } else {
                alert("Bạn đã không xóa thành công đơn hàng. Vui lòng chỉ xóa những đơn hàng đã hủy");
            }
        }
    }
</script>
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php require 'inc/sidebar.php'; ?>
        <div id="content" class="fl-right">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6 col-lg">
                        <!-- Stats -->
                        <div class="media align-items-center" style="background-color: #ffc107; padding: 15px; border-radius: 8px;">
                            <i class="fa-solid fa_zise fa-user tio-xl text-primary mr-3"></i>
                            <div class="media-body">
                                <span class="d-block font-size-sm"> Tổng lượng người dùng</span>
                                <div class="d-flex align-items-center">
                                    <h3 class="mb-0" style="margin-right: 10px;"><?php echo $totalUsers ?> Người dùng</h3>

                                    <?php if ((int)$growthRate > 0) : ?>
                                        <span class="badge badge-soft-success ml-2">
                                            <i class="fa-solid fa-arrow-trend-up"></i> <?php echo number_format(abs($growthRate), 2); ?> %
                                        </span>
                                    <?php else : ?>
                                        <span class="badge bg-danger ml-2">
                                            <i class="fa-solid fa-arrow-trend-down"></i> <?php echo number_format(abs($growthRate), 2); ?> %
                                        </span>
                                    <?php endif; ?>

                                </div>
                            </div>
                        </div>

                        <!-- End Stats -->

                    </div>
                    <?php $sql = "SELECT SUM(totalPrice) AS total_sales FROM orders WHERE orderStatusID = '4'";

                    $result = $connect->query($sql);

                    if ($result->num_rows > 0) {
                        $sum = 0;
                        while ($row = $result->fetch_assoc()) {
                            $sum +=  $row["total_sales"];
                        }
                    }
                    $currentMonth = date('m');
                    $currentYear = date('Y');

                    $sqlCurrentMonth = "SELECT SUM(totalPrice) AS total_sales FROM orders WHERE MONTH(orderDate) = $currentMonth AND YEAR(orderDate) = $currentYear AND orderStatusID = '4'";
                    $resultCurrentMonth = $connect->query($sqlCurrentMonth);
                    $totalSalesCurrentMonth = 0;

                    if ($resultCurrentMonth->num_rows > 0) {
                        while ($row = $resultCurrentMonth->fetch_assoc()) {
                            $totalSalesCurrentMonth = (int) $row["total_sales"];
                        }
                    }

                    // Tính tổng doanh thu của tháng trước
                    $lastMonth = date('m', strtotime('-1 month'));
                    $lastYear = date('Y', strtotime('-1 month'));

                    $sqlLastMonth = "SELECT SUM(totalPrice) AS total_sales FROM orders WHERE MONTH(orderDate) = $lastMonth AND YEAR(orderDate) = $lastYear AND orderStatusID = '4'";
                    $resultLastMonth = $connect->query($sqlLastMonth);
                    $totalSalesLastMonth = 0;


                    if ($resultLastMonth->num_rows > 0) {
                        while ($row = $resultLastMonth->fetch_assoc()) {
                            $totalSalesLastMonth = (int) $row["total_sales"];
                        }
                    }

                    // So sánh tổng doanh thu của tháng này với tháng trước
                    $difference = $totalSalesCurrentMonth - $totalSalesLastMonth;

                    $growthRateMoney = 0;
                    if ($totalSalesLastMonth > 0) {
                        $growthRateMoney = (($totalSalesCurrentMonth - $totalSalesLastMonth) / $totalSalesLastMonth) * 100;
                    }




                    ?>

                    <div class="col-sm-6 col-lg column-divider-lg">
                        <!-- Stats -->
                        <div class="media align-items-center" style="background-color: #17a2b8; padding: 15px; border-radius: 8px;">
                            <i class="fa-solid  fa_zise fa-money-bill tio-xl text-primary mr-3"></i>
                            <div class="media-body">
                                <span class="d-block font-size-sm">Tổng doanh số bán hàng</span>
                                <div class="d-flex align-items-center">
                                    <h3 style="margin-right: 10px;" class="mb-0"><?php echo number_format((int)$sum); ?>VND</h3>
                                    <?php
                                    if ($growthRateMoney > 0) {
                                    ?>
                                        <span class="badge badge-soft-success ml-2">
                                            <i class="fa-solid fa-arrow-trend-up"></i> <?php echo number_format(abs($growthRateMoney), 2); ?> %
                                        </span>
                                    <?php
                                    } else if ($growthRateMoney < 0) {
                                    ?>
                                        <span class="badge bg-danger ml-2">
                                            <i class="fa-solid fa-arrow-trend-down"> </i> <?php echo number_format(abs($growthRateMoney), 2); ?> %
                                        </span>
                                    <?php
                                    }
                                    ?>


                                </div>
                            </div>
                        </div>
                        <!-- End Stats -->


                    </div>

                    <?php
                    $sql = "SELECT COUNT(*) AS total_orders FROM orders";
                    $result = $connect->query($sql);
                    $totalOrders = 0;
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $totalOrders = $row["total_orders"];
                    }
                    // Lấy tổng số đơn hàng của tháng hiện tại
                    $currentMonth = date('m');
                    $currentYear = date('Y');
                    $sqlCurrentMonth = "SELECT COUNT(*) AS total_orders FROM orders WHERE MONTH(orderDate) = $currentMonth AND YEAR(orderDate) = $currentYear";
                    $resultCurrentMonth = $connect->query($sqlCurrentMonth);
                    $totalOrdersCurrentMonth = 0;
                    if ($resultCurrentMonth->num_rows > 0) {
                        $row = $resultCurrentMonth->fetch_assoc();
                        $totalOrdersCurrentMonth = $row["total_orders"];
                    }

                    // Lấy tổng số đơn hàng của tháng trước
                    $lastMonth = date('m', strtotime('-1 month'));
                    $lastYear = date('Y', strtotime('-1 month'));
                    $sqlLastMonth = "SELECT COUNT(*) AS total_orders FROM orders WHERE MONTH(orderDate) = $lastMonth AND YEAR(orderDate) = $lastYear";
                    $resultLastMonth = $connect->query($sqlLastMonth);
                    $totalOrdersLastMonth = 0;
                    if ($resultLastMonth->num_rows > 0) {
                        $row = $resultLastMonth->fetch_assoc();
                        $totalOrdersLastMonth = $row["total_orders"];
                    }

                    // Tính tỉ lệ tăng trưởng đơn hàng
                    if ($totalOrdersLastMonth != 0) {
                        $growthRate = (($totalOrdersCurrentMonth - $totalOrdersLastMonth) / $totalOrdersLastMonth) * 100;
                    } else {
                        $growthRate = 0;
                    }
                    ?>
                    <div class="col-sm-6 col-lg column-divider-lg">
                        <!-- Stats -->
                        <div class="media align-items-center" style="background-color: #03a9f4;">
                            <i class="fa-solid fa_zise fa-cart-shopping tio-xl text-primary mr-3"></i>
                            <div class="media-body">
                                <span class="d-block font-size-sm">Tổng đơn hàng</span>
                                <div class="d-flex align-items-center">
                                    <h3 style="margin-right: 10px;" class="mb-0"><?php echo $totalOrders; ?> Đơn hàng</h3>

                                    <?php
                                    if ((int)$growthRate  > 0) {
                                    ?>
                                        <span class="badge badge-soft-success ml-2">
                                            <i class="fa-solid fa-arrow-trend-up"></i> <?php echo number_format(abs($growthRate), 2); ?>%
                                        </span>

                                    <?php
                                    } else {
                                    ?>
                                        <span class="badge bg-danger ml-2">
                                            <i class="fa-solid fa-arrow-trend-down"> </i> <?php echo number_format(abs($growthRate), 2); ?>%
                                        </span>

                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <!-- End Stats -->


                    </div>
                    <?php
                    $sqlTotalQuantity = "SELECT SUM(`quantity`) AS total_quantity FROM `product` WHERE `trangThai` IN (1, 2)";
                    $resultTotalQuantity = $connect->query($sqlTotalQuantity);
                    $rowTotalQuantity = $resultTotalQuantity->fetch_assoc();
                    $totalQuantity = $rowTotalQuantity["total_quantity"];

                    // Tính tổng số lượng sản phẩm đã bán ra trong tháng này
                    $sqlSoldQuantityThisMonth = "SELECT SUM(od.quantity) AS total_sold_quantity
                                FROM order_details od
                                JOIN orders o ON od.orderID = o.orderID
                                WHERE o.orderStatusID = '4'
                                AND MONTH(o.orderDate) = MONTH(CURRENT_DATE())
                                AND YEAR(o.orderDate) = YEAR(CURRENT_DATE())";
                    $resultSoldQuantityThisMonth = $connect->query($sqlSoldQuantityThisMonth);
                    $rowSoldQuantityThisMonth = $resultSoldQuantityThisMonth->fetch_assoc();
                    $soldQuantityThisMonth = $rowSoldQuantityThisMonth["total_sold_quantity"];

                    // Tính tổng số lượng sản phẩm đã bán ra trong tháng trước
                    $sqlSoldQuantityLastMonth = "SELECT SUM(od.quantity) AS total_sold_quantity
                                FROM order_details od
                                JOIN orders o ON od.orderID = o.orderID
                                WHERE o.orderStatusID = '4'
                                AND MONTH(o.orderDate) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH)
                                AND YEAR(o.orderDate) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH)";
                    $resultSoldQuantityLastMonth = $connect->query($sqlSoldQuantityLastMonth);
                    $rowSoldQuantityLastMonth = $resultSoldQuantityLastMonth->fetch_assoc();
                    $soldQuantityLastMonth = $rowSoldQuantityLastMonth["total_sold_quantity"];


                    // Tính tỷ lệ phần trăm số lượng sản phẩm bán ra trong tháng này so v   ới tháng trước
                    if ($soldQuantityLastMonth > 0) {
                        $ratio = (($soldQuantityThisMonth - $soldQuantityLastMonth) / $soldQuantityLastMonth) * 100;
                    } else {
                        $ratio = 0;
                    }
                    ?>


                    <div class="col-sm-6 col-lg column-divider-lg">
                        <!-- Stats -->
                        <div class="media align-items-center" style="background-color: #607d8b;">
                            <i class="fa-brands fa_zise fa-product-hunt tio-xl text-primary mr-3"></i>
                            <div class="media-body">
                                <span class="d-block font-size-sm">Tổng sản phẩm trong kho</span>
                                <div class="d-flex align-items-center">
                                    <h3 class="mb-0" style="margin-right: 10px;"><?php echo $totalQuantity ?></h3>
                                    <?php
                                    if ((int)$growthRateMoney > 0) {
                                    ?>
                                        <span class="badge badge-soft-success ml-2">
                                            <i class="fa-solid fa-arrow-trend-up"></i> <?php echo number_format(abs($ratio), 2); ?>%
                                        </span>
                                    <?php
                                    } else {
                                    ?>
                                        <span class="badge bg-danger ml-2">
                                            <i class="fa-solid fa-arrow-trend-down"></i> <?php echo number_format(abs($ratio), 2); ?>%
                                        </span>
                                    <?php
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>
                        <!-- End Stats -->
                    </div>
                </div>
                <?php
                // Biểu đồ thứ nhất: Doanh thu hàng tháng
                $data_revenue = array(
                    array('Tháng', 'Doanh Thu (Triệu đồng)')
                );
                $sql_revenue = "SELECT MONTH(orderDate) AS month, YEAR(orderDate) AS year, SUM(totalPrice) AS totalRevenue 
                FROM orders 
                WHERE orderStatusID = '4'
                GROUP BY YEAR(orderDate), MONTH(orderDate)";
                $result_revenue = $connect->query($sql_revenue);

                if ($result_revenue->num_rows > 0) {
                    while ($row = $result_revenue->fetch_assoc()) {
                        $month = (int)$row["month"];
                        $year = $row["year"];
                        $totalRevenue = (int)$row["totalRevenue"];
                        $data_revenue[] = array("$month", $totalRevenue);
                    }
                } else {
                    echo "Không có dữ liệu doanh thu.";
                }

                // Biểu đồ thứ hai: Số lượng sản phẩm bán ra
                $data_product = array(
                    array('Sản phẩm', 'Số lượng sản phẩm bán ra')
                );
                $sql_product = "SELECT p.productName, MONTH(o.orderDate) AS month, YEAR(o.orderDate) AS year, SUM(od.quantity) AS totalSoldQuantity
                FROM order_details od
                JOIN orders o ON od.orderID = o.orderID
                JOIN product p ON od.productID = p.productID
                WHERE o.orderStatusID = '4'
                GROUP BY p.productName, YEAR(o.orderDate), MONTH(o.orderDate)";
                $result_product = $connect->query($sql_product);

                if ($result_product->num_rows > 0) {
                    while ($row = $result_product->fetch_assoc()) {
                        $productName = $row["productName"];
                        $totalSoldQuantity = (int) $row["totalSoldQuantity"];
                        $data_product[] = array($productName, (int)$totalSoldQuantity);
                    }
                } else {
                    echo "Không có dữ liệu sản phẩm bán ra.";
                }

                // Chuyển đổi mảng dữ liệu thành JSON
                $jsonData_revenue = json_encode($data_revenue);
                $jsonData_product = json_encode($data_product);
                ?>

                <div class="row mt-2">
                    <div class="col-6">
                        <div id="myChart1" style="width:100%; max-width:600px; height:500px; margin: 0 auto;"></div>
                    </div>
                    <div class="col-6">
                        <div id="myChart2" style="width:100%; max-width:600px; height:500px;"></div>
                    </div>
                </div>
                <div class=" row mt-2">
                    <div class="clearfix">
                        <h3 id="index" class="fl-left">Danh sách đơn hàng</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Mã đơn hàng</span></td>
                                    <td><span class="thead-text">Họ và tên</span></td>
                                    <td><span class="thead-text">Phone</span></td>
                                    <td><span class="thead-text">Tổng giá</span></td>
                                    <td><span class="thead-text">Trạng thái</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                    <td></td>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $sql_order = "SELECT * FROM `orders` ORDER BY `orderDate` DESC LIMIT $start, $num_per_page";
                                $result_sql_order = $connect->query($sql_order);
                                if ($result_sql_order->num_rows > 0) {
                                    $stt = 1;
                                    foreach ($result_sql_order as $item) {
                                ?>
                                        <tr>
                                            <td><input type="checkbox" name="checkItem" class="checkItem"></td>
                                            <td><span class="tbody-text cell-wrapper"><?php echo $stt; ?></h3></span>
                                            <td><span class="tbody-text cell-wrapper"><?php echo $item['code_order']; ?></h3></span>
                                            <td>
                                                <div class="tb-title fl-left" style="font-weight: bold;">
                                                    <?php echo $item['name_customers']; ?>
                                                </div>
                                                <ul class="list-operation fl-right">
                                                    <li><a href="#" class="delete" onclick="delete_ordee(<?php echo $item['orderID'] ?>, <?php echo $item['orderStatusID'] ?>)"><i class="fa fa-trash" aria-hidden="true"></i></a></li>

                                                </ul>

                                            </td>
                                            <td><span class="tbody-text"><?php echo $item['phone']; ?></span></td>
                                            <td> <span class="tbody-text"><?php echo  number_format((int)$item['totalPrice'] * 1.2, 0, '.', '.') ?> VND</span></td>
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
                                            <td><span class="tbody-text"><?php echo $item['orderDate']; ?></span></td>
                                            <td>
                                                <a href="?page=show_details_order&id=<?php echo $item['orderID']; ?>">
                                                    <button type="button" class="btn btn-outline-primary" style="border: none;">Xem chi tiết</button>
                                                </a>
                                            </td>


                                        </tr>
                                <?php
                                        $stt++;
                                    }
                                }

                                ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="tfoot-text">STT</span></td>
                                    <td><span class="tfoot-text">Mã đơn hàng</span></td>
                                    <td><span class="tfoot-text">Họ và tên</span></td>
                                    <td><span class="tfoot-text">Số sản phẩm</span></td>
                                    <td><span class="tfoot-text">Tổng giá</span></td>
                                    <td><span class="tfoot-text">Trạng thái</span></td>
                                    <td><span class="tfoot-text">Thời gian đặt</span></td>
                                    <td></td>

                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>

                <div class="section" id="paging-wp">
                    <div class="section-detail clearfix">
                        <p id="desc" class="fl-left">Chọn vào checkbox để lựa chọn tất cả</p>

                        <?php
                        echo get_padding($num_pages, $page, "Dashboards");
                        ?>
                    </div>
                </div>
            </div>


        </div>



    </div>

</div>

<script>
    google.charts.load('current', {
        packages: ['corechart']
    });
    google.charts.setOnLoadCallback(drawCharts);

    function drawCharts() {
        // Biểu đồ thứ nhất: Doanh thu hàng tháng
        var data1 = google.visualization.arrayToDataTable(<?php echo $jsonData_revenue; ?>);

        // Cấu hình biểu đồ
        var options1 = {
            title: 'Biểu đồ Doanh Thu Hàng Tháng',
            hAxis: {
                title: 'Tháng'
            },
            vAxis: {
                title: 'Doanh Thu (Triệu đồng)'
            },
            legend: 'none'
        };

        // Khởi tạo biểu đồ và vẽ lên trang
        var chart1 = new google.visualization.LineChart(document.getElementById('myChart1'));
        chart1.draw(data1, options1);

        // Biểu đồ thứ hai: Số lượng sản phẩm bán ra
        var data2 = google.visualization.arrayToDataTable(<?php echo $jsonData_product; ?>);

        // Cấu hình biểu đồ
        var options2 = {
            title: 'Thống kê Số lượng Sản phẩm Bán ra',
            hAxis: {
                title: 'Sản phẩm'
            },
            vAxis: {
                title: 'Số lượng bán ra'
            }
        };

        // Vẽ biểu đồ cột
        var chart2 = new google.visualization.ColumnChart(document.getElementById('myChart2'));
        chart2.draw(data2, options2);

    }
</script>