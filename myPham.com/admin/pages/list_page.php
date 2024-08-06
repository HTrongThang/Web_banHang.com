<script>
    function delete_pages(id) {
        var xacNhanXT = confirm("Bạn có muốn xóa dữ liệu này không ?");
        if (xacNhanXT) {

            window.location.href = "?page=xoa_trang&id=" + id;

        }
    }
</script>
<?php
$sql_count = "SELECT COUNT(*) FROM `category`";
$result = $connect->query($sql_count);
$row = $result->fetch_row();

$sql_count_hd = "SELECT COUNT(*) FROM `category` WHERE `trangThai`=1";
$result_HD = $connect->query($sql_count_hd);
$row_HD = $result_HD->fetch_row();

$sql_count_XD = "SELECT COUNT(*) FROM `category` WHERE `trangThai`=2";
$result_XD = $connect->query($sql_count_XD);
$row_XD = $result_XD->fetch_row();



?>

<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
        <?php require 'inc/sidebar.php'; ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách trang</h3>
                    <a href="?page=add_page" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>
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
                                    <td><span class="thead-text">Tiêu đề</span></td>
                                    <td><span class="thead-text">slug</span></td>
                                    <td><span class="thead-text">Trạng thái</span></td>
                                    <td><span class="thead-text">Người tạo</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM `category`";
                                $result = $connect->query($sql);
                                if ($result->num_rows > 0) {
                                    $stt = 1;
                                    foreach ($result as $item) {
                                ?>
                                        <tr>
                                            <td><input type="checkbox" name="checkItem" class="checkItem"></td>
                                            <td><span class="tbody-text"><?php echo $stt; ?></h3></span>
                                            <td class="clearfix">
                                                <div class="tb-title fl-left">
                                                    <a href="" title=""><?php echo $item['tieuDe']; ?></a>
                                                </div>
                                                <ul class="list-operation fl-right">
                                                    <li><a href="?page=update_page&id=<?php echo $item['id']; ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                    <li><a href="#" onclick="delete_pages(<?php echo $item['id'] ?>)" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                </ul>
                                            </td>
                                            <td><span class="tbody-text"><?php echo $item['biDanh']; ?></span></td>
                                            <td><span class="tbody-text"><?php if ($item['trangThai'] == 1) {
                                                                                echo " Hoạt động";
                                                                            } else {
                                                                                echo "Xét duyệt";
                                                                            } ?></span></td>
                                            <td><span class="tbody-text"><?php
                                                                            $id_user =  $item['nguoiTao'];;
                                                                            $sql_select_form = "SELECT  `username` FROM `users` WHERE `userID`='$id_user'";
                                                                            $result_select = $connect->query($sql_select_form);
                                                                            if ($result_select->num_rows > 0) {
                                                                                while ($row = $result_select->fetch_assoc()) {
                                                                                    echo  $row['username'];
                                                                                }
                                                                            }
                                                                            ?></span></td>
                                            <td><span class="tbody-text"><?php echo $item['thoiGianTao']; ?></span></td>
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
                                    <td><span class="tfoot-text">Tiêu đề</span></td>
                                    <td><span class="tfoot-text">slug</span></td>
                                    <td><span class="tfoot-text">Trạng thái</span></td>
                                    <td><span class="tfoot-text">Người tạo</span></td>
                                    <td><span class="tfoot-text">Thời gian</span></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
            
        </div>
    </div>
</div>