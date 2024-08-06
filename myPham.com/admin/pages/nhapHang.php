<?php
$num_per_page = 8;

$page = isset($_GET['trang']) ? $_GET['trang'] : 1;

$sql_count = "SELECT COUNT(*) AS total_rows FROM `tbl_warehousereceipt`";
$result_count = $connect->query($sql_count);
$row_count = $result_count->fetch_assoc();
$total_rows = $row_count['total_rows'];



$num_pages = ceil($total_rows / $num_per_page);

$start = ($page - 1) * $num_per_page;


?>
<?php
$sql_count_order = "SELECT COUNT(*) FROM `tbl_warehousereceipt`";
$result_count_order = $connect->query($sql_count_order)->fetch_row();
?>
<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
        <?php require 'inc/sidebar.php'; ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách đơn nhập hàng</h3>


                </div>
            </div>


            <style>
                .form_search input[type="submit"]:hover {
                    background-color: #a1e9e9;
                }
            </style>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="">Tất cả đơn <span class="count">(<?php echo $result_count_order[0]; ?>)</span></a> </li>

                        </ul>
                        <form method="GET" class="form_search form-s fl-right " style="width: 44%;
    margin: 0 auto;
    padding: 20px; background-color: white; border: none; ">
                            <input type="text" name="s" id="s">
                            <input type="submit" name="sm_s" value="Tìm kiếm">
                        </form>
                    </div>

                    <div class="table-responsive">
                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Mã Phiếu Nhập</span></td>
                                    <td><span class="thead-text">Tên nhà cung cấp</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                    <td><span class="thead-text">Tổng tiền</span></td>
                                    <td><span class="thead-text">Nhân viên đặt</span></td>


                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql_order = "SELECT * FROM `tbl_warehousereceipt` ORDER BY `dateAdded` DESC LIMIT $start, $num_per_page";

                                $result_sql_order = $connect->query($sql_order);
                                if ($result_sql_order->num_rows > 0) {
                                    $stt = 1;
                                    foreach ($result_sql_order as $item) {
                                ?>
                                        <tr>
                                            <td><input type="checkbox" name="checkItem" class="checkItem"></td>
                                            <td><span class="tbody-text cell-wrapper"><?php echo $stt; ?></h3></span>
                                            <td><span class="tbody-text cell-wrapper"><?php echo $item['code_PN']; ?></h3></span>
                                            <td>
                                                <div class="tb-title fl-left" style="font-weight: bold;">
                                                    <?php
                                                    $id_NCC = $item['id_NCC'];
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

                                                </div>
                                             

                                            </td>
                                            <td><span class="tbody-text cell-wrapper"><?php echo $item['dateAdded']; ?></h3></span>

                                            <td> <span class="tbody-text"><?php echo  number_format((int)$item['totalCost'] * 1.2, 0, '.', '.') ?> VND</span></td>


                                            <td><span class="tbody-text">
                                                    <?php
                                                    // Lấy ra tên của nhân viên dựa trên userID
                                                    $userID = $item['userID'];
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

                                                </span></td>
                                            <td>
                                                <a href="?page=details_ware&id=<?php echo $item['id_PN']; ?>">
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
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Mã Phiếu Nhập</span></td>
                                    <td><span class="thead-text">Tên nhà cung cấp</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                    <td><span class="thead-text">Tổng tiền</span></td>
                                    <td><span class="thead-text">Nhân viên đặt</span></td>

                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <?php
                    echo get_padding($num_pages, $page, "nhapHang");
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>




<script src="api/api.js"></script>
<script src="api/data.json"></script>