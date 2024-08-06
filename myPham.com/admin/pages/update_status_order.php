<?php
$txt_slect = $_POST['txt_select'];
$txt_id = $_POST['txt_id'];
$sql_update_status_order = "UPDATE `orders` SET `orderStatusID`='  $txt_slect ' WHERE `orderID`=$txt_id";
$result_sql_update_status_order = $connect->query($sql_update_status_order);
if ($result_sql_update_status_order) {
    echo "Thông báo cập nhật đơn hàng thành công ";
} else {
    echo "Thông báo cập nhật đơn hàng không thành công ";
}
