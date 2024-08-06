<?php
session_unset(); // Xóa tất cả các biến phiên
session_destroy(); // Hủy bỏ phiên

header("Location: ../?page=trangChu");
exit(); 
?>
