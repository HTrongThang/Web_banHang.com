<?php
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
        $sql = "INSERT INTO `category_posts`( `tieuDe`, `bidanh`, `noiDung`, `trangThai`, `nguoiTao`, `thoiGianTao`) 
        VALUES ('$tieude','$bidanh','  $moTa','$trangThai',' $nguoiTao', '$date ')";
        $result = $connect->query($sql);
        if ($result === true) {
            header("Location: ?page=list_cat");
            exit();
        } else {
            $errorList['thatBai'] = "Thêm dữ liệu không thành công: " . $connect->error;
        }
    }
}
