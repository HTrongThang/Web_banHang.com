<?php
$id = $_GET['id'];
$sql = "UPDATE `product` SET `trangThai`=3 WHERE `productID`=$id";
$result = $connect->query($sql);
if ($result == true) {
    require 'list_product.php';
    die();
} else {
    echo "KHong thanh cong";
}
