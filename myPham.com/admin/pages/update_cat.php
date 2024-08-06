<?php
$id = $_GET['id'];
$sql_query = "SELECT * FROM `category_posts` WHERE `id_danhMuc`='$id'";
$result_sql = $connect->query($sql_query);
$row = $result_sql->fetch_assoc();
if (isset($_POST['btn-submit'])) {

    $errorList = array();
    if (empty($_POST['title'])) {
        $errorList['title'] = "Nhập dữ liệu tiêu đề";
    } else {
        $tieude = $_POST['title'];
    }
    if (empty($_POST['slug'])) {
        $errorList['slug'] = "Nhập dữ liệu slug";
    } else {
        $bidanh = $_POST['slug'];
    }
    if (empty($_POST['moTa'])) {
        $errorList['moTa'] = "Nhập dữ liệu mô tả";
    } else {
        $moTa = $_POST['moTa'];
    }
    if (empty($_POST['btnTrangthai'])) {
        $errorList['btnTrangthai'] = "Nhập dữ liệu btnTrangthai";
    } else {
        $trangThai = $_POST['btnTrangthai'];
    }

    if (empty($errorList)) {
        $nguoiTao = $_SESSION["user"];

        $date = date("Y-m-d");
        $sql = "UPDATE `category_posts` 
        SET`tieuDe`='$tieude',`bidanh`='$bidanh',`noiDung`='$moTa',`trangThai`='$trangThai',`nguoiTao`='$nguoiTao',`thoiGianTao`='$date'
        WHERE `id_danhMuc`='$id'";
        $result = $connect->query($sql);
        if ($result === true) {
            require 'list_cat.php';
            exit();
        } else {
            $errorList['thatBai'] = "Cập nhật dữ liệu không thành công: " . $connect->error;
        }
    }
}
?>
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php require 'inc/sidebar.php'; ?>
        <div id="content" class="fl-right">

            <div class="section" id="detail-page">
                <section class="content">
                    <!-- Default box -->
                    <div class="container-fluid">


                        <div class="row mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <form id="dataForm" method="post">
                                        <h4 style="text-align: center; margin-bottom: 20px; font-weight: bold; font-size: 20px;">Cập nhất Danh mục bài viết</h4>

                                        <div class="row">
                                            <div class="mb-3">
                                                <label for="title" class="form-label text_title">Tên danh mục</label>
                                                <input type="text" class="form-control" id="title" name="title" aria-describedby="tên danh mục" required minlength="3" maxlength="100" style="width: 100%;" value="<?php echo $row['tieuDe'] ?>">
                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="mb-3">
                                                <label for="slug" class="form-label">Slug (Friendly_url)</label>
                                                <input type="text" class="form-control" id="slug" name="slug" aria-describedby="tên slug" required pattern="^[a-z0-9]+(?:-[a-z0-9]+)*$" style="width: 100%;" value="<?php echo $row['bidanh'] ?>">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-3">
                                                <label for="moTa" class="form-label">Mô tả</label>
                                                <input type="text" class="form-control" id="moTa" name="moTa" aria-describedby="mô tả" required minlength="10" maxlength="255" style="width: 100%;" value="<?php echo $row['noiDung'] ?>">
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="d-flex">
                                                <div class="form-check" style="margin-right: 20px;">
                                                    <input class="form-check-input" type="radio" name="btnTrangthai" id="flexRadioDefault1" value="1" required <?php echo ($row['trangThai'] == 1) ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                        Công khai
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="btnTrangthai" id="flexRadioDefault2" value="2" required <?php echo ($row['trangThai'] == 2) ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                        Chờ duyệt
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" name="btn-submit" id="btn-submit" class="btn btn-success " style="padding: 5px 10px; margin-left: 10px;">Cập nhật</button>
                                    </form>
                                </div>
                                <div class="col-8">

                                    <h4 style="text-align: center; font-weight: bold; font-size: 20px;"> Danh sách bài viết</h4>

                                    <table class="table list-table-wp">
                                        <thead>
                                            <tr>
                                                <td><span class="thead-text">STT</span></td>
                                                <td><span class="thead-text">Tiêu đề</span></td>
                                                <td><span class="thead-text">Trạng thái</span></td>
                                                <td><span class="thead-text">Thời gian</span></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT * FROM `tb_post` WHERE `id_danhMuc`='$id' ";
                                            $result_post = $connect->query($sql);

                                            if ($result_post->num_rows > 0) {
                                                $stt = 1;
                                                while ($row_sql_post = $result_post->fetch_assoc()) {
                                            ?>
                                                    <tr>
                                                        <td><span class="tbody-text"><?php echo  $stt; ?></span></td>
                                                        <td class="clearfix">
                                                            <div class="tb-title fl-left">
                                                                <a href="" title=""><?php echo $row_sql_post['tieuDe']; ?></a>
                                                            </div>
                                                        </td>
                                                        <td><span class="tbody-text"><?php echo $row_sql_post['trangThai'] == 1 ? "Hoạt động" : "Xét duyệt"; ?></span></td>
                                                        <td><span class="tbody-text"><?php echo $row_sql_post['date']; ?></span></td>
                                                    </tr>
                                            <?php
                                                    $stt++;
                                                }
                                            }
                                            ?>



                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>


                    </div>

            </div>

            </section>
        </div>
    </div>
</div>
</div>