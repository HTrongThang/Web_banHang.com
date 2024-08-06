<?php
// Kiểm tra xem yêu cầu có phải là GET và có tham số id không
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    // Nhận id từ tham số GET
    $id = $_GET['id'];

    // Thực hiện truy vấn xóa dữ liệu từ bảng product_image
    $sql = "DELETE FROM `product_image` WHERE `productImageID`=$id";
    $result = $connect->query($sql);

    // Kiểm tra xem truy vấn xóa thành công hay không
    if ($result) {
        // Trả về phản hồi JSON báo hiệu xóa thành công
        echo json_encode(array("status" => "success"));
        
    } else {
        // Trả về phản hồi JSON báo hiệu xóa không thành công
        echo json_encode(array("status" => "error", "message" => "Xóa ảnh không thành công"));
    }
} else {
    // Trả về phản hồi JSON báo hiệu yêu cầu không hợp lệ
    http_response_code(400);
    echo json_encode(array("status" => "error", "message" => "Yêu cầu không hợp lệ"));
}
?>
