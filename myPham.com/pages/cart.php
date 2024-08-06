<?php
$list_buy = get_list_by_cart();
?>
<div id="main-content-wp" class="cart-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?page=trangChu" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="?pages=cart" title="">Giỏ hàng</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <div class="section" id="info-cart-wp">
            <div class="section-detail table-responsive">
                <?php
                if (!empty($list_buy)) {
                ?>
                    <form action="?page=update_cart" method="post">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>Mã sản phẩm</td>
                                    <td>Ảnh sản phẩm</td>
                                    <td>Tên sản phẩm</td>
                                    <td>Giá sản phẩm</td>
                                    <td>Số lượng</td>
                                    <td>Thành tiền</td>
                                    <td></td>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($list_buy as $item) {
                                ?>
                                    <tr>
                                        <td><?php echo $item['code'] ?></td>
                                        <td>
                                            <a href="" title="" class="thumb">
                                                <img src="admin/<?php echo $item['product_thumd'] ?>" alt="">
                                            </a>
                                        </td>
                                        <td>
                                            <a href="<?php echo $item['url'] ?>" title="" class="name-product"><?php echo $item['product_title'] ?></a>
                                        </td>
                                        <td><?php echo number_format($item['price'], 0, '.', '.') ?>VND</td>
                                        <td>
                                            <input type="number" min="1" max="<?php echo $item['qtyPro'] ?>" name="qty[<?php echo $item['id'] ?>]" value="<?php echo $item['qty'] ?>" class="num-order" style="width: 50px;">
                                        </td>
                                        <td><?php echo number_format($item['sub_tatol'], 0, '.', '.') ?>VND</td>

                                        <td>
                                            <a href="<?php echo $item['url_delete_cart'] ?>" title="" class="del-product" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng không?')">
                                                <i class="fa fa-trash-o"></i>
                                            </a>

                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>


                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="7">
                                        <div class="clearfix">
                                            <p id="total-price" class="fl-right">Tổng giá: <span><?php
                                                                                                    $tatol = get_tatol_product();
                                                                                                    echo number_format($tatol, 0, '.', '.')
                                                                                                    ?>VND</span></p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="7">
                                        <div class="clearfix">
                                            <div class="fl-right">
                                                <input type="submit" id="update-cart" name="btn_update_cate" value="Cập nhật giỏ hàng" onclick="return confirm('Bạn có chắc chắn muốn cập nhật sản phẩm giỏ hàng không?')">

                                                <a href="?page=checkout" title="" id="checkout-cart">Thanh toán</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </form>
                <?php
                } else {
                ?>
                    <div class="section">
                        <p>Không có sản phẩm trong giỏ hàng !</p>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
        <div class=" section" id="action-cart-wp">
            <div class="section-detail">
                <p class="title">Click vào <span>“Cập nhật giỏ hàng”</span> để cập nhật số lượng. Nhập vào số lượng <span>0</span> để xóa sản phẩm khỏi giỏ hàng. Nhấn vào thanh toán để hoàn tất mua hàng.</p>
                <a href="?page=trangChu" title="" id="buy-more">Mua tiếp</a><br />
                <a href="?page=delete_all_cart" title="" id="delete-cart" onclick="return confirm('Bạn có chắc chắn muốn xóa toàn bộ sản phẩm này khỏi giỏ hàng không?')">Xóa giỏ hàng</a>
            </div>
        </div>
    </div>
</div>