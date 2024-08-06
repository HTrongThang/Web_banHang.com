<?php
$id = $_POST['id'];

$sql_delete_order_details = "DELETE FROM `order_details` WHERE `orderID`=$id";

$ressult_delete_order_details = $connect->query($sql_delete_order_details);
if ($ressult_delete_order_details) {
    $sql_delete_order = "DELETE FROM `orders` WHERE `orderID`=$id";
    $result_delete_order = $connect->query($sql_delete_order);
    if ($result_delete_order) {
        echo "Bạn đã xóa thành công đơn hàng";
    } else {

        echo "Bạn đã xóa không thành công đơn hàng";
    }
}
