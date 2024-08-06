<?php
$list_buy = get_list_by_cart();

$supplier_id = isset($_POST['supplier']) ? $_POST['supplier'] : '';
if (isset($_SESSION["user"])) {
    $username = $_SESSION["user"];
    $sql_query_user_id = "SELECT `userID` FROM `users` WHERE `username`='$username'";
    $result_sql_query_user_id = $connect->query($sql_query_user_id);
    if ($result_sql_query_user_id->num_rows > 0) {
        $row_sql_query = $result_sql_query_user_id->fetch_assoc();
        $user_id = $row_sql_query['userID'];
        $tenPN = "PN";
        $date = date("Ymd");
        $randomNumber = mt_rand(1000, 9999);
        $pnCode = $tenPN . $date . $randomNumber;
        $tatol_order = get_tatol_product();
        $sql_insert_ware = "INSERT INTO `tbl_warehousereceipt`( `code_PN`, `id_NCC`, `dateAdded`, `totalCost`, `userID`) VALUES ('$pnCode','$supplier_id','$date','$tatol_order','$user_id')";
        $result_insert = $connect->query($sql_insert_ware);

        if ($result_insert === true) {
            $id_ware = mysqli_insert_id($connect);
            if (!empty($list_buy)) {
                foreach ($list_buy as $item) {
                    $product_id = $item['id'];
                    $product_title = $item['product_title'];
                    $price = $item['price'];
                    $quantity = $item['qty'];
                    $tatol_product = $item['sub_tatol'];

                    $sql_order_detail = "INSERT INTO `tbl_warehousereceipt_details` (`id_PN`, `id_product`, `quantity`, `price`, `totalCost`) 
                                         VALUES ('$id_ware', '$product_id', '$quantity', '$price', '$tatol_product')";
                    $result_order_detail = $connect->query($sql_order_detail);

                    if ($result_order_detail === true) {
                        $quantity_curently_sql = "SELECT `quantity` FROM `product` WHERE `productID` = $product_id";
                        $result_quantity_curently = $connect->query($quantity_curently_sql);

                        if ($result_quantity_curently->num_rows > 0) {
                            $row = $result_quantity_curently->fetch_assoc();
                            $current_quantity = $row['quantity'];

                            $new_quantity = $current_quantity + $quantity;
                            $update_product_sql = "UPDATE `product` SET `quantity` = $new_quantity WHERE `productID` = $product_id";
                            $result_update_quantity_product = $connect->query($update_product_sql);

                            if ($result_update_quantity_product === false) {
                                echo "Lỗi khi cập nhật số lượng sản phẩm.";
                            }
                        } else {
                            echo "Không tìm thấy số lượng sản phẩm.";
                        }
                    } else {
                        echo "Lỗi khi chèn vào bảng chi tiết phiếu nhập.";
                    }
                }
            } else {
                echo "Không có sản phẩm trong giỏ hàng.";
            }
        }
    }
}
require 'nhapHang.php';

if (isset($_SESSION['cart_ware'])) {
    unset($_SESSION['cart_ware']);
}
?>


