<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['btn-submit'])) {
    $id_pro = $_GET['id'];
    $count_img = count($_FILES['anhS']['name']);
    $totalFileUpload = 0;

    $uploadDir = 'upload/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    for ($i = 0; $i < $count_img; $i++) {
        $fileName = $_FILES['anhS']['name'][$i];
        $location = $uploadDir . $fileName;

        $extension = pathinfo($location, PATHINFO_EXTENSION);
        $extension = strtolower($extension);

        $valid_extension = array("jpg", "jpeg", "png");

        if (in_array($extension, $valid_extension)) {
            if (move_uploaded_file($_FILES['anhS']['tmp_name'][$i], $location)) {
                $sql_insert_product = "INSERT INTO `product_image`(`productImage`, `productID`) 
                VALUES ('$fileName','$id_pro')";
                $result_img = $connect->query($sql_insert_product);
                if ($result_img === true) {
                    $totalFileUpload++;
                } else {
                    // Xử lý lỗi khi thêm dữ liệu vào cơ sở dữ liệu (nếu cần)
                }
            }
        }
    }
}
?>