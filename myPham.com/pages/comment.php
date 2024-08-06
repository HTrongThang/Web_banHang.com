<?php

$forbidden_words = [
    'fuck', 'shit', 'asshole', 'bitch', 'bastard', 'damn', 'dick', 'piss', 
    'slut', 'whore', 'crap', 'douche', 'faggot', 'nigger', 'cunt', 'motherfucker',
    'cock', 'pussy', 'bollocks', 'bugger', 'twat', 'wanker', 'prick', 'nazi',
    'địt', 'lồn', 'đụ', 'cặc', 'buồi', 'đéo', 'đụ má', 'địt mẹ', 'địt con mẹ', 'địt cụ', 
    'đụ mẹ mày', 'đụ mẹ mày mà', 'lồn mẹ mày', 'lồn mẹ mày mà', 'địt mẹ mày nhé', 
    'đụ mẹ mày nhé', 'lồn mẹ mày nhé', 'lồn to', 'đụ má mày', 'đụ má mày nhé', 
    'địt con mẹ mày', 'địt con mẹ mày nhé', 'lồn con mẹ mày', 'lồn con mẹ mày nhé'
];

if (isset($_SESSION["user"])) {
    $username = $_SESSION["user"];
    $sql_query_user_id = "SELECT `userID` FROM `users` WHERE `username`='$username'";
    $result_sql_query_user_id = $connect->query($sql_query_user_id);

    if ($result_sql_query_user_id->num_rows > 0) {
        $row_sql_query = $result_sql_query_user_id->fetch_assoc();
        $user_id = $row_sql_query['userID'];
        $id_pro = $_POST['id_product'];

        $sql_check_buy_product = "SELECT 
            order_details.productID,
            order_details.orderID,
            orders.id_user
        FROM 
            orders
        JOIN 
            order_details ON orders.orderID = order_details.orderID 
        WHERE 
            orders.id_user = '$user_id' AND order_details.productID='$id_pro';";

        $result_check_buy_product = $connect->query($sql_check_buy_product);
        
        if ($result_check_buy_product->num_rows > 0) {
            $cmmt = $_POST['cmt'];
            $date = date("Y-m-d");
            
            $contains_forbidden_word = false;
            foreach ($forbidden_words as $word) {
                if (stripos($cmmt, $word) !== false) {
                    $contains_forbidden_word = true;
                    echo 'Bạn vui lòng bình luận đúng thuần phong mĩ tục!';
                    break;
                }
            }
            
            if (!$contains_forbidden_word) {
                $insert_comment = "INSERT INTO `tb_comment`( `user_id`, `post_id`, `product_id`, `comment`, `created_at`) VALUES ('$user_id','','$id_pro','$cmmt','$date')";
                $result_insert = $connect->query($insert_comment);
                if ($result_insert) {
                    echo 'Bạn đã bình luận bài viết thành công!';
                }
            }
        } else {
            echo "Bạn cần mua sản phẩm trước khi bình luận.";
        }
    }
} else {
    echo 'Bạn cần đăng nhập để bình luận bài viết!';
}
?>
