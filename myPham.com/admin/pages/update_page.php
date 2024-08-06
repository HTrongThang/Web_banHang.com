<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM `category` WHERE `id`=$id";
    $result = $connect->query($sql);
    if (isset($_POST['btn-submit'])) {
        $errorList = array();

        if (empty($_POST['title'])) {
            $errorList['title'] = "Vui lòng nhập tiêu đề";
        } else {
            $tieude = $_POST['title'];
        }

        if (empty($_POST['slug'])) {
            $errorList['slug'] = "Vui lòng nhập slug";
        } else {
            $biDanh = $_POST['slug'];
        }

        if (empty($_POST['desc'])) {
            $errorList['desc'] = "Vui lòng nhập mô tả";
        } else {
            $noidungMoTa = $_POST['desc'];
        }


        if (empty($_POST['btnTrangthai'])) {
            $errorList['btnTrangthai'] = "Vui lòng nhập trạng thái";
        } else {
            $trangThai = $_POST['btnTrangthai'];
        }


        if (empty($errorList)) {
            $nguoiTao = "admin";
            $date = date("Y-m-d");
            $sql_insert = "UPDATE `category` 
            SET `tieuDe`='$tieude', `biDanh`='$biDanh', `noiDung`='$noidungMoTa', `trangThai`='$trangThai', `nguoiTao`='$nguoiTao', `thoiGianTao`='$date'
            WHERE `id`=$id";

            $result = $connect->query($sql_insert);
            if ($result === true) {
                require 'list_page.php';
            } else {
                $errorList['thatBai'] = "Thêm dữ liệu danh mục không thành công";
            }
        }
    }
}


?>

<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php require 'inc/sidebar.php'; ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm trang</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <?php
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                    ?>
                        <form method="POST">
                            <label for="title">Tiêu đề</label>
                            <input type="text" name="title" id="title" value="<?php echo $row['tieuDe']  ?>">
                            <?php if (isset($errorList['title'])) : ?>
                                <div class="text-danger"><?php echo $errorList['title']; ?></div>
                            <?php endif; ?>

                            <label for="title">Slug ( Friendly_url )</label>
                            <input type="text" name="slug" id="slug" value="<?php echo $row['biDanh']  ?>">
                            <?php if (isset($errorList['slug'])) : ?>
                                <div class="text-danger"><?php echo $errorList['slug']; ?></div>
                            <?php endif; ?>
                            <label for="desc">Mô tả</label>
                            <textarea name="desc" id="desc" class="ckeditor"><?php echo $row['noiDung']; ?></textarea>

                            <?php if (isset($errorList['desc'])) : ?>
                                <div class="text-danger"><?php echo $errorList['desc']; ?></div>
                            <?php endif; ?>
                            <label>Trạng Thái</label>
                            <div class="d-flex">
                                <div class="form-check" style="margin-right: 20px;">
                                    <input class="form-check-input" type="radio" name="btnTrangthai" id="flexRadioDefault1" value="1" <?php echo ($row['trangThai'] == 1) ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Công khai
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="btnTrangthai" id="flexRadioDefault2" value="2" <?php echo ($row['trangThai'] == 2) ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Chờ duyệt
                                    </label>
                                </div>
                            </div>
                            <?php if (isset($errorList['btnTrangthai'])) : ?>
                                <div class="text-danger"><?php echo $errorList['btnTrangthai']; ?></div>
                            <?php endif; ?>
                            <button type="submit" name="btn-submit" id="btn-submit">Tạo Mới</button>
                        </form>
                    <?php
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>