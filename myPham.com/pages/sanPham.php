<style>
    .filter-group h4 {
        margin-bottom: 10px;
        font-size: 16px;
        color: #555;
    }

    .filter-group select,
    .filter-group input[type="text"] {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }

    button[type="submit"] {
        background-color: #007bff;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 3px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button[type="submit"]:hover {
        background-color: #0056b3;
    }

    #min_price,
    #max_price {
        margin-bottom: 10px;
        width: 100px;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 5px;
        outline: none;
        transition: border-color 0.3s ease;
    }

    #min_price:focus,
    #max_price:focus {
        border-color: #007bff;
    }


    .disabled {
        pointer-events: none;
        color: white;
        background-color: #777070 !important;
        text-align: center;
    }
</style>
<?php
$num_per_page = 8;

$page = isset($_GET['trang']) ? $_GET['trang'] : 1;

$sql_count = "SELECT COUNT(*) AS total_rows FROM `product`";
$result_count = $connect->query($sql_count);
$row_count = $result_count->fetch_assoc();
$total_rows = $row_count['total_rows'];



$num_pages = ceil($total_rows / $num_per_page);

$start = ($page - 1) * $num_per_page;


?>

<div id="main-content-wp" class="clearfix category-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Điện thoại</a>g
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-product-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title fl-left">Tất Cả Sản Phẩm</h3>
                    <div class="filter-wp fl-right">
                        <p class="desc">Hiển thị <?php echo $start; ?> trên <?php echo $total_rows; ?> sản phẩm</p>
                        <div class="form-filter">
                            <form method="POST" action="?page=category_id">
                                <select name="select">
                                    <option value="0">Sắp xếp</option>
                                    <option value="1">Từ A-Z</option>
                                    <option value="2">Từ Z-A</option>
                                    <option value="3">Giá cao xuống thấp</option>
                                    <option value="4">Giá thấp lên cao</option>
                                </select>
                                <button type="submit">Lọc</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <?php
                        $sql_product = "SELECT * FROM `product` LIMIT $start, $num_per_page ";
                        $result_product = $connect->query($sql_product);
                        if ($result_product->num_rows > 0) {
                            foreach ($result_product as $item) {
                        ?>
                                <li>
                                    <a href="?page=detail_product&id=<?php echo $item['productID'] ?>" title="" class="thumb">
                                        <img src="admin/<?php echo $item['img_avatar']; ?>" alt="">

                                    </a>
                                    <a href="?page=detail_product&id=<?php echo $item['productID'] ?>" title="" class="product-name"><?php echo $item['productName'] ?></a>
                                    <div class="price">
                                        <span class="new"><?php echo  number_format($item['price'], 0, '.', '.') ?></span>
                                        <span class="old"><?php echo  number_format((int)$item['price'] * 1.2, 0, '.', '.') ?></span>
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
            <div class="section" id="paging-wp">
                <div class="section-detail">

                    <?php
                    echo get_padding($num_pages, $page, "sanPham");
                    ?>

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
            <div class="section" id="filter-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Bộ lọc</h3>
                </div>
                <div class="section-detail">
                    <form method="POST" action="">
                        <div class="filter-group">
                            <h4>Danh mục</h4>
                            <select name="category">
                                <option value="all">Tất cả</option>
                                <option value="face">Chăm sóc da mặt</option>
                                <option value="body">Chăm sóc cơ thể</option>
                                <option value="makeup">Trang điểm</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <h4>Thương hiệu</h4>
                            <select name="brand">
                                <option value="all">Tất cả</option>
                                <option value="loreal">L'Oréal</option>
                                <option value="maybelline">Maybelline</option>
                                <option value="neutrogena">Neutrogena</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <h4>Loại da</h4>
                            <select name="skin_type">
                                <option value="all">Tất cả</option>
                                <option value="oily">Da dầu</option>
                                <option value="dry">Da khô</option>
                                <option value="combination">Da hỗn hợp</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <h4>Giá</h4>
                            <div id="price-range-slider"></div>
                            <input type="number" id="min_price" name="min_price" min="0" step="10000" placeholder="Giá từ" style="margin-right: 5px;">
                            <input type="number" id="max_price" name="max_price" min="0" step="10000" placeholder="Giá đến" style="margin-left: 5px;">
                        </div>



                        <button type="submit">Lọc</button>
                    </form>
                </div>
            </div>
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="?page=detail_product" title="" class="thumb">
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