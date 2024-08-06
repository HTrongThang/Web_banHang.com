<?php

$id = $_GET['id'];
$sql = "SELECT * FROM `product_image` WHERE `productID`=$id";
$result = $connect->query($sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa hình ảnh sản phẩm</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .glImage {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            flex-wrap: wrap;
        }

        .glImage li {
            display: flex;
            flex-direction: column;
            position: relative;
            width: calc(33.33% - 10px);
            margin: 5px;
            box-sizing: border-box;
        }

        .glImage li img {
            width: 100%;
            height: auto;
        }

        .box-btn {
            position: absolute;
            bottom: 10px;
            left: 0;
            width: 100%;
            text-align: center;
        }
    </style>
</head>


<script>
    function delete_image(id) {
        var xacNhanXT_pro = confirm("Bạn có muốn xóa dữ liệu này không ?");
        if (xacNhanXT_pro) {
            $.ajax({
                url: '?page=delete_img_thumb&id=' + id,
                type: 'GET',
                success: function(response) {
                    window.location.reload();
                    alert("Bạn đã xóa ảnh thành công");
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    }

    function insert_image() {
        var xacNhanXT_pro = confirm("Bạn có muốn thêm dữ liệu này không ?");
        if (xacNhanXT_pro) {
            $.ajax({
                url: '',
                type: 'GET',
                success: function(response) {
                    window.location.reload();
                    alert("Bạn đã thêm ảnh thành công");
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    }
</script>
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
    // Sau khi thêm tất cả ảnh thành công, trả về phản hồi JSON
    $response = array("status" => "success", "message" => "Thêm ảnh thành công");
    echo json_encode($response);
}
?>


<body>

    <div class="card">
        <div class="card-header">
            <div class="card-tools">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="file" id="fileInput" name="anhS[]" multiple="multiple" />
                    <button type="submit" name="btn-submit" onclick="insert_image();" id="btn-submit" class="mx-3 btn btn-primary" style="float: right;">Thêm mới</button>
                </form>

            </div>
        </div>
        <div class="card-body">
            <ul class="glImage">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>

                        <li id="trow_<?php echo $row['productImageID']; ?>">
                            <img src="upload/<?php echo $row['productImage']; ?>" width="200" />
                            <div class="box-btn">
                                <a href="#" onclick="delete_image(<?php echo $row['productImageID']; ?>)" class="btn btn-sm btn-danger btnDelete"><i class="fa fa-trash"></i></a>

                                <a href="" class="btn btn-sm btn-success btnDelete"><i class="fa fa-check"></i></a>

                            </div>
                        </li>

                <?php
                    }
                } else {
                    echo "sản phẩm không có hình ảnh.";
                }
                ?>


            </ul>
        </div>
        <div class="card-footer my-4">

        </div>
    </div>
</body>

</html>