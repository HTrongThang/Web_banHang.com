<script src="https://cdn.jsdelivr.net/npm/jquery-zoom/jquery.zoom.min.js"></script>
<link rel="stylesheet" href="public/css/import/cmt.css">
<script src="public/js/cmmt.js"></script>
<link rel="stylesheet" href="./public/css/import/single_styles.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


<style>
    .zoomLens {
        width: 50px;
        height: 50px;
    }

    .zoomWindow {
        top: 50px;
        left: 50px;
    }

    .zoomWindow {
        width: 400px;
        height: 400px;
    }
</style>

<div id="main-content-wp" class="clearfix detail-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Chi Tiết Sản Phẩm</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="main-content fl-right">
            <?php
            $id = $_GET['id'];
            $sql_product_by_id = "SELECT * FROM `product` WHERE `productID`=$id ";
            $result_product_by_id = $connect->query($sql_product_by_id);
            if ($result_product_by_id->num_rows > 0) {
                $row_pro = $result_product_by_id->fetch_assoc();
                $sql_pro_img_by_id = "SELECT * FROM `product_image` WHERE `productID`=$id";
                $result_img_by_id = $connect->query($sql_pro_img_by_id);
            ?>
                <div class="section" id="detail-product-wp">
                    <div class="section-detail clearfix">
                        <div class="thumb-wp fl-left">
                            <a href="" title="" id="main-thumb">
                                <img id="zoom" src="admin/<?php echo $row_pro['img_avatar']; ?>" data-zoom-image="admin/<?php echo $row_pro['img_avatar']; ?>" />
                            </a>
                            <div id="list-thumb">
                                <?php
                                foreach ($result_img_by_id as $item) {
                                ?>
                                    <a href="" data-image="admin/upload/<?php echo $item['productImage'] ?>" data-zoom-image="admin/upload/<?php echo $item['productImage'] ?>">
                                        <img id="zoom" src="admin/upload/<?php echo $item['productImage'] ?>" />
                                    </a>
                                <?php
                                }
                                ?>


                            </div>
                        </div>
                        <div class="thumb-respon-wp fl-left">
                            <img src="admin/<?php echo $row_pro['img_avatar']; ?>" alt="">
                        </div>
                        <div class="info fl-right">
                            <h3 class="product-name"><?php echo $row_pro['productName']; ?></h3>
                            <div class="desc" style="display: flex; flex-direction: column;">
                                <div style="display: flex;">
                                    <p style="padding-right: 5px; color: black; font-weight: bold;">
                                        Thời gian đăng bán:
                                    </p>
                                    <Span> <?php echo $row_pro['date']; ?> </Span>
                                </div>
                                <?php
                                $ngayhethan = $row_pro['ngayHetHan'];
                                $ngayHienTai = date('Y-m-d');
                                $ngayCanhBao = date('Y-m-d', strtotime($ngayhethan . ' - 7 days'));
                                ?>
                                <div style="display: flex;">
                                    <p style="padding-right: 5px; color: black; font-weight: bold;">
                                        Ngày hết hạn:
                                    </p>
                                    <span>
                                        <?php echo $ngayhethan; ?>
                                    </span>


                                </div>
                                <?php if (isset($ngayHienTai) && isset($ngayCanhBao) && $ngayHienTai >= $ngayCanhBao && $ngayHienTai <= $ngayhethan) : ?>
                                    <div style="color: red; font-weight: bold;">
                                    <i class="fa-solid fa-triangle-exclamation"></i>  Cảnh báo: Hạn sử dụng gần tới!
                                    </div>
                                <?php endif; ?>
                                <div style="display: flex;">
                                    <p style="padding-right: 5px; color: black; font-weight: bold;">
                                        Người bán :
                                    </p>
                                    <span> <?php echo $row_pro['nguoiTao']; ?> </span>
                                </div>

                                <div style="display: flex;">
                                    <p style="padding-right: 5px; color: black; font-weight: bold;">
                                        Loại sản phẩm:
                                    </p>
                                    <?php
                                    $cate_pro = $row_pro['productCategoryID'];
                                    $sql_pro_cate = "SELECT `productCategoryName` FROM `productcategory` WHERE `productCategoryID` = $cate_pro";
                                    $result_pro_cate = $connect->query($sql_pro_cate);
                                    if ($result_pro_cate && $result_pro_cate->num_rows > 0) {
                                        $row_pro_cate = $result_pro_cate->fetch_assoc();
                                        $name_cate = $row_pro_cate['productCategoryName'];
                                        echo $name_cate;
                                    } else {
                                        echo "Không tìm thấy loại sản phẩm";
                                    }
                                    ?>
                                </div>

                            </div>
                            <div class="desc">
                                <p style="padding-right: 5px; color: black; font-weight: bold;">Mô Tả sản phẩm:</p>
                                <?php echo $row_pro['description']; ?>
                            </div>

                            <div style="display: flex;">
                                <p style="padding-right: 5px; color: black; font-weight: bold;">
                                    Số lượng Sản phẩm:
                                </p>
                                <?php echo $row_pro['quantity']; ?>
                            </div>
                            <div class="num-product">

                                <span class="title" style="padding-right: 5px; color: black; font-weight: bold;"> Tình Trạng Sản phẩm: </span>
                                <span class="status">
                                    <?php
                                    if ((int)$row_pro['quantity'] > 0) {
                                        echo "Còn hàng";
                                    } else {
                                        echo "Hết hàng";
                                    }
                                    ?>
                                </span>

                            </div>

                            <div class="price" style="display: flex; flex-direction: column;">
                                <span class="old" style="color: black; font-size: 13px; text-decoration: line-through;">Giá cũ: <?php echo  number_format((int)$row_pro['price'] * 1.2, 0, '.', '.') ?></span>

                                <span class="new" style="font-size: 20px;">Giá mới: <?php echo  number_format($row_pro['price'], 0, '.', '.') ?> VND</span>
                            </div>
                            <div style="margin-bottom: 10px;">
                                <a id="minus" title=""><i class="fa fa-minus"></i></a>
                                <input type="text" name="num-order" value="1" id="num-order" max="<?php
                                                                                                    $productID = $row_pro['productID'];
                                                                                                    $sql = "SELECT `quantity` FROM `product` WHERE `productID` = $productID";
                                                                                                    $result = $connect->query($sql);

                                                                                                    if ($result->num_rows > 0) {
                                                                                                        $row = $result->fetch_assoc();
                                                                                                        (int)$quantity = $row['quantity'];
                                                                                                        echo $quantity;
                                                                                                    } else {
                                                                                                        $quantity = 0;
                                                                                                    }
                                                                                                    ?>">
                                <a id="plus" title=""><i class="fa fa-plus"></i></a>
                            </div>
                            <?php if ((int)$row_pro['quantity'] > 0) { ?>
                                <a href="?page=add_cart&id=<?php echo $row_pro['productID']; ?>&qty=" id="add-to-cart" title="Thêm giỏ hàng" class="add-cart">Thêm giỏ hàng</a>
                            <?php } else if (strtotime($row_pro['ngayHetHan']) <= strtotime(date('Y-m-d'))) { ?>
                                <a title="Hết hàng" class="add-cart" style="background-color: red;">Hết hạn</a>
                            <?php } else { ?>
                                <a title="Hết hàng" class="add-cart" style="background-color: gray;">Hết hàng</a>
                            <?php } ?>




                        </div>
                    </div>
                </div>
                <div class="section" id="post-product-wp">
                    <div class="tab">
                        <button class="tablinks" onclick="openCity(event, 'mota')" style="width: 50%;">Mô tả sản phẩm</button>
                        <button class="tablinks" onclick="openCity(event, 'comment') " style="width: 50%;">Bình luận sản phẩm</button>
                    </div>
                    <div id="mota" class="tabcontent">
                        <div class="section-detail">
                            <p>
                                <?php echo $row_pro['productDetail'] ?>
                            </p>
                        </div>
                        <div class="section" id="social-wp">
                            <div class="section-detail">
                                <div class="fb-like" data-href="" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                                <div class="g-plusone-wp">
                                    <div class="g-plusone" data-size="medium"></div>
                                </div>
                                <div class="fb-comments" id="fb-comment" data-href="" data-numposts="5"></div>
                            </div>
                        </div>
                    </div>

                    <div id="comment" class="tabcontent">
                        <div class="comments-section">
                            <!-- Comment Form -->
                            <div class="comment-form">
                                <form id="comment_form" method="post">
                                    <div class="form-group">
                                        <label for="user-comment">Comment:</label>
                                        <textarea id="user_comment" name="user_comment" rows="4" required></textarea>

                                    </div>
                                    <button type="submit" class="btn btn-outline-primary" name="btn_binhLuan">Bình luận</button>
                                </form>
                            </div>

                            <?php
                            $sql = "SELECT * FROM `tb_comment` WHERE `product_id`='$id'";
                            $result_sql_select_comment = $connect->query($sql);
                            if ($result_sql_select_comment->num_rows > 0) {

                                while ($row = $result_sql_select_comment->fetch_assoc()) {
                                    $user_avatar = '';
                                    $user_name = '';
                                    $timestamp = '';

                                    $id_user = $row['user_id'];
                                    $sql_img_user = "SELECT `user_avater`, `firstName` FROM `users` WHERE `userID`= '$id_user'";
                                    $result_img_user = $connect->query($sql_img_user);
                                    if ($result_img_user->num_rows > 0) {
                                        $user_data = $result_img_user->fetch_assoc();
                                        $user_avatar = $user_data['user_avater'];
                                        $user_name = $user_data['firstName'];
                                    }
                            ?>
                                    <div class="comments">
                                        <!-- Comment -->
                                        <div class="comment">
                                            <div class="user-info">
                                                <div class="user-avatar">
                                                    <img src="<?php echo $user_avatar; ?>" alt="User Avatar">
                                                </div>
                                                <div class="user-details">
                                                    <div class="user-name"><?php echo $user_name; ?></div>
                                                    <div class="timestamp"><?php echo $row['created_at']; ?></div>
                                                </div>
                                            </div>
                                            <div class="comment-text">
                                                <?php echo $row['comment']; ?>
                                            </div>
                                            <div class="comment-actions">
                                                <button class="action-btn like-btn"><i class="fas fa-thumbs-up"></i> Like</button>
                                                <button class="action-btn reply-btn"><i class="fas fa-reply"></i> Reply</button>
                                                <button class="action-btn report-btn"><i class="fas fa-flag"></i> Report</button>
                                                <span class="likes-count">10 likes</span>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                }
                            }
                            ?>


                        </div>
                    </div>


                </div>
            <?php

            }
            ?>

            <div class="section" id="same-category-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm cùng chuyên mục :</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        <?php
                        $cate_product = $row_pro['productCategoryID'];
                        $sql_pro_cate = "SELECT * FROM `product` WHERE `productCategoryID`=$cate_product";
                        $result_pro_by_cate = $connect->query($sql_pro_cate);
                        if ($result_pro_by_cate->num_rows > 0) {
                            foreach ($result_pro_by_cate as $key) {
                        ?>
                                <li>
                                    <a href="?page=detail_product&id=<?php echo $key['productID'] ?>" title="" class="thumb">
                                        <img src="admin/<?php echo $key['img_avatar']; ?>" alt="">
                                    </a>
                                    <a href="?page=detail_product&id=<?php echo $key['productID'] ?>" title="" class="product-name"><?php echo $key['productName'] ?></a>
                                    <div class="price">
                                        <span class="new"><?php echo  number_format($key['price'], 0, '.', '.') ?></span>
                                        <span class="old"><?php echo  number_format((int)$key['price'] * 1.2, 0, '.', '.') ?></span>
                                    </div>
                                    <div class="action clearfix">
                                        <a href="?page=cart" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        <a href="?page=checkout" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                    </div>
                                </li>
                        <?php
                            }
                        }
                        ?>



                    </ul>
                </div>
            </div>
        </div>
        <div class="sidebar fl-left">
            <div class="section" id="category-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Danh mục sản phẩm</h3>
                </div>
                <div class="secion-detail">
                    <ul class="list-item">
                        <?php
                        $sql_category_product = "SELECT * FROM `productcategory`";
                        $resulut_cate = $connect->query($sql_category_product);
                        if ($resulut_cate->num_rows > 0) {
                            foreach ($resulut_cate as $item) {
                        ?>
                                <li>
                                    <a href="?page=category_id&id_cate=<?php echo $item['productCategoryID']; ?>" title=""><?php echo $item['productCategoryName']; ?></a>

                                </li>
                        <?php
                            }
                        }
                        ?>


                    </ul>
                </div>
            </div>
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="" title="" class="thumb">
                        <img src="admin/upload/body-lotion-1024x683.png" alt="">

                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        // Kích hoạt zoom cho hình ảnh chính
        $('#main-thumb').zoom({
            zoomWindowWidth: 200, // Thiết lập chiều rộng của khung zoom nhỏ
            zoomWindowHeight: 200 // Thiết lập chiều cao của khung zoom nhỏ
        });

        // Kích hoạt zoom cho các hình ảnh phụ
        $('#list-thumb a').each(function() {
            $(this).find('img').zoom({
                zoomWindowWidth: 100, // Thiết lập chiều rộng của khung zoom nhỏ
                zoomWindowHeight: 100 // Thiết lập chiều cao của khung zoom nhỏ
            });
        });

        $('#comment_form').on('submit', function(e) {
            e.preventDefault();
            var cmt = $('#user_comment').val();

            var id_product = <?php echo $_GET['id']; ?>;

            $.ajax({
                type: 'POST',
                url: '?page=comment',
                data: {
                    cmt: cmt,
                    id_product: id_product
                },
                success: function(data) {
                    alert(data);
                    window.location.reload();
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert('An error occurred: ' + error);
                }
            });
        });
    });
</script>
<script>
    document.getElementById('plus').addEventListener('click', function() {
        var numOrderInput = document.getElementById('num-order');
        var maxQuantity = parseInt(numOrderInput.getAttribute('max'));
        var currentQuantity = parseInt(numOrderInput.value);
        if (currentQuantity < maxQuantity) {
            numOrderInput.value = currentQuantity + 1;
        }
    });

    document.getElementById('minus').addEventListener('click', function() {
        var numOrderInput = document.getElementById('num-order');
        if (parseInt(numOrderInput.value) > 1) {
            numOrderInput.value = parseInt(numOrderInput.value) - 1;
        }
    });

    document.getElementById('add-to-cart').addEventListener('click', function(event) {
        event.preventDefault();
        var productId = "<?php echo $row_pro['productID']; ?>";
        var qty = document.getElementById('num-order').value;
        var url = this.getAttribute('href') + qty;
        window.location.href = url;
    });
</script>