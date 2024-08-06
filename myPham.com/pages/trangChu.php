<div id="main-content-wp" class="home-page clearfix">
    <div class="wp-inner">
        <div class="main-content fl-right">
            <div class="section" id="slider-wp">
                <div class="section-detail">
                <div class="item">
                        <img src="https://intphcm.com/data/upload/banner-my-pham-vang-kim.jpg" alt="">

                    </div>
                    <div class="item">
                        <img src="https://intphcm.com/data/upload/banner-my-pham-dep.jpg" alt="">

                    </div>
                    <div class="item">
                        <img src="https://baivanmau.edu.vn/anh-bia-my-pham-dep/imager_7_19966_700.jpg" alt="">
                    </div>
                  
                </div>
            </div>
            <div class="section" id="support-wp">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-1.png">
                            </div>
                            <h3 class="title">Miễn phí vận chuyển</h3>
                            <p class="desc">Tới tận tay khách hàng</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-2.png">
                            </div>
                            <h3 class="title">Tư vấn 24/7</h3>
                            <p class="desc">1900.9999</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-3.png">
                            </div>
                            <h3 class="title">Tiết kiệm hơn</h3>
                            <p class="desc">Với nhiều ưu đãi cực lớn</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-4.png">
                            </div>
                            <h3 class="title">Thanh toán nhanh</h3>
                            <p class="desc">Hỗ trợ nhiều hình thức</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-5.png">
                            </div>
                            <h3 class="title">Đặt hàng online</h3>
                            <p class="desc">Thao tác đơn giản</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="section" id="feature-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm nổi bật</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        <?php
                        $sql_product_sale = "SELECT * FROM `product` WHERE isHot=1";
                        $result_sql_product_sale = $connect->query($sql_product_sale);
                        if ($result_sql_product_sale->num_rows > 0) {
                            foreach ($result_sql_product_sale as $item) {
                        ?>
                                <li>
                                    <a href="?page=detail_product&id=<?php echo $item['productID'] ?>" title="" class="thumb">
                                        <img src="admin/<?php echo $item['img_avatar']; ?>" alt="" style="height: 200px;">
                                    </a>
                                    <a href="?page=detail_product&id=<?php echo $item['productID'] ?>" title="" class="product-name"><?php echo mb_strimwidth($item['productName'], 0, 0.8 * mb_strlen($item['productName']), "...") ?></a>

                                    <div class="price">
                                        <span class="new"><?php echo  number_format($item['price'], 0, '.', '.') . "đ" ?></span>
                                        <span class="old"><?php echo  number_format((int)$item['price'] * 1.2, 0, '.', '.') . "đ" ?></span>
                                    </div>
                                    <div class="action clearfix">
                                        <a href="?page=add_cart&id=<?php echo $item['productID']; ?>" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>

                                        <a href="?page=checkout" title="" class="buy-now fl-right">Mua ngay</a>
                                    </div>
                                </li>
                        <?php
                            }
                        }
                        ?>


                    </ul>
                </div>
            </div>
            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <h3 class="section-title">SẢN PHẨM MỚI</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <?php
                        $sql_pro_new = "SELECT * FROM `product` WHERE isNew=1";
                        $result_pro_new = $connect->query($sql_pro_new);
                        if ($result_pro_new->num_rows > 0) {
                            foreach ($result_pro_new as $item) {
                        ?>
                                <li>
                                    <a href="?page=detail_product&id=<?php echo $item['productID'] ?>" title="" class="thumb">
                                        <img src="admin/<?php echo $item['img_avatar']; ?>" alt="" style="height: 200px;">
                                    </a>
                                    <a href="?page=detail_product&id=<?php echo $item['productID'] ?>" title="" class="product-name"><?php echo mb_strimwidth($item['productName'], 0, 0.8 * mb_strlen($item['productName']), "...") ?></a>

                                    <div class="price">
                                        <span class="new"><?php echo  number_format($item['price'], 0, '.', '.') . "đ" ?></span>
                                        <span class="old"><?php echo  number_format((int)$item['price'] * 1.2, 0, '.', '.') . "đ" ?></span>
                                    </div>
                                    <div class="action clearfix">
                                        <a href="?page=add_cart&id=<?php echo $item['productID']; ?>" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>

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
            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <h3 class="section-title">CHĂM SÓC DA</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <?php
                        $sql_producT_sanpham = "SELECT * FROM `product` WHERE `productCategoryID`=6";
                        $result_pro_chamda = $connect->query($sql_producT_sanpham);
                        if ($result_pro_chamda->num_rows > 0) {
                            foreach ($result_pro_chamda as $item) {
                        ?>
                                <li>
                                    <a href="?page=detail_product&id=<?php echo $item['productID'] ?>" title="" class="thumb">
                                        <img src="admin/<?php echo $item['img_avatar']; ?>" alt="" style="height: 200px;">
                                    </a>
                                    <a href="?page=detail_product&id=<?php echo $item['productID'] ?>" title="" class="product-name"><?php echo mb_strimwidth($item['productName'], 0, 0.8 * mb_strlen($item['productName']), "...") ?></a>

                                    <div class="price">
                                        <span class="new"><?php echo  number_format($item['price'], 0, '.', '.') . "đ" ?></span>
                                        <span class="old"><?php echo  number_format((int)$item['price'] * 1.2, 0, '.', '.') . "đ" ?></span>
                                    </div>
                                    <div class="action clearfix">
                                        <a href="?page=add_cart&id=<?php echo $item['productID']; ?>" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>

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

            <div class="section" id="selling-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm Sale</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        <?php
                        $sql_product_sale = "SELECT * FROM `product` WHERE sale=1";
                        $result_sql_product_sale = $connect->query($sql_product_sale);
                        if ($result_sql_product_sale->num_rows > 0) {
                            foreach ($result_sql_product_sale as $item) {
                        ?>
                                <li class="clearfix">
                                    <a href="?page=detail_product&id=<?php echo $item['productID']; ?>" title="" class="thumb fl-left">
                                        <img src="admin/<?php echo $item['img_avatar']; ?>" alt="">
                                    </a>
                                    <div class="info fl-right">
                                        <a href="?page=detail_product&id=<?php echo $item['productID']; ?>" title="" class="product-name"><?php echo $item['productName']; ?></a>
                                        <div class="price">
                                            <span class="new"><?php echo  number_format($item['price'], 0, '.', '.') ?></span>
                                            <span class="old"><?php echo  number_format((int)$item['price'] * 1.2, 0, '.', '.') ?></span>

                                        </div>
                                        <a href="" title="" class="buy-now">Mua ngay</a>
                                    </div>
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
        $('.add-cart').click(function(e) {
            e.preventDefault();
            var url = $(this).attr('href');
            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    alert('Thêm sản phẩm thành công vào giỏ hàng!');
                    window.location.reload();

                },
                error: function() {
                    alert('Có lỗi xảy ra khi thêm vào giỏ hàng!');
                }
            });
        });
    });
</script>