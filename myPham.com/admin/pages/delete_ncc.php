<?php
$id = $_GET['id'];
$sql_delete_NCC = "UPDATE `tbl_supplier` SET `trangThai`=0 WHERE `id`=$id";
$ressult_update_NCC = $connect->query($sql_delete_NCC);
require 'list_NCC.php';
