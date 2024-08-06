<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM `product` WHERE `productID`=$id";
    $result_find_update = $connect->query($sql);

    if (isset($_POST['btn-submit'])) {
        $errorList = [];

        $productName = $_POST['product_name'] ?? '';

        $productCode = $_POST['product_code'] ?? '';

        $shortDescription = $_POST['desc'] ?? '';

        $fullDescription = $_POST['detail_product'] ?? '';

        $productCategory = $_POST['parent-product'] ?? '';

        $thumbImg = $_FILES['thumb_img']['name'];

        $targetDir = "upload/";

        $thumbImgName = $_FILES['thumb_img']['name'];
        $thumbImgTmpName = $_FILES['thumb_img']['tmp_name'];
        $thumbImgTargetPath = $targetDir . basename($thumbImgName);
        $thumbImgExtension = pathinfo($thumbImgTargetPath, PATHINFO_EXTENSION);

        if (move_uploaded_file($thumbImgTmpName, $thumbImgTargetPath)) {
            $img_ava = $thumbImgTargetPath;
        }

        $price = $_POST['price'] ?? '';

        $quantity = $_POST['quantity_product'] ?? '';

        $status = $_POST['btnTrangthai'] ?? '';

        $hot = isset($_POST['hot']);

        $sale = isset($_POST['sale']);

        $isNew = isset($_POST['isNew']);
        $expiry_date = $_POST['expiry_date'];

        if (empty($productName)) {
            $errorList['productName'] = "Vui lòng nhập tên sản phẩm";
        }

        if (empty($productCode)) {
            $errorList['productCode'] = "Vui lòng nhập mã sản phẩm";
        }

        if (empty($shortDescription)) {
            $errorList['shortDescription'] = "Vui lòng nhập mô tả ngắn";
        }

        if (empty($fullDescription)) {
            $errorList['fullDescription'] = "Vui lòng nhập mô tả chi tiết";
        }

        if (empty($productCategory)) {
            $errorList['productCategory'] = "Vui lòng chọn danh mục sản phẩm";
        }

        if (empty($thumbImg)) {
            $errorList['thumbImg'] = "Vui lòng chọn ảnh đại diện cho sản phẩm";
        }

        if (empty($price)) {
            $errorList['price'] = "Vui lòng nhập giá sản phẩm";
        }

        if (empty($quantity)) {
            $errorList['quantity'] = "Vui lòng nhập số lượng sản phẩm";
        }

        if (empty($status)) {
            $errorList['status'] = "Vui lòng chọn trạng thái sản phẩm";
        }

        if (empty($errorList)) {
            $nguoiTao = "admin";

            $date = date("Y-m-d");
            $sql = "UPDATE `product`
            SET `productCategoryID`='$productCategory',
                `productName`='$productName',
                `description`='$shortDescription',
                `price`='$price',
                `quantity`='$quantity',
                `isHot`='$hot',
                `isNew`='$isNew',
                `sale`='$sale',
                `productCode`='$productCode',
                `productDetail`='$fullDescription',
                `img_avatar`='$img_ava',
                `trangThai`='$status',
                `nguoiTao`='$nguoiTao',
                `date`='$date',
                `ngayHetHan`='$expiry_date'
            WHERE `productID`=$id";


            $result = $connect->query($sql);
            if ($result === true) {
                require 'list_product.php';

                echo '<script>alert("Bạn đã chỉnh sửa thành công!");</script>';
                die();
            } else {
                $errorList['thatBai']  = "Thêm dữ liệu danh mục không thành công";
            }
        }
    }
}
?>

<style>
    label {
        display: block;
        margin-bottom: 5px;
    }

    input[type="text"],
    textarea,
    select {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        margin-bottom: 10px;
    }

    .form-check {
        margin-bottom: 10px;
    }

    button[type="submit"] {
        background-color: #007bff;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    button[type="submit"]:hover {
        background-color: #0056b3;
    }

    .ck.ck-editor {
        width: 100%;
    }

    select {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        margin-bottom: 10px;
        appearance: none;
        background: url('data:image/svg+xml;utf8,<svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"/><path d="M0 0h24v24H0z" fill="none"/></svg>') no-repeat;
        background-position: right 8px top 50%;
        background-size: 24px;
    }

    label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }

    span.text_error {
        color: red;
        font-weight: bold;
        font-style: italic;
    }

    input[type="number"] {
        width: 400px;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
    }
</style>
<script>
    function validateUpdate() {
        var productName = document.getElementById('product-name').value;
        var productID = document.getElementById('product-code').value;
        var descriptionProduct = document.getElementById('desc').value;
        var detail_product = document.getElementById('detail_product').value;

        var select = document.querySelector('select[name="parent-product"]');
        var selectedOption = select.options[select.selectedIndex];

        var price = parseFloat(document.getElementById('price').value);
        var quantity = parseInt(document.getElementById('quantity_product').value);

        var productNameError = document.getElementById('productNameError');
        if (productName.length === 0) {
            productNameError.textContent = "Vui lòng nhập tên sản phẩm";
            return false;
        } else {
            productNameError.textContent = "";
        }

        var productIDError = document.getElementById('productIDError');
        if (productID.length === 0) {
            productIDError.textContent = "Vui lòng nhập ID sản phẩm";
            return false;
        } else {
            productIDError = textContent = "";
        }

        var descError = document.getElementById('descError');
        if (descriptionProduct.length === 0) {
            descError.textContent = "Vui lòng nhập mô tả sản phẩm";
            return false;
        } else {
            descError.textContent = "";
        }

        var detailProductError = document.getElementById('detailProductError');
        if (detail_product.length === 0) {
            detailProductError.textContent = "Vui lòng nhập chi tiết sản phẩm";
            return false;
        } else {
            detailProductError.textContent = "";
        }

        var selectedOptionError = document.getElementById('selectedOptionError');
        if (!selectedOption.value) {
            selectedOptionError.textContent = "Vui lòng chọn danh mục sản phẩm";
            return false;
        } else {
            selectedOptionError.textContent = "";
        }

        var priceError = document.getElementById('priceError');
        if (isNaN(price)) {
            priceError.textContent = "Vui lòng nhập giá sản phẩm";
            return false;
        } else if (price <= 0) {
            priceError.textContent = "Giá sản phẩm phải lớn hơn 0";
            return false;
        } else {
            priceError.textContent = "";
        }

        var quantityError = document.getElementById('quantityError');
        if (isNaN(quantity)) {
            quantityError.textContent = "Vui lòng nhập số lượng sản phẩm";
            return false;
        } else if (quantity < 0) {
            quantityError.textContent = "Số lượng sản phẩm phải lớn hơn hoặc bằng 0";
            return false;
        } else {
            quantityError.textContent = "";
        }

        return true;
    }
</script>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php require 'inc/sidebar.php'; ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Cập nhật sản phẩm</h3>
                </div>
            </div>
            <div class="col-md-10">
                <div class="card">

                    <div class="card-body">
                        <?php
                        if ($result_find_update->num_rows > 0) {
                            $item_pro = $result_find_update->fetch_assoc();

                        ?>
                            <form method="POST" onsubmit="return validateUpdate()" enctype="multipart/form-data">
                                <label for="product-name">Tên sản phẩm</label>
                                <input type="text" name="product_name" id="product-name" value="<?php echo  $item_pro['productName']; ?>">
                                <span class="text_error" id="productNameError"><?php echo isset($errorList['productName']) ? $errorList['productName'] : ''; ?></span>

                                <label for="product-code">Mã sản phẩm</label>
                                <input type="text" name="product_code" id="product-code" value="<?php echo  $item_pro['productCode']; ?>">
                                <span class="text_error" id="productIDError"><?php echo isset($errorList['productCode']) ? $errorList['productCode'] : ''; ?></span>

                                <label for="desc">Mô tả ngắn</label>
                                <textarea name="desc" id="desc"><?php echo htmlspecialchars($item_pro['description'], ENT_QUOTES, 'UTF-8'); ?></textarea>
                                <span class="text_error" id="descError"><?php echo isset($errorList['shortDescription']) ? $errorList['shortDescription'] : ''; ?></span>

                                <label for="desc">Chi tiết</label>
                                <textarea name="detail_product" id="detail_product" class="ckeditor" value="<?php echo  $item_pro['productDetail']; ?>"></textarea>
                                <span class="text_error" id="detailProductError"><?php echo isset($errorList['fullDescription']) ? $errorList['fullDescription'] : ''; ?></span>

                                <label>Danh mục sản phẩm</label>
                                <select name="parent-product">
                                    <option value="">-- Chọn danh mục --</option>
                                    <?php
                                    $sql = "SELECT * FROM `productcategory`";
                                    $result = $connect->query($sql);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $selected = ($row["productCategoryID"] == $item_pro['productCategoryID']) ? 'selected' : '';
                                            echo '<option value="' . $row["productCategoryID"] . '" ' . $selected . '>' . $row["productCategoryName"] . '</option>';
                                        }
                                    } else {
                                        echo '<option value="">Không có danh mục</option>';
                                    }
                                    ?>
                                </select>
                                <span class="text_error" id="selectedOptionError"><?php echo isset($errorList['productCategory']) ? $errorList['productCategory'] : ''; ?></span>

                                <div class="file-input-container">
                                    <label for="img_avater" class="file-input-label">Ảnh đại diện</label>
                                    <input type="file" name="thumb_img" id="img_avater" class="file-input">
                                    <?php if (!empty($item_pro['img_avatar'])) : ?>
                                        <span class="file-name" style="display: flex;"><?php echo $item_pro['img_avatar']; ?></span>
                                    <?php endif; ?>
                                </div>

                                <label for="price">Giá sản phẩm</label>
                                <input type="number" name="price" id="price" value="<?php echo  $item_pro['price']; ?>">
                                <span class="text_error" id="priceError"><?php echo isset($errorList['price']) ? $errorList['price'] : ''; ?></span>

                                <label for="price">Số lượng</label>
                                <input type="number" name="quantity_product" id="quantity_product" value="<?php echo  $item_pro['quantity']; ?>" min="1">
                                <span class="text_error" id="quantityError "><?php echo isset($errorList['quantity']) ? $errorList['quantity'] : ''; ?></span>

                                <label for="expiry_date">Ngày Hết Hạn:</label>
                                <input type="date" id="expiry_date" name="expiry_date" min="<?php echo date('Y-m-d'); ?>">

                                <div style="padding-top: 10px;">
                                    <label>Trạng thái</label>
                                    <div class="d-flex">
                                        <div class="form-check" style="margin-right: 20px;">
                                            <input class="form-check-input" type="radio" name="btnTrangthai" id="flexRadioDefault1" value="1" <?php echo ($item_pro['trangThai'] == 1) ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Công khai
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="btnTrangthai" id="flexRadioDefault2" value="2" <?php echo ($item_pro['trangThai'] == 2) ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="flexRadioDefault2">Chờ duyệt</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <label>Tình trạng sản phẩm</label>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="hot" value="hot" <?php echo ($item_pro['isHot'] == 1) ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="inlineCheckbox1">Hot</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="sale" value="sale" <?php echo ($item_pro['sale'] == 1) ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="inlineCheckbox2">Sale</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox3" name="isNew" value="new" <?php echo ($item_pro['isNew'] == 1) ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="inlineCheckbox3">New</label>
                                    </div>
                                </div>
                                <button type="submit" name="btn-submit" id="btn-submit" class="mx-3">Cập nhật</button>
                            </form>
                        <?php
                        }
                        ?>


                    </div>

                </div>
            </div>
        </div>
    </div>


</div>