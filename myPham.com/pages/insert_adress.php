<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $address_id = $_POST['address_id'];

    $username = $_SESSION["user"];
    $sql_query_user_id = "SELECT `userID` FROM `users` WHERE `username`='$username'";
    $result_sql_query_user_id = $connect->query($sql_query_user_id);

    if ($result_sql_query_user_id->num_rows > 0) {
        $row_sql_query = $result_sql_query_user_id->fetch_assoc();
        $user_id = $row_sql_query['userID'];

        $sql_delete_address = "SELECT * FROM `tbl_address` WHERE `id_user`= '$user_id' and `id_Address`='$address_id'";
        
        $result_sql_address = $connect->query($sql_delete_address);

        if ($result_sql_address) {
            $_SESSION['selected_address'] = $result_sql_address->fetch_assoc();
            echo "Bạn đã chọn thành công địa chỉ";
        } else {
            echo "Bạn đã chọn không thành công. Vui lòng thử lại sau";
        }
    }
}
