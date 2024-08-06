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

    if (empty($_POST['detail'])) {
        $errorList['detail'] = "Vui lòng nhập mô tả";
    } else {
        $chiTiet = $_POST['detail'];
    }

    $img_thumb = ''; // Khởi tạo biến img_thumb để tránh lỗi Undefined variable

    if (isset($_FILES['thumb_img'])) {
        $targetDir = 'upload/';
        $thumbImgName = $_FILES['thumb_img']['name'];
        $thumbImgTmpName = $_FILES['thumb_img']['tmp_name'];
        $thumbImgTargetPath = $targetDir . basename($thumbImgName);
        $thumbImgExtension = pathinfo($thumbImgTargetPath, PATHINFO_EXTENSION);

        if (move_uploaded_file($thumbImgTmpName, $thumbImgTargetPath)) {
            $img_thumb = $thumbImgTargetPath;
        }
    }

    
    if (empty($_POST['parent-Cat'])) {
        $errorList['parent-Cat'] = "Vui lòng chọn danh mục";
    } else {
        $parent_Cat = $_POST['parent-Cat'];
    }


    if (empty($_POST['btnTrangthai'])) {
        $errorList['btnTrangthai'] = "Vui lòng nhập trạng thái";
    } else {
        $trangThai = $_POST['btnTrangthai'];
    }

    if (empty($errorList)) {
        $nguoiTao = $_SESSION["user"];
        $date = date("Y-m-d");
        $sql_insert = "INSERT INTO
        `tb_post`(`tieuDe`, `moTa`, `biDanh`, `chiTiet`, `img_post`, `nguoiTao`, `date`, `trangThai`, `id_danhMuc`) 
        VALUES 
        ('$tieude',' $noidungMoTa','$biDanh','$chiTiet','$img_thumb','$nguoiTao','$date','$trangThai','$parent_Cat')";
        $result = $connect->query($sql_insert);
 
        if ($result === true) {
            require 'list_post.php';
            die();
        } else {
            $errorList['thatBai'] = "Thêm dữ liệu danh mục không thành công";
        }
    }
}

?>
<style>
    /* Form container */
</style>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php require 'inc/sidebar.php'; ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm mới bài viết</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" enctype="multipart/form-data">
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
                        <label for="desc">Mô tả ngắn</label>
                        <textarea name="desc" id="desc"></textarea>
                        <label for="desc">Chi tiết</label>
                        <textarea name="detail" id="desc" class="ckeditor"></textarea>
                        <?php if (isset($errorList['desc'])) : ?>
                            <div class="text-danger"><?php echo $errorList['desc']; ?></div>
                        <?php endif; ?>
                        <label>Hình ảnh</label>
                        <div id="uploadFile">
                            <input type="file" name="thumb_img" id="thumb_img" class="file-input">
                        </div>

                        <label>Danh mục cha</label>
                        <select name="parent-Cat">
                            <option value="">-- Chọn danh mục --</option>
                            <?php
                            $sql = "SELECT * FROM `category_posts`";
                            $result = $connect->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<option value="' . $row["id_danhMuc"] . '">' . $row["tieuDe"] . '</option>';
                                }
                            } else {
                                echo '<option value="">Không có danh mục</option>';
                            }
                            ?>
                        </select>
                        <?php if (isset($errorList['parent-Cat'])) : ?>
                            <div class="text-danger"><?php echo $errorList['parent-Cat']; ?></div>
                        <?php endif; ?>


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
                        <button type="submit" name="btn-submit" id="btn-submit">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>