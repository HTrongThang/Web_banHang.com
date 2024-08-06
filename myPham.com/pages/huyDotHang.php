<?php

if (isset($_POST['id']) && isset($_POST['tg'])) {
    $id = $_POST['id'];
    $tg = $_POST['tg'];

    if ($tg == 1) {
        $sql_delete_order_detail = "DELETE FROM `order_details` WHERE `orderID`=$id";
        $result = $connect->query($sql_delete_order_detail);
        if ($result) {
            $sql_query_delete_order = "DELETE FROM `orders` WHERE `orderID`= '$id'";
            $result_sql_delete_order = $connect->query($sql_query_delete_order);
            echo json_encode(true); // Trả về giá trị boolean true nếu thành công

        }
    } else {
        echo json_encode(false); // Trả về giá trị boolean false nếu không thành công
    }
}