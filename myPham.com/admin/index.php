<?php

require __DIR__ . '/../db/config.php';
require __DIR__ . '/../db/database.php';
require 'inc/get_padding.php';




$connect = db_connect($config);
mysqli_set_charset($connect, "utf8");
session_start();
ob_start();
require 'inc/func_cart.php';

$page = isset($_GET['page']) ? $_GET['page'] : 'li  st_post';
$path = "./pages/{$page}.php";

$callFooter = true;

if (file_exists($path)) {
    if (
        $page !== 'update_img_thumb' && $page !== 'update_status_order' && $page !== 'delete_order' && $page !== 'delete_cat'
        && $page !== 'xuLykichHoat' && $page !== 'xuLyNangCap' && $page !== 'reset_password' && $page !== 'add_NCC' && $page !== 'XL_NhapHang' && $page !== 'XuLyUpdateNhapHang'
    ) {
        require './inc/header.php';
    } else {
        $callFooter = false;
    }
    require "{$path}";
} else {
    require "./pages/404.php";
}

if ($callFooter === true) {
    require './inc/footer.php';
}
