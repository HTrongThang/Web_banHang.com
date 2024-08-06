<script>
    function delete_post(id) {
        var xacNhanXoa = confirm("Bạn có chắc muốn xóa bài viết này không?");
        if (xacNhanXoa) {
            window.location.href = "?page=delete_ncc&id=" + id;
        }
    }
</script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
<link rel="stylesheet" href="public/css/import/jquery-ui.css">

<style>
    #show-dialog {
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        display: inline-block;
        color: #fff;
        background: #4fa327;
        padding: 4px 15px;
        margin: 20px;
    }

    #show-dialog:hover {
        background-color: #085907;
    }

    #add-supplier-form {
        padding: 20px;
        background-color: #f8f9fa;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    #add-supplier-form label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    #add-supplier-form input[type="text"] {
        width: calc(100% - 10px);
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        transition: border-color 0.3s;
    }

    #add-supplier-form input[type="text"]:hover {
        border-color: #f13a78;
    }

    #add-supplier-form #supplier_add {
        background-color: #061081;
        color: #fff;
        border: none;
        padding: 5px 20px;
        margin-right: 10px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    #add-supplier-form #supplier_huy {
        background-color: #dd2613;
        color: #fff;
        border: none;
        padding: 5px 20px;
        margin-right: 10px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    #add-supplier-form #supplier_add:hover {
        background-color: #0d1edb;
    }

    #add-supplier-form #supplier_huy:hover {
        background-color: red;
    }

    .Province {
        padding: 5px;
        margin-right: 10px;
    }



    .address-container {
        padding: 20px;
        max-width: 546px;
    }

    .address {
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        padding: 20px;
    }

    .address h3 {
        margin-top: 0;
        color: #333;
    }

    .address p {
        margin: 10px 0;
        color: #666;
    }
</style>
<?php
$num_per_page = 5;

$page = isset($_GET['trang']) ? $_GET['trang'] : 1;

$sql_count = "SELECT COUNT(*) AS total_rows FROM `tbl_supplier`";
$result_count = $connect->query($sql_count);
$row_count = $result_count->fetch_assoc();
$total_rows = $row_count['total_rows'];



$num_pages = ceil($total_rows / $num_per_page);

$start = ($page - 1) * $num_per_page;


?>
</script>
<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
        <?php require 'inc/sidebar.php'; ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách nhà cung cấp</h3>

                    <button id="show-dialog" class="fl-left"> Thêm </button>

                </div>
            </div>
            <?php
            $sql_count = "SELECT COUNT(*) FROM `tbl_supplier` ";
            $result = $connect->query($sql_count);
            $row = $result->fetch_row();

            $sql_count_hd = "SELECT COUNT(*) FROM `tbl_supplier`  WHERE `trangThai`=1";
            $result_HD = $connect->query($sql_count_hd);
            $row_HD = $result_HD->fetch_row();

            $sql_count_XD = "SELECT COUNT(*) FROM `tbl_supplier`  WHERE `trangThai`=2";
            $result_XD = $connect->query($sql_count_XD);
            $row_XD = $result_XD->fetch_row();



            ?>

            <style>
                .form_search input[type="submit"]:hover {
                    background-color: #a1e9e9;
                }
            </style>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="">Tất cả <span class="count">(<?php echo $row[0]; ?>)</span></a> |</li>
                            <li class="publish"><a href="">Đã đăng <span class="count">(<?php echo $row_HD[0]; ?>)</span></a> |</li>
                            <li class="pending"><a href="">Chờ xét duyệt <span class="count">(<?php echo $row_XD[0]; ?>)</span> |</a></li>
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
                                    <td><span class="thead-text">Tiêu đề</span></td>
                                    <td><span class="thead-text">Số điện thoại</span></td>
                                    <td><span class="thead-text">Địa chỉ</span></td>
                                    <td><span class="thead-text">Trạng thái</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM `tbl_supplier` where `trangThai`=1 ORDER BY `date` DESC  LIMIT $start, $num_per_page ";
                                $result = $connect->query($sql);
                                if ($result->num_rows > 0) {
                                    $stt = 1;
                                    foreach ($result as $item) {
                                ?>
                                        <tr>
                                            <td><input type="checkbox" name="checkItem" class="checkItem"></td>
                                            <td><span class="tbody-text"><?php echo  $stt; ?></h3></span>
                                            <td class="clearfix">
                                                <div class="tb-title fl-left">
                                                    <a href="" title=""><?php echo $item['tenNCC'] ?></a>
                                                </div>
                                                <ul class="list-operation fl-right">
                                                    <li><a href="#" onclick="delete_post(<?php echo $item['id'] ?>)" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                </ul>
                                            </td>



                                            <td><span class="tbody-text"><?php echo $item['phone'] ?></span></td>
                                            <td><span class="tbody-text"><?php echo $item['diaChiNCC'] ?></span></td>
                                            <td><span class="tbody-text"><?php if ($item['trangThai'] == 1) {
                                                                                echo " Hoạt động";
                                                                            } else {
                                                                                echo "Xét duyệt";
                                                                            } ?></span></td>
                                            <td><span class="tbody-text"><?php echo $item['date'] ?></span></td>
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
                                    <td><span class="thead-text">Tiêu đề</span></td>
                                    <td><span class="thead-text">Số điện thoại</span></td>
                                    <td><span class="thead-text">Địa chỉ</span></td>
                                    <td><span class="thead-text">Trạng thái</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <?php
                    echo get_padding($num_pages, $page, "tbl_supplier");
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function validation_ncc() {
        var name_NCC = document.getElementById('supplier-name').value.trim();
        var diaChi_NCC = document.getElementById('supplier-address').value.trim();
        var SDT_NCC = document.getElementById('supplier-phone').value.trim();

        if (name_NCC === "") {
            alert("Tên Nhà Cung Cấp không được để trống.");
            return false;
        }

        if (diaChi_NCC === "") {
            alert("Địa chỉ không được để trống.");
            return false;
        }
        var phonePattern = /^0[0-9]{9,10}$/;
        if (!phonePattern.test(SDT_NCC)) {
            alert("Số điện thoại không hợp lệ. Vui lòng nhập số bắt đầu bằng 0 và có 10 hoặc 11 chữ số.");
            return false;
        }

        return true;
    }
</script>
<div id="dialog" title="Thêm Nhà Cung Cấp" style="display: none;">
    <form id="add-supplier-form" onsubmit="return validation_ncc()">
        <label for="supplier-name">Tên Nhà Cung Cấp:</label>
        <input type="text" id="supplier-name" name="supplier-name" placeholder="VD: CongTyABC"><br>
        <div class="form-row clearfix">
            <label for="diachi">Địa chỉ </label>
            <select name="tinh" id="province" style="padding: 10px; margin-right: 10px;">
                <option value="-1">Chọn tỉnh thành</option>
            </select>
            <select name="quan" id="district" style="padding: 10px;">
                <option value="-1">Chọn quận/huyện</option>
            </select>
            <select name="xa" id="town" style="padding: 10px;">
                <option value="-1">Chọn phường/xã</option>
            </select>
        </div>

        <label for="supplier-address">Địa chỉ:</label>

        <input type="text" id="supplier-address" name="supplier-address" placeholder="VD: 230 Hung Vương"><br>
        <label for="supplier-phone">Số điện thoại:</label>
        <input type="text" id="supplier-phone" name="supplier-phone" placeholder="VD: 0123456789"><br>
        <button type="submit" id="supplier_add">Thêm</button>
        <button type="submit" id="supplier_huy">Hủy</button>

    </form>
</div>

<script>
    $(function() {
        $("#show-dialog").click(function() {
            $("#dialog").dialog("open");
        });

        $("#dialog").dialog({
            autoOpen: false,
            width: 400,
            modal: true,
        });
        $("#add-supplier-form").on("submit", function(event) {
            event.preventDefault();
            if (!validation_ncc()) {
                return;
            }
            var name_ncc = $('#supplier-name').val();;
            var sdt_Ncc = $('#supplier-phone').val();
            var diachiCuThe = $('#province').val() + " " + $('#district').val() + " " + $('#town').val() + " " + $('#supplier-address').val();
            var confirmationMessage = "Bạn có chắc chắn muốn thêm nhà cung cấp với các thông tin sau:\n\n" +
                "Tên: " + name_ncc + "\n" +
                "Số điện thoại: " + sdt_Ncc + "\n" +
                "Địa chỉ: " + diachiCuThe + "\n\n" +
                "Vui lòng xác nhận hoặc hủy bỏ.";

            // Hiển thị hộp thoại xác nhận
            var userConfirmation = confirm(confirmationMessage);
            if (userConfirmation) {
                data = {
                    name_ncc: name_ncc,
                    sdt_Ncc: sdt_Ncc,
                    diachiCuThe: diachiCuThe
                }
                $.ajax({
                    url: '?page=add_NCC',
                    type: 'POST',
                    data: data,
                    success: function(result) {
                        alert(result);
                        location.reload();

                    }
                })
            } else {
                $("#dialog").dialog("close"); // Đóng hộp thoại

                $("#add-supplier-form")[0].reset();
            }
        })
        $("#supplier_huy").on("click", function(event) {
            event.preventDefault(); // Ngăn chặn hành động mặc định của nút
            var userConfirm = confirm("Bạn có muốn đóng hộp thoại không ?");

            if (userConfirm) {
                $("#dialog").dialog("close"); // Đóng hộp thoại

                $("#add-supplier-form")[0].reset();
            }

        });

    });
</script>
<script src="api/api.js"></script>
<script src="api/data.json"></script>