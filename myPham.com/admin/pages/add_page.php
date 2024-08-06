<?php
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
        if (isset($_SESSION["user"])) {
            $username = $_SESSION["user"];
            $sql_query_user_id = "SELECT `userID` FROM `users` WHERE `username`='$username'";
            $result_sql_query_user_id = $connect->query($sql_query_user_id);
            if ($result_sql_query_user_id->num_rows > 0) {
                $row_sql_query = $result_sql_query_user_id->fetch_assoc();
                $user_id = $row_sql_query['userID'];
                $nguoiTao = $user_id;
                $date = date("Y-m-d");
                $sql_insert = "INSERT INTO `category`( `tieuDe`, `biDanh`, `noiDung`, `trangThai`, `nguoiTao`, `thoiGianTao`) 
                VALUES (' $tieude','$biDanh','$noidungMoTa','$trangThai','$nguoiTao','$date')";
                $result = $connect->query($sql_insert);
                if ($result === true) {
                    require 'list_page.php';
                } else {
                    $errorList['thatBai'] = "Thêm dữ liệu danh mục không thành công";
                }
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
                    <form method="POST">
                        <label for="title">Tiêu đề</label>
                        <input type="text" name="title" id="title">
                        <?php if (isset($errorList['title'])) : ?>
                            <div class="text-danger"><?php echo $errorList['title']; ?></div>
                        <?php endif; ?>

                        <label for="title">Slug ( Friendly_url )</label>
                        <input type="text" name="slug" id="slug">
                        <?php if (isset($errorList['slug'])) : ?>
                            <div class="text-danger"><?php echo $errorList['slug']; ?></div>
                        <?php endif; ?>
                        <label for="desc">Mô tả</label>
                        <textarea name="desc" id="desc" class="ckeditor"></textarea>
                        <?php if (isset($errorList['desc'])) : ?>
                            <div class="text-danger"><?php echo $errorList['desc']; ?></div>
                        <?php endif; ?>
                        <label>Trạng Thái</label>
                        <div class="d-flex">
                            <div class="form-check" style="margin-right: 20px;">
                                <input class="form-check-input" type="radio" name="btnTrangthai" id="flexRadioDefault1" value="1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Công khai
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="btnTrangthai" id="flexRadioDefault2" value="2">
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
                </div>
            </div>
        </div>
    </div>
</div>