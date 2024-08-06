<style>
    .btn {
        padding: 0px !important;
    }
</style>
<?php
require 'sendmail/index.php';

if (isset($_POST['btn_order_now'])) {
    $name = isset($_POST['fullname']) ? $_POST['fullname'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $tinh = isset($_POST['tinh']) && $_POST['tinh'] !== '-1' ? $_POST['tinh'] : '';
    $quan = isset($_POST['quan']) && $_POST['quan'] !== '-1' ? $_POST['quan'] : '';
    $xa = isset($_POST['xa']) && $_POST['xa'] !== '-1' ? $_POST['xa'] : '';
    $diachi = isset($_POST['diachi']) ? $_POST['diachi'] : '';
    $note = isset($_POST['note']) ? $_POST['note'] : 'Hàng sẽ được giao sớm nhất';

    $tttt = isset($_POST['payment_method']) ? $_POST['payment_method'] : '';

    $diachiCuThe = $diachi . " " . $xa . " " . $quan . " " . $tinh;

    $date = date('dmY');
    $code_order = "DH" . $date;

    for ($i = 0; $i < 4; $i++) {
        $code_order .= rand(0, 9);
    }
    $order_date = date("Y-m-d");
    $ship_date = date("Y-m-d", strtotime($order_date . " +3 days"));

    $tatol = get_tatol_product();
    if (isset($_SESSION["user"])) {
        $name_user = $_SESSION["user"];
        $sql_user_id = "SELECT `userID` FROM `users` WHERE `username`='$name_user'";
        $_result_sql_user_id = $connect->query($sql_user_id);

        if ($_result_sql_user_id->num_rows > 0) {
            $row_user_id = $_result_sql_user_id->fetch_assoc();
            $user_id = $row_user_id['userID'];
            $sql_insert_order = "INSERT INTO `orders` (`orderStatusID`, `orderDate`, `shipDate`, `code_order`, `name_customers`, `email`, `address`, `phone`, `note`, `totalPrice`, `payment_status`, `id_user`)
            VALUES ('1', '$order_date', '$ship_date', '$code_order', '$name', '$email', '$diachiCuThe', '$phone', '$note', '$tatol', '$tttt', '$user_id')";
        }
    } else {
        $sql_insert_order = "INSERT INTO `orders` (`orderStatusID`, `orderDate`, `shipDate`, `code_order`, `name_customers`, `email`, `address`, `phone`, `note`, `totalPrice`, `payment_status`, `id_user`)
        VALUES ('1', '$order_date', '$ship_date', '$code_order', '$name', '$email', '$diachiCuThe', '$phone', '$note', '$tatol', '$tttt', '0')";
    }
    $result = $connect->query($sql_insert_order);
    if ($result === true) {
        $id_order = mysqli_insert_id($connect);
        foreach ($list_buy as $item) {
            $product_id = $item['id'];
            $product_title = $item['product_title'];
            $price = $item['price'];
            $quantity = $item['qty'];

            $sql_order_detail = "INSERT INTO `order_details` (`orderID`, `productID`, `productCode`, `price`, `quantity`) 
             VALUES ('$id_order', '$product_id', '$product_title', '$price', '$quantity')";
            $result_order_detail = $connect->query($sql_order_detail);
            if ($result_order_detail === true) {
                $quantity_curently = "SELECT  `quantity` FROM `product` WHERE`productID`=$product_id";
                $result_quantity_curently = $connect->query($quantity_curently);
                $row = $result_quantity_curently->fetch_assoc();
                $current_quantity = $row['quantity'];

                $update_product = "UPDATE `product` SET `quantity`=$current_quantity-$quantity WHERE `productID`=$product_id";
                $result_update_quantity_product = $connect->query($update_product);
            }
        }

        $sql_select_order = "SELECT * FROM `orders` WHERE `orderID`=$id_order";
        $result_order = $connect->query($sql_select_order);
        $rowz_select_order = $result_order->fetch_assoc();

        $tieude = "Đặt hàng website bán hàng Hasaki đã thành công";

        // Start building the HTML content
        $noiDung = "<h1>Đơn hàng đã đặt thành công</h1>";
        $noiDung .= "<p><strong>Tên:</strong> " . $rowz_select_order['name_customers'] . "</p>";
        $noiDung .= "<p><strong>Địa chỉ:</strong> " . $rowz_select_order['address'] . "</p>";
        $noiDung .= "<p><strong>Mã đơn hàng:</strong> " . $rowz_select_order['code_order'] . "</p>";
        $noiDung .= "<p><strong>Ngày đặt hàng:</strong> " . $rowz_select_order['orderDate'] . "</p>";
        $noiDung .= "<p><strong>Ngày dự kiến giao hàng:</strong> " . $rowz_select_order['shipDate'] . "</p>";
        $noiDung .= "<p><strong>Ghi Chú:</strong> " . $rowz_select_order['note'] . "</p>";
        $noiDung .= "<p>Cảm ơn <strong style='font-weight: bold; color: #333;'>" . $rowz_select_order['name_customers'] . "</strong> đã đặt hàng của chúng tôi. Đơn hàng của bạn<strong style='font-weight: bold; color: #333;'> đang chờ được xác nhận</strong> và sẽ được xử lý trong thời gian sớm nhất.</p>";
        $noiDung .= "<p>Vui lòng kiểm tra email của bạn để biết thêm thông tin chi tiết về đơn hàng.</p>";

        // Thông tin sản phẩm
        $noiDung .= "<div class='order-details'>";
        $noiDung .= "<h2>Thông tin sản phẩm</h2>";
        $noiDung .= "<table style='  width: 70%; border-collapse: collapse;  margin-bottom: 20px;'><thead><tr><th style='      background-color: #f2f2f2;
        font-weight: bold;
        color: #333;'>Tên sản phẩm</th><th style='      background-color: #f2f2f2;
        font-weight: bold;
        color: #333;'>Giá</th><th style='      background-color: #f2f2f2;
        font-weight: bold;
        color: #333;'>Số lượng</th></tr></thead>";
        $noiDung .= "<tbody>";
        $sql_select_order_detail = "SELECT * FROM `order_details` WHERE `orderID`=$id_order";
        $result_select_order_detail = $connect->query($sql_select_order_detail);
        foreach ($result_select_order_detail as $item) {
            $noiDung .= "<tr>";
            $noiDung .= "<td style='  padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;'>" . $item['productCode'] . "</td>";
            $noiDung .= "<td style='  padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;'>" . number_format($item['price'], 0, '.', '.') . "</td>";
            $noiDung .= "<td style='  padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;'>" . $item['quantity'] . "</td>";
            $noiDung .= "</tr>";
        }
        $noiDung .= "</tbody></table></div>";
        $noiDung .= "<p style='padding-right:100px;;'><strong style='padding-right: 5px; margin-bottom: 20px;'>Tổng tiền:</strong>" . number_format($rowz_select_order['totalPrice'], 0, '.', '.') . "VND</p>";


        // Send the email
        $mailDatHang = $rowz_select_order['email'];
        $mailer = new mailer();
        $mailer->datHangMail($tieude, $noiDung, $mailDatHang);
        require 'showbill.php';

        delete_all_cart();
    }
}
?>
<?php

if (isset($_SESSION['selected_address'])) {
    unset($_SESSION['selected_address']);
}
?>


<script src="api/data.json"></script>
<script src="api/api.js"></script>