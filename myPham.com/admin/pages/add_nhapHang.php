<style>
    .total-amount {
        font-size: 18px;
        color: #ff0000;
        margin-top: 20px;
        font-weight: bold;
        text-align: right;
    }
</style>
<script>
    function testClickNCC() {
        var supplierSelect = document.getElementById('supplier').value;
        if (supplierSelect == 0) {
            alert("Vui lòng chọn một nhà cung cấp.");
            return false;
        }
        return true;
    }
</script>
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

                    <div class="table-responsive">
                        <div class="container">
                            <div class="row">
                                <!-- Phần Kho hàng -->
                                <div class="col">

                                    <div class="row">
                                        <div class="col">
                                            <h1 style="font-weight: bold; font-size: 25px; text-align: center; color: #469aa5;">Kho hàng <i class="fa-solid fa-warehouse"></i></h1>

                                            <div class="table-responsive" style="max-height: 354px; overflow-y: auto;">
                                                <table class="table table-striped table-bordered">
                                                    <thead class="thead-dark">
                                                        <tr>
                                                            <th scope="col">STT</th>

                                                            <th scope="col">Mã sản phẩm</th>
                                                            <th scope="col">Tên Sản phẩm</th>
                                                            <th scope="col">Loại sản phẩm</th>
                                                            <th scope="col">Tồn kho</th>
                                                            <th scope="col"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php
                                                        $sql = "SELECT * FROM `product` ORDER BY `date`";

                                                        $result = $connect->query($sql);
                                                        $stt = 1;
                                                        foreach ($result as $item) {
                                                        ?>
                                                            <tr>
                                                                <td style="vertical-align: middle; text-align: center;"><?php echo $stt; ?></td>
                                                                <td style="vertical-align: middle; text-align: center;"><?php echo $item['productCode']; ?></td>


                                                                <td style="vertical-align: middle; text-align: center;"><?php echo $item['productName']; ?></td>
                                                                <td style="vertical-align: middle; text-align: center;">
                                                                    <?php
                                                                    $sql_cate = "SELECT * FROM `productcategory`";
                                                                    $result_ct = $connect->query($sql_cate);
                                                                    while ($item_cate = $result_ct->fetch_assoc()) {
                                                                        if ($item['productCategoryID'] == $item_cate['productCategoryID']) {
                                                                            echo $item_cate['productCategoryName'];
                                                                            break;
                                                                        }
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td style="vertical-align: middle; text-align: center;"><?php echo $item['quantity']; ?></td>
                                                                <td style="text-align: center;width: 19%;">

                                                                    <button class="btn btn-outline-success nhap-hang-btn  show-dialog" data-id="<?php echo $item['productID']; ?>">Nhập hàng</button>
                                                                </td>

                                                            </tr>
                                                        <?php
                                                            $stt++;
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>


                                        </div>
                                    </div>

                                </div>
                                <?php
                                $list_buy = get_list_by_cart();
                                ?>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="row my-5">
                                            <h1 style="font-weight: bold; font-size: 25px; text-align: center; color: #469aa5;">Hàng chờ nhập</h1>

                                            <div class="col">
                                                <!-- Bảng cho Hàng chờ nhập -->
                                                <div class="table-responsive" style="max-height: 354px; overflow-y: auto;">
                                                    <table class="table table-striped table-bordered">
                                                        <thead class="thead-dark">
                                                            <tr>
                                                                <th scope="col">Mã sản phẩm</th>
                                                                <th scope="col">Tên sản phẩm</th>
                                                                <th scope="col">Số lượng</th>
                                                                <th scope="col">Đơn giá</th>
                                                                <th scope="col">Thành Tiền</th>
                                                                <th scope="col"></th>

                                                            </tr>
                                                        </thead>
                                                        <?php
                                                        if (!empty($list_buy)) {
                                                        ?>
                                                            <tbody>
                                                                <?php
                                                                foreach ($list_buy as $item) {
                                                                ?>
                                                                    <tr>
                                                                        <td><?php echo $item['code'] ?></td>
                                                                        <td><?php echo $item['product_title'] ?></td>
                                                                        <td><?php echo $item['qty'] ?></td>
                                                                        <td><?php echo number_format($item['price'], 0, '.', '.') ?>VND</td>
                                                                        <td><?php echo number_format($item['sub_tatol'], 0, '.', '.') ?>VND</td>
                                                                        <td> <a href="?page=delete_ware&id=<?php echo $item['id'] ?>" title="" class="del-product" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng không?')">
                                                                                <i class="fa fa-trash-o"></i>
                                                                            </a></td>

                                                                    </tr>

                                                                <?php
                                                                }
                                                                ?>
                                                            </tbody>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <div class="section">
                                                                <tr>
                                                                    <td colspan="5" align="center">Không có sản phẩm trong giỏ hàng chờ nhập!</td>
                                                                </tr>

                                                            </div>
                                                        <?php
                                                        }
                                                        ?>
                                                    </table>
                                                    <p class="total-amount">
                                                        Tổng tiền:
                                                        <?php
                                                        $tatol = get_tatol_product();
                                                        echo number_format($tatol, 0, '.', ',');
                                                        ?> VND
                                                    </p>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="row my-5">
                                            <h1 style="font-weight: bold; font-size: 25px; text-align: center; color: #469aa5;">Thông tin phiếu nhập</h1>
                                            <div class="col">
                                                <form method="post" action="?page=process_data" style="border: none; padding: 0px;" onsubmit="return testClickNCC()">
                                                    <table class="table table-striped table-bordered">
                                                        <tbody>
                                                            <?php
                                                            if (isset($_SESSION["user"])) {
                                                                $username = $_SESSION["user"];
                                                                $sql_query_user_id = "SELECT `userID` FROM `users` WHERE `username`='$username'";
                                                                $result_sql_query_user_id = $connect->query($sql_query_user_id);
                                                                if ($result_sql_query_user_id->num_rows > 0) {
                                                                    $row_sql_query = $result_sql_query_user_id->fetch_assoc();
                                                                    $user_id = $row_sql_query['userID'];
                                                                    $sql_query_info = "SELECT * FROM `users` WHERE `userID`='$user_id'";
                                                                    $resut_sql_query_info = $connect->query($sql_query_info);
                                                                    if ($resut_sql_query_info->num_rows > 0) {
                                                                        $item = $resut_sql_query_info->fetch_assoc();
                                                                        if (isset($item['user_avater'])) {
                                                            ?>
                                                                            <tr>
                                                                                <td class="font-weight-bold">Tên nhân viên:</td>
                                                                                <td style="font-weight: bold;"><?php echo $item['firstName'] . ' ' . $item['lastName']; ?></td>
                                                                            </tr>
                                                            <?php
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                            <tr>
                                                                <td class="font-weight-bold">Chọn nhà cung cấp:</td>
                                                                <td>
                                                                    <select id="supplier" class="form-control" name="supplier">
                                                                        <option value="0" selected>Vui lòng chọn nhà cung cấp </option>
                                                                        <?php
                                                                        $sql = "SELECT `id`, `tenNCC` FROM `tbl_supplier`";
                                                                        $result = $connect->query($sql);
                                                                        if ($result->num_rows > 0) {
                                                                            while ($row = $result->fetch_assoc()) {
                                                                                echo '<option value="' . $row['id'] . '">' . $row['tenNCC'] . '</option>';
                                                                            }
                                                                        } else {
                                                                            echo '<option value="">Không có nhà cung cấp</option>';
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <div class="text-center my-4">
                                                        <button type="submit" class="btn btn-primary mx-4"> <i class="fa-solid fa-check"></i> Xác nhận </button>
                                                        <a href="?page=delete_all_cart_ware" class="btn" style="background-color: #ff0000;" onclick="return confirm('Bạn có chắc chắn muốn hủy nhập hàng không?')">
                                                            <i class="fa-solid fa-xmark"></i> Hủy nhập hàng
                                                        </a>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>



                        </div>
                    </div>



                </div>

            </div>
        </div>

    </div>
</div>



<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.3/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">

<script>
    $(document).ready(function() {
        $(".show-dialog").click(function() {
            var proid = $(this).attr("data-id");

            $.ajax({
                url: "?page=XL_NhapHang",
                type: "GET",
                data: {
                    proid: proid
                },

                success: function(response) {
                    // Hiển thị hộp dialog với nội dung nhận được từ trang XL_NhapHang
                    $("body").append(response);
                    // Mở hộp dialog sau khi nội dung đã được thêm vào trang
                    $("#dialog").dialog({
                        autoOpen: false,
                        width: 600,
                        modal: true,
                        title: "Chi tiết sản phẩm",
                    }).dialog("open");
                },
                error: function() {
                    alert("Đã xảy ra lỗi khi tải hộp dialog.");
                }
            });
        });


    });
</script>