<?php

// Kiểm tra và xử lý dữ liệu POST



$id = isset($_POST['proid']) ? $_POST['proid'] : '';
$sl = isset($_POST['soLuong']) ? $_POST['soLuong'] : '';


$gia = isset($_POST['gia']) ? $_POST['gia'] : '';

if (add_cart($id, $connect, $sl, $gia)) {
    echo "Bạn đã thêm đơn hàng nhập thành công";
} else {
    echo "Bạn đã thêm đơn hàng nhập không thành công";
}

