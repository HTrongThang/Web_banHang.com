<?php
if (isset($_POST['btn-submit'])) {
    $errorList = array();
    if (empty($_POST['title'])) {
        $errorList['title'] = "Nhập dữ liệu tiêu đề";
    } else {
        $tieude = $_POST['title'];
    }

    if (empty($_POST['btnTrangthai'])) {
        $errorList['btnTrangthai'] = "Nhập dữ liệu btnTrangthai";
    } else {
        $trangThai = $_POST['btnTrangthai'];
    }

    if (empty($errorList)) {
        $nguoiTao = $_SESSION["user"];
        $date = date("Y-m-d");
        $sql = "INSERT INTO `productcategory`( `productCategoryName`, `trangThai`, `nguoiTao`, `createdDate`) 
        VALUES ('$tieude','  $trangThai','$nguoiTao' , ' $date')";
        $result = $connect->query($sql);
        if ($result === true) {
            require 'list_danhMucSanPham.php';
        } else {    
            $errorList['thatBai'] = "Thêm dữ liệu không thành công: " . $connect->error;
        }
    }
}
