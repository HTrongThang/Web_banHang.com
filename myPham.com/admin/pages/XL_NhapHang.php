<?php
$id = $_GET['proid'];
$sql = "SELECT * FROM `product` WHERE `productID`=$id";
$result = $connect->query($sql);
$row = $result->fetch_assoc();
?>

<div id="dialog" title="Thông tin sản phẩm" style="display: none;">
    <div class="col">
        <!-- Bảng cho Thông tin sản phẩm -->
        <table class="table  table-bordered" id="thong-tin-san-pham">
            <tbody id="product-details">
                <tr>
                    <td class="font-weight-bold w-50">Mã sản phẩm:</td>
                    <td align="center"><?php echo $row['productCode'] ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold">Tên sản phẩm:</td>
                    <td align="center"><?php echo $row['productName'] ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold">Ảnh sản phẩm:</td>
                    <td align="center">
                        <img src="<?php echo $row['img_avatar'] ?>" alt="Ảnh sản phẩm" class="rounded-circle" style="width: 100px; height: 100px;">
                    </td>
                </tr>
                <tr>
                    <td class="font-weight-bold">Số lượng:</td>
                    <td align="center">
                        <input type="number" id="product-quantity" class="form-control" min="1">
                    </td>
                </tr>

                <tr>
                    <td class="font-weight-bold">Giá:</td>
                    <td align="center">
                        <input type="number" id="product-price" class="form-control" min="1000" step="1000">

                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <button class="btn btn-primary btn-nhap-hang" data-id="<?php echo $row['productID']; ?>" type="submit"> <i class="fa-solid fa-cart-shopping"></i> Nhập hàng</button>
                    </td>
                </tr>

            </tbody>
        </table>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.3/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
<script>
    $(document).ready(function() {
        // Xử lý sự kiện khi nhấn vào nút "Hủy"
        $("#supplier_huy").on("click", function(event) {
            event.preventDefault(); // Ngăn chặn hành động mặc định của nút
            var userConfirm = confirm("Bạn có muốn đóng hộp thoại không ?");

            if (userConfirm) {
                $("#dialog").dialog("close"); // Đóng hộp dialog
                $("#add-supplier-form")[0].reset(); // Xóa dữ liệu trong form
            }
        });
    });
</script>
<script>
    $(document).ready(function() {

        $(".btn-nhap-hang").click(function() {
            event.preventDefault();
            var soLuong = parseInt($("#product-quantity").val());
            var gia = parseInt($("#product-price").val());
            if (soLuong <= 0 || gia <= 0) {
                alert("Số lượng và giá phải là số nguyên dương.");
                return;
            }

            var proid = $(this).attr("data-id");
            var data = {
                soLuong: soLuong,
                gia: gia,
                proid: proid
            };

            $.ajax({
                url: "?page=XuLyUpdateNhapHang",
                type: "POST",
                data: data,
                success: function(response) {
                    location.reload(); // Tải lại trang
                    alert(response);

                    $("#dialog").dialog("close");
                    $("#product-quantity").val("");
                    $("#product-price").val("");
                },
                error: function(xhr, status, error) {
                    alert("Đã xảy ra lỗi khi nhập hàng: " + error);
                }
            });
        });
    });
</script>