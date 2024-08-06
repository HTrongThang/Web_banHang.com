<?php
$id = $_GET['id'];
$sql = "DELETE FROM `productcategory` WHERE `productCategoryID`=$id";
$result = $connect->query($sql);
require 'list_danhMucSanPham.php';
?>