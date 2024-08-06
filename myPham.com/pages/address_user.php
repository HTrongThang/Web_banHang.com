<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $txt_id = $_POST['txt_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $sql = "INSERT INTO `tbl_address`( `name_kh`, `phone`, `email`, `diaChi`, `id_user`)
     VALUES ('$name','$phone',' $email',' $address ',' $txt_id')";
    $result = $connect->query($sql);
    if ($result) {
        echo "Bạn đã thêm địa chỉ thành công";
    } else {
        echo "Bạn đã không thêm địa chỉ thành công. Vui lòng thử lại sau";
    }
}
