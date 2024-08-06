<?php
$id = $_POST['id'];
$sql_check_sl = "SELECT * FROM `tb_post` WHERE `id_danhMuc`='$id'";
$result_sql_sl = $connect->query($sql_check_sl);
if ($result_sql_sl->num_rows > 0) {
    echo "Bạn chỉ có thể xóa những danh mục không tồn tại bài viết nào !";
} else {
    $sql = "DELETE FROM `category_posts` WHERE `id_danhMuc`=$id";
    $result = $connect->query($sql);
    echo "Bạn đã xóa danh mục thành công";
}
