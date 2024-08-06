<?php
$name_NCC = $connect->real_escape_string($_POST['name_ncc']);
$add_NCC = $connect->real_escape_string($_POST['diachiCuThe']);
$sdt_NCC = $connect->real_escape_string($_POST['sdt_Ncc']);
$date = date("Y-m-d");

$sql_insert_NCC = "INSERT INTO `tbl_supplier` (`tenNCC`, `diaChiNCC`, `phone`, `trangThai`, `date`) 
                   VALUES ('$name_NCC', '$add_NCC', '$sdt_NCC', '1', '$date')";

if ($connect->query($sql_insert_NCC) === TRUE) {
    echo "Bạn đã thêm thành công nhà cung cấp";
} else {
    echo "Bạn đã thêm không thành công nhà cung cấp. Vui lòng thử lại sau! Lỗi: " . $connect->error;
}
