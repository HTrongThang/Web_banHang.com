<script>
    function delete_post(id) {
        var xacNhanXoa = confirm("Bạn có chắc muốn xóa bài viết này không?");
        if (xacNhanXoa) {
            window.location.href = "?page=delete_post&id=" + id;
        }
    }
</script>

<?php
$num_per_page = 5;

$page = isset($_GET['trang']) ? $_GET['trang'] : 1;


$sql_count = "SELECT COUNT(*) AS total_rows FROM `tb_post`";
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
                    <h3 id="index" class="fl-left">Danh sách bài viết</h3>
                    <a href="?page=add_cat" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>
            <?php
            $sql_count = "SELECT COUNT(*) FROM `tb_post` ";
            $result = $connect->query($sql_count);
            $row = $result->fetch_row();

            $sql_count_hd = "SELECT COUNT(*) FROM `tb_post`  WHERE `trangThai`=1";
            $result_HD = $connect->query($sql_count_hd);
            $row_HD = $result_HD->fetch_row();

            $sql_count_XD = "SELECT COUNT(*) FROM `tb_post`  WHERE `trangThai`=2";
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
                                    <td><span class="thead-text">Danh mục</span></td>
                                    <td><span class="thead-text">Trạng thái</span></td>
                                    <td><span class="thead-text">Người tạo</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM `tb_post` ORDER BY `date` DESC  LIMIT $start, $num_per_page";

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
                                                    <a href="" title=""><?php echo $item['tieuDe'] ?></a>
                                                </div>
                                                <ul class="list-operation fl-right">
                                                    <li><a href="?page=update_post&id=<?php echo $item['id'] ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                    <li><a href="#" onclick="delete_post(<?php echo $item['id'] ?>)" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                </ul>
                                            </td>
                                            <td>
                                                <span class="tbody-text">
                                                    <?php
                                                    $sql_cate = "SELECT * FROM `category_posts`";
                                                    $result_ct = $connect->query($sql_cate);
                                                    while ($item_cate = $result_ct->fetch_assoc()) {
                                                        if ($item['id_danhMuc'] == $item_cate['id_danhMuc']) {
                                                            echo $item_cate['tieuDe'];
                                                            break;
                                                        }
                                                    }
                                                    ?>
                                                </span>
                                            </td>

                                            <td><span class="tbody-text"><?php if ($item['trangThai'] == 1) {
                                                                                echo " Hoạt động";
                                                                            } else {
                                                                                echo "Xét duyệt";
                                                                            } ?></span></td>
                                            <td><span class="tbody-text"><?php echo $item['nguoiTao'] ?></span></td>
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
                                    <td><span class="tfoot-text">STT</span></td>
                                    <td><span class="tfoot-text">Tiêu đề</span></td>
                                    <td><span class="tfoot-text">Danh mục</span></td>
                                    <td><span class="tfoot-text">Trạng thái</span></td>
                                    <td><span class="tfoot-text">Người tạo</span></td>
                                    <td><span class="tfoot-text">Thời gian</span></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                <?php
                    echo get_padding($num_pages, $page, "list_post");
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>