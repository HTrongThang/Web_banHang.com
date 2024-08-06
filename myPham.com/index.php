<?php


require 'db/config.php';
require 'db/database.php';
require 'lib/redirect.php';
require 'lib/get_padding.php';




$connect = db_connect($config);
session_start();
ob_start();

require 'lib/func_cart.php';
$page = isset($_GET['page']) ? $_GET['page'] : 'trangChu';
$path = "./pages/{$page}.php";



$callFooter = true;

if (file_exists($path)) {
    if (
        $page !== 'add_cart' && $page !== 'showLogin' && $page !== 'huyDotHang'
        && $page !== 'address_user' && $page !== 'delete_address' && $page !== 'insert_adress' && $page !== 'forgotPassWord'
        && $page !== 'xl_quenMatKhau' && $page !== 'comment' && $page !== 'register' && $page !== 'login'
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
