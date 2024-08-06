<style>
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
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách đơn hàng</h3>
                </div>
            </div>
            <?php
            $sql_count_order = "SELECT COUNT(*) FROM `orders`";
            $result_count_order = $connect->query($sql_count_order)->fetch_row();

            $sql_count_order_choXN = "SELECT COUNT(*) FROM `orders` WHERE `orderStatusID`=1";
            $result_count_order_choXN = $connect->query($sql_count_order_choXN)->fetch_row();

            $sql_count_order_XND = "SELECT COUNT(*) FROM `orders` WHERE `orderStatusID`=2";
            $result_count_order_XND = $connect->query($sql_count_order_XND)->fetch_row();

            $sql_count_order_VC = "SELECT COUNT(*) FROM `orders` WHERE `orderStatusID`=3";
            $result_count_order_VC = $connect->query($sql_count_order_VC)->fetch_row();

            $sql_count_order_DG = "SELECT COUNT(*) FROM `orders` WHERE `orderStatusID`=4";
            $result_count_order_DG = $connect->query($sql_count_order_DG)->fetch_row();


            ?>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="#">Tất cả <span class="count">(<?php echo $result_count_order[0]; ?>)</span></a> |</li>
                            <li class="publish"><a href="#">Đang chờ xác nhận <span class="count">(<?php echo $result_count_order_choXN[0]; ?>)</span></a> |</li>
                            <li class="pending"><a href="#">Xác nhận đơn hàng<span class="count">(<?php echo $result_count_order_XND[0]; ?>)</span> |</a></li>
                            <li class="pending"><a href="#">Đang vận chuyển<span class="count">(<?php echo $result_count_order_VC[0]; ?>)</span></a></li>
                            <li class="pending"><a href="#">Đã giao hàng<span class="count">(<?php echo $result_count_order_DG[0]; ?>)</span></a></li>

                        </ul>
                        <form method="GET" class="form_search form-s fl-right " style="width: 44%;
    margin: 0 auto;
    padding: 20px; background-color: white; border: none;">
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
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <p id="desc" class="fl-left">Chọn vào checkbox để lựa chọn tất cả</p>

                    <?php
                    echo get_padding($num_pages, $page, "list_order");
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>