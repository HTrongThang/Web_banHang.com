<script>
    function delete_prod(id) {
        var xacNhanXT_pro = confirm("Bạn có muốn xóa dữ liệu này không ?");
        if (xacNhanXT_pro) {
            window.location = "?page=delete_products&id=" + id;
        }
    }
</script>
<?php
$num_per_page = 8;

$page = isset($_GET['trang']) ? $_GET['trang'] : 1;

$sql_count = "SELECT COUNT(*) AS total_rows FROM `product`";
$result_count = $connect->query($sql_count);
$row_count = $result_count->fetch_assoc();
$total_rows = $row_count['total_rows'];



$num_pages = ceil($total_rows / $num_per_page);

$start = ($page - 1) * $num_per_page;


?>
<link rel="stylesheet" href="public/css/import/jquery-ui.css">


<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php require 'inc/sidebar.php'; ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách sản phẩm</h3>
                    <a href="?page=add_product" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>
            <?php
            $sql_product = "SELECT COUNT(*) FROM `product`";
            $row_count_product = $connect->query($sql_product)->fetch_row();

            $sql_product_daDang = "SELECT COUNT(*) FROM `product` WHERE `trangThai`=1";
            $row_count_product_daDang = $connect->query($sql_product_daDang)->fetch_row();

            $sql_product_xetDuyet = "SELECT COUNT(*) FROM `product` WHERE `trangThai`=2";
            $row_count_product_xetDuyet = $connect->query($sql_product_xetDuyet)->fetch_row();

            $sql_product_an = "SELECT COUNT(*) FROM `product` WHERE `trangThai`=3";
            $row_count_product_an = $connect->query($sql_product_an)->fetch_row();

            ?>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="">Tất cả <span class="count">(<?php echo $row_count_product[0];  ?>)</span></a> |</li>
                            <li class="publish"><a href="">Đã đăng <span class="count">(<?php echo $row_count_product_daDang[0]; ?>)</span></a> |</li>
                            <li class="pending"><a href="">Chờ xét duyệt<span class="count">(<?php echo $row_count_product_daDang[0]; ?>)</span> |</a></li>
                            <li class="pending"><a href="">Thùng rác<span class="count">(<?php echo $row_count_product_an[0]; ?>)</span></a></li>
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
                                    <td><span class="thead-text">Hình ảnh</span></td>
                                    <td><span class="thead-text">Tên sản phẩm</span></td>
                                    <td><span class="thead-text">Số lượng</span></td>
                                    <td><span class="thead-text">Giá</span></td>
                                    <td><span class="thead-text">Danh mục</span></td>
                                    <td><span class="thead-text">Trạng thái</span></td>
                                    <td><span class="thead-text">Người tạo</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM `product` ORDER BY `date` DESC LIMIT $start, $num_per_page";

                                $result = $connect->query($sql);
                                if ($result->num_rows > 0) {
                                    $stt = 1;
                                    foreach ($result as $item) {
                                        if ($item['trangThai'] != 3) {

                                ?>
                                            <tr>

                                                <td><input type="checkbox" name="checkItem" class="checkItem"></td>
                                                <td><span class="tbody-text"><?php echo $stt; ?></h3></span>
                                                <td>
                                                    <div class="tbody-thumb">
                                                        <img class="imgproduct" src="<?php echo $item['img_avatar']; ?>" alt="" data-id="<?php echo $item['productID']; ?>">
                                                    </div>
                                                </td>
                                                <td class="clearfix">
                                                    <div class="tb-title fl-left">
                                                        <a href="" title=""><?php echo $item['productName'];  ?></a>
                                                    </div>
                                                    <ul class="list-operation fl-right">
                                                        <li><a href="?page=update_product&id=<?php echo $item['productID']; ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                        <li><a href="#" onclick="delete_prod(<?php echo $item['productID'] ?>)" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                    </ul>
                                                </td>
                                                <td><span class="tbody-text"><?php echo $item['quantity'];  ?></span></td>
                                                <td><span class="tbody-text"><?php echo number_format($item['price']) ?></span></td>
                                                <td>
                                                    <span class="tbody-text">
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
                                                    </span>
                                                </td>
                                                <td><span class="tbody-text"><?php if ($item['trangThai'] == 1) {
                                                                                    echo "Hoạt động";
                                                                                } else {
                                                                                    echo "Chờ duyệt";
                                                                                } ?>
                                                    </span></td>
                                                <td><span class="tbody-text"><?php echo $item['nguoiTao'];  ?></span></td>
                                                <td><span class="tbody-text"><?php echo $item['date'];  ?></span></td>
                                            </tr>
                                <?php
                                        }
                                        $stt++;
                                    }
                                }
                                ?>


                            </tbody>
                            <tfoot>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Hình ảnh</span></td>
                                    <td><span class="thead-text">Tên sản phẩm</span></td>
                                    <td><span class="thead-text">Số lượng</span></td>
                                    <td><span class="thead-text">Giá</span></td>
                                    <td><span class="thead-text">Danh mục</span></td>
                                    <td><span class="thead-text">Trạng thái</span></td>
                                    <td><span class="thead-text">Người tạo</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div id="dialog" title="Quản lý ảnh sản phẩm">
                <iframe id="myIframe" style="border: 0; width: 100%; height: 100%;"></iframe>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <p id="desc" class="fl-left">Chọn vào checkbox để lựa chọn tất cả</p>
                    <?php
                    echo get_padding($num_pages, $page, "list_product");
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
    $(document).ready(function() {
        $("#dialog").dialog({
            autoOpen: false,
            show: "fade",
            hide: "fade",
            modal: true,
            height: '600',

            width: '700',
            resizable: true,
            title: 'Quản lý ảnh sản phẩm',
            close: function() {
                // Thực hiện hành động khi modal được đóng
                window.location.reload();
            }
        });

        // Xử lý sự kiện khi hình ảnh sản phẩm được nhấp
        $('body').on("click", ".imgproduct", function() {
            var proid = $(this).attr("data-id");
            //Cập nhật đường dẫn iframe với id sản phẩm tương ứng
            $("#dialog #myIframe").attr("src", "?page=update_img_thumb&id=" + proid);
            $('#dialog').dialog('open');
            return false;
        });


    });
</script>