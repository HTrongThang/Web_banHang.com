<?php
// Lấy dữ liệu từ POST request
$img_thumb = $_POST['img_thumb'];
$rDefault = $_POST['rDefault'];

// Xử lý dữ liệu, ví dụ: lưu vào cơ sở dữ liệu, in ra màn hình, ...
echo "Received image name: " . $img_thumb . ", Selected value: " . $rDefault;
?>
