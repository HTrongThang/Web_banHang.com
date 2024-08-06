<link rel="stylesheet" href="public/js/jquery-ui.css">
<style>
    .Province {
        padding: 5px;
        margin-right: 10px;
    }



    .address-container {
        padding: 20px;
        max-width: 546px;
    }

    .address {
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        padding: 20px;
    }

    .address h3 {
        margin-top: 0;
        color: #333;
    }

    .address p {
        margin: 10px 0;
        color: #666;
    }

    .action-button_insert {
        background-color: #007bff;
        border: none;
        color: #fff;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        margin-top: 10px;
        margin-right: 10px;
    }

    .action-button_delete {
        background-color: red;
        border: none;
        color: #fff;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        margin-top: 10px;
    }

    #add-address-form {
        display: none;
    }

    #add-address-form label {
        display: block;
        margin-bottom: 10px;
    }

    #add-address-form input[type="text"],
    #add-address-form input[type="email"] {
        width: 100%;
        padding: 5px;
        margin-bottom: 10px;
    }

    .custom-dialog {
        width: 200px !important;
        height: 200px !important;
        overflow-y: auto;
        top: 100;
    }

    .insrtform-row select {
        width: 100%;
        margin-right: 10px;
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-bottom: 10px;
    }

    .insrtform-row select:last-child {
        margin-right: 0;


    }

    .text_error {
        color: red;
        font-size: 14px;
        font-weight: bold;
        display: block;
    }
</style>
<script>
    function validate_check() {
        var fullname = document.getElementById('fullname').value.trim();
        var email = document.getElementById('email').value.trim();
        var phone = document.getElementById('sdt').value.trim();
        var diachi = document.getElementById('diachi').value.trim();
        var tinh = document.querySelector('select[name="tinh"]').value;
        var quan = document.querySelector('select[name="quan"]').value;
        var xa = document.querySelector('select[name="xa"]').value;

        if (fullname === '' || email === '' || phone === '' || diachi === '' ) {
            alert('Vui lòng điền đầy đủ thông tin và chọn địa chỉ.');
            return false;

        }

        if (diachi.length < 50) {
            if (tinh === '-1' || quan === '-1' || xa === '-1') {
                alert('Vui lòng điền đầy đủ chọn địa chỉ.');
                return false;

            }   
        }
        var emailError = document.getElementById('emailError');
        var emailRegex = /^[A-Za-z0-9_.]{6,32}@([a-zA-Z0-9]{2,12})(\.[a-zA-Z]{2,12})+$/;

        if (email.length === 0) {
            emailError.textContent = "Vui lòng nhập email của bạn";
            return false;
        } else if (!emailRegex.test(email)) {
            emailError.textContent = "Email không hợp lệ. Vui lòng kiểm tra lại!";
            return false;
        } else {
            emailError.textContent = "";
        }


        var sdtError = document.getElementById('sdtError');
        var phoneRegex = /^0[0-9]{9}$/;

        if (phone.length === 0) {
            sdtError.textContent = "Vui lòng nhập số điện thoại của bạn";
            return false;
        } else if (!phoneRegex.test(phone)) {
            sdtError.textContent = "Số điện thoại không hợp lệ !";
            return false;
        } else {
            sdtError.textContent = "";
        }

        return true;

    }
</script>
<?php
if (isset($_SESSION["user"])) {
    $username = $_SESSION["user"];
    $sql_query_user_id = "SELECT `userID` FROM `users` WHERE `username`='$username'";
    $result_sql_query_user_id = $connect->query($sql_query_user_id);

    if ($result_sql_query_user_id->num_rows > 0) {
        $row_sql_query = $result_sql_query_user_id->fetch_assoc();
        $user_id = $row_sql_query['userID'];
    }
}
?>
<div id="main-content-wp" class="checkout-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?page=trangChu" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Thanh toán</a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
    <div style="margin-left: 177px;">
        <span style="display: inline-block; vertical-align: middle; color: #333;">Bạn có thể sử dụng lại các địa chỉ giao hàng đã lưu. Vui lòng click vào đây</span>
        <button id="show-dialog" style="display: inline-block; vertical-align: middle; background-color: #f13a78; border: none; color: #fff;"> <i class="fa-solid fa-house"></i></button>
    </div>

    <div id="wrapper_checkOut" class="wp-inner clearfix">

        <form action="?page=bill" method="post" name="form-checkout" onsubmit="return validate_check()">
            <div class="section" id="customer-info-wp">
                <div class="section-head">
                    <h1 class="section-title">Thông tin khách hàng</h1>
                </div>

                <?php

                if (isset($_SESSION['selected_address'])) {
                    $selected_address = $_SESSION['selected_address'];
                ?>
                    <div class="section-detail">
                        <div class="form-row clearfix">
                            <div class="form-col fl-left">
                                <label for="fullname">Họ tên</label>
                                <input type="text" name="fullname" id="fullname" value="<?php echo $selected_address['name_kh']; ?>">
                            </div>
                            <div class="form-col fl-right">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" value="<?php echo $selected_address['email']; ?>">
                            </div>
                        </div>
                        <div class="form-row clearfix" style="display: flex;">
                            <div class="form-col fl-right">
                                <label for="sdt">SDT</label>
                                <input type="text" name="phone" id="sdt" value="<?php echo $selected_address['phone']; ?>">
                            </div>
                        </div>
                        <div class="form-row clearfix">
                            <label for="diachi">Địa chỉ </label>
                            <select name="tinh" class="province" style="padding: 5px; margin-right: 10px;">
                                <option value="-1">Chọn tỉnh thành</option>
                            </select>
                            <select name="quan" class="district" style="padding: 5px;">
                                <option value="-1">Chọn quận/huyện</option>
                            </select>
                            <select name="xa" class="town" style="margin: 0px; float: right; padding: 5px;">
                                <option value="-1">Chọn phường/xã</option>
                            </select>
                        </div>
                        <div class="form-row clearfix" style="display: flex;">
                            <input type="text" name="diachi" id="diachi" style="width: 100%; padding: 5px;" value="<?php echo $selected_address['diaChi']; ?>">
                        </div>
                        <div class="form-row">
                            <label for="notes">Ghi chú</label>
                            <textarea name="note" style="width: 100%; height: 100px;"></textarea>
                        </div>
                    </div>
                <?php
                } else {
                ?>
                    <div class="section-detail">
                        <div class="form-row clearfix">
                            <div class="form-col fl-left">
                                <label for="fullname">Họ tên</label>
                                <input type="text" name="fullname" id="fullname">
                            </div>
                            <div class="form-col fl-right">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email">
                                <span class="text_error" id="emailError"> </span>

                            </div>

                        </div>
                        <div class="form-row clearfix" style="display: flex;">
                            <div class="form-col fl-right">
                                <label for="sdt">SDT</label>
                                <input type="text" name="phone" id="sdt">
                                <span class="text_error" id="sdtError"> </span>

                            </div>
                        </div>
                        <div class="form-row clearfix">
                            <label for="diachi">Địa chỉ </label>
                            <select name="tinh" class="province" style="padding: 5px; margin-right: 10px;">
                                <option value="-1">Chọn tỉnh thành</option>
                            </select>
                            <select name="quan" class="district" style="padding: 5px;">
                                <option value="-1">Chọn quận/huyện</option>
                            </select>
                            <select name="xa" class="town" style="margin: 0px; float: right; padding: 5px;">
                                <option value="-1">Chọn phường/xã</option>
                            </select>
                        </div>
                        <div class="form-row clearfix" style="display: flex;">
                            <input type="text" name="diachi" id="diachi" style="width: 100%; padding: 5px;">
                        </div>
                        <div class="form-row">
                            <label for="notes">Ghi chú</label>
                            <textarea name="note" style="width: 100%; height: 100px;"></textarea>
                        </div>
                    </div>
                <?php
                }
                ?>



            </div>
            <div class="section" id="order-review-wp">
                <div class="section-head">
                    <h1 class="section-title">Thông tin đơn hàng</h1>
                </div>
                <div class="section-detail">
                    <table class="shop-table">
                        <thead>
                            <tr>
                                <td class="product">
                                    Sản phẩm <i class="fa-solid fa-cart-shopping" style="color: red;"></i>
                                    <span class="quantity"><?php
                                                            $num_order = get_num_order_cart();
                                                            if ($num_order > 0) {
                                                            ?>
                                            <span id="num"><?php echo $num_order; ?></span>
                                        <?php
                                                            }
                                        ?>
                                    </span>
                                </td>
                                <td>Tổng</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($list_buy as $item) {
                            ?>
                                <tr class="cart-item">
                                    <td class="product-name"><?php echo $item['product_title'] ?><strong class="product-quantity">x<?php echo $item['qty'] ?></strong></td>
                                    <td class="product-total"><?php echo number_format($item['sub_tatol'], 0, '.', '.') ?>VND</td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr class="order-total">
                                <td>Tổng đơn hàng:</td>
                                <td><strong class="total-price"><?php
                                                                $tatol = get_tatol_product();
                                                                echo number_format($tatol, 0, '.', '.')
                                                                ?>VND</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment_method" id="direct-payment" value="1">
                        <label for="direct-payment">Thanh toán tại cửa hàng</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment_method" id="payment-home" value="2">
                        <label for="payment-home">Thanh toán tại nhà</label>
                    </div>
                    <div class="place-order-wp clearfix">
                        <input type="submit" id="order-now" name="btn_order_now" value="Đặt hàng">
                    </div>
                </div>
            </div>
        </form>

    </div>

</div>
<div id="add-address-form">
    <form>
        <label for="name">Tên:</label>
        <input type="text" id="name" name="name" placeholder="Nguyen van A">

        <label for="email">Email:</label>
        <input type="email" id="email_txt" name="email" placeholder="abcdef@gmail.com">

        <label for="phone">Điện thoại:</label>
        <input type="text" id="phone" name="phone" placeholder="0123456789">

        <div class="insrtform-row " style="display: flex; flex-direction: column ;">
            <label for="address">Địa chỉ:</label>
            <select name="tinh" id="province" class="province" class="Province">
                <option value="-1">Chọn tỉnh thành</option>
            </select>
            <select name="quan" id="district" class="district" class="Province">
                <option value="-1">Chọn quận/huyện</option>
            </select>
            <select name="xa" class="town" id="town" class="Province" style="margin: 0px; float: right;   margin-bottom: 10px;">
                <option value="-1">Chọn phường/xã</option>
            </select>
            <input type="text" id="address" name="address" placeholder="VD: 230 hùng vương">

        </div>



    </form>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
<?php
if (isset($_SESSION["user"])) {
    $json_addresses = array();

    $sql_address = "SELECT `id_Address`, `name_kh`, `phone`, `email`, `diaChi` FROM `tbl_address` WHERE `id_user`='$user_id'";
    $result_sql = $connect->query($sql_address);

    if ($result_sql->num_rows > 0) {
        $addresses = array();

        while ($row = $result_sql->fetch_assoc()) {
            $address_data = array(
                'id' => $row['id_Address'],
                'name' => $row['name_kh'],
                'phone' => $row['phone'],
                'email' => $row['email'],
                'address' => $row['diaChi']
            );

            $addresses[] = $address_data;
        }

        $json_addresses = json_encode($addresses);
    } else {
        $json_addresses = json_encode([]); // Trả về mảng rỗng nếu không có địa chỉ nào
    }
}
?>
<script>
    $(function() {
        $("#show-dialog").click(function() {
            var addresses = <?php echo $json_addresses; ?>;
            var dialogContent = "<div class='address-container'>";
            addresses.forEach(function(address, index) {
                dialogContent += "<div class='address'>";
                dialogContent += "<h3> <i class='fa-solid fa-location-dot'> </i> Địa chỉ" + (index + 1) + "</h3>";
                dialogContent += "<p><strong>Tên:</strong> " + address.name + "</p>";
                dialogContent += "<p><strong>Địa chỉ:</strong> " + address.address + "</p>";
                dialogContent += "<p><strong>Điện thoại:</strong> " + address.phone + "</p>";
                dialogContent += "<button class='action-button_insert'  data-address-id=" + address.id + ">Chọn</button>"; // Thêm nút sử dụng
                dialogContent += "<button class='action-button_delete' data-address-id=" + address.id + " ><i class='fa-solid fa-trash'></i></button>"; // Thêm nút sử dụng

                dialogContent += "</div>";
            });
            dialogContent += "<button id='add-address' class='action-button'>Thêm Địa chỉ</button></div>"; // Thêm nút thêm dữ liệu


            // Hiển thị dialog
            $("<div></div>").html(dialogContent).dialog({
                title: "Địa chỉ nhận hàng",
                modal: true,
                width: 600,
                height: 400,
                resizable: false
            });

            $("#add-address").click(function() {
                $("#add-address-form").dialog({
                    title: "Thêm Địa chỉ mới",
                    modal: true,
                    width: 350,
                    resizable: false,
                    buttons: {
                        "Thêm": function() {
                            var name = $("#name").val();
                            var email = $("#email_txt").val();
                            var phone = $("#phone").val();
                            var province = $("#province").val();
                            var district = $("#district").val();
                            var town = $("#town").val();
                            var address = $("#address").val();

                            if (name === '' || email === '' || phone === '' || province === '-1' || district === '-1' || town === '-1' || address === '') {
                                alert("Vui lòng điền đầy đủ thông tin!");
                                return;
                            }
                            if (address.length > 50) {
                                alert("Địa chỉ không được quá 50 ký tự!");
                                return;
                            }
                            var phoneRegex = /^0[0-9]{9}$/;
                            var emailRegex = /^[A-Za-z0-9_.]{6,32}@([a-zA-Z0-9]{2,12})(\.[a-zA-Z]{2,12})+$/;

                            if (!phoneRegex.test(phone)) {
                                alert("Số điện thoại không hợp lệ. Bao gồm số 0 đứng đầu. và 10 chữ số!");
                                return;
                            }

                            if (!emailRegex.test(email)) {
                                alert("Email không hợp lệ!");
                                return;
                            }

                            var fullAddress = province + ', ' + district + ', ' + town + ', ' + address;
                            var txt_id = <?php echo json_encode($user_id); ?>;

                            $.ajax({
                                type: "POST",
                                url: "?page=address_user",
                                data: {
                                    txt_id: txt_id,
                                    name: name,
                                    email: email,
                                    phone: phone,
                                    address: fullAddress
                                },
                                success: function(response) {
                                    alert(response);
                                    window.location.reload();

                                },
                                error: function(xhr, status, error) {
                                    console.log(xhr.responseText);
                                }
                            });


                            $(this).dialog("close");
                        },
                        "Hủy": function() {

                            $(this).dialog("close");
                        }
                    }
                });
            });
            $(".action-button_delete").click(function() {
                var addressID = $(this).data('address-id');

                var jsonData = JSON.stringify({
                    address_id: addressID
                });


                var confirmDelete = confirm("Bạn có chắc chắn muốn xóa địa chỉ này không?");
                if (confirmDelete) {
                    $.ajax({
                        type: "POST",
                        url: "?page=delete_address",
                        data: {
                            address_id: addressID,
                        },
                        success: function(response) {
                            alert(response); // Hiển thị thông báo phản hồi
                            window.location.reload();

                        },
                        error: function(xhr, status, error) {
                            // Xử lý lỗi nếu có
                            console.error(xhr.responseText);
                        }
                    });
                }
            });
            $(".action-button_insert").click(function() {
                var addressID = $(this).data('address-id');

                var jsonData = JSON.stringify({
                    address_id: addressID
                });


                var confirmDelete = confirm("Bạn có chắc chắn muốn sử dụng địa chỉ này không?");
                if (confirmDelete) {
                    $.ajax({
                        type: "POST",
                        url: "?page=insert_adress",
                        data: {
                            address_id: addressID,
                        },
                        success: function(response) {
                            alert(response);
                            window.location.reload();

                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }
            });



        });
    });
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="api/data.json"></script>
<script src="api/api.js"></script>