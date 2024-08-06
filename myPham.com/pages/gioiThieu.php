<?php
$num_per_page = 5;

$page = isset($_GET['trang']) ? $_GET['trang'] : 1;

$sql_count = "SELECT COUNT(*) AS total_rows FROM `tb_post`";
$result_count = $connect->query($sql_count);
$row_count = $result_count->fetch_assoc();
$total_rows = $row_count['total_rows'];



$num_pages = ceil($total_rows / $num_per_page);

$start = ($page - 1) * $num_per_page;


?>
<div id="main-content-wp" class="clearfix blog-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Blog</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-blog-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title">Blog</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        <?php
                        $sql_blog = "SELECT * FROM `tb_post` LIMIT $start, $num_per_page";
                        $result_blogs = $connect->query($sql_blog);
                        if ($result_blogs->num_rows > 0) {
                            foreach ($result_blogs as $item) {
                        ?>
                                <li class="clearfix">
                                    <a href="?page=detail_blog&id=<?php echo $item['id'] ?>" class="thumb fl-left">
                                        <img src="admin/<?php echo $item['img_post'] ?>" alt="">
                                    </a>
                                    <div class="info fl-right">
                                        <a href="?page=detail_blog&id=<?php echo $item['id'] ?>" title="<?php echo $item['biDanh'] ?>" class="title"><?php echo $item['tieuDe'] ?></a>
                                        <span class="create-date"><?php echo $item['date'] ?></span>
                                        <?php echo $item['moTa'] ?>
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
                    echo get_padding($num_pages, $page,"gioiThieu" );
                    ?>
                </div>
            </div>
        </div>
        <div class="sidebar fl-left">
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
                    <a href="?page=detail_blog_product" title="" class="thumb">
                        <img src="admin/upload/body-lotion-1024x683.png" alt="">

                    </a>
                </div>
            </div>
        </div>
    </div>
</div>