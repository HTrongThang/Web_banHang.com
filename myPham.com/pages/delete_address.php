<?php
// Kiểm tra xem có yêu cầu POST được gửi đi không
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $address_id = $_POST['address_id'];

    $username = $_SESSION["user"];
    $sql_query_user_id = "SELECT `userID` FROM `users` WHERE `username`='$username'";
    $result_sql_query_user_id = $connect->query($sql_query_user_id);

    if ($result_sql_query_user_id->num_rows > 0) {
        $row_sql_query = $result_sql_query_user_id->fetch_assoc();
        $user_id = $row_sql_query['userID'];

        $sql_delete_address = "DELETE FROM `tbl_address` WHERE `id_user`= '$user_id' and `id_Address`='$address_id'";
        
        $result_sql_address = $connect->query($sql_delete_address);
        if ($result_sql_address) {
            echo "Bạn đã xóa thành công địa chỉ";
        } else {
            echo "Bạn đã xóa không thành công. Vui lòng thử lại sau";
        }
    }
}
