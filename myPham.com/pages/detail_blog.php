<div id="main-content-wp" class="clearfix detail-blog-page">
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
        <?php
        $id = $_GET['id'];
        $sql_query_blog_by_id = "SELECT * FROM `tb_post` WHERE `id`=$id";
        $result_query_blog_by_id = $connect->query($sql_query_blog_by_id);
        if ($result_query_blog_by_id->num_rows > 0) {
            $row = $result_query_blog_by_id->fetch_assoc();
        ?>
            <div class="main-content fl-right">
                <div class="section" id="detail-blog-wp">
                    <div class="section-head clearfix">
                        <h3 class="section-title"><?php echo $row['tieuDe'] ?></h3>
                    </div>
                    <div class="section-detail">
                        <span class="create-date"><?php echo $row['date'] ?></span>
                        <p><?php echo $row['moTa'] ?></p>

                        <div class="detail">
                        <?php echo $row['chiTiet'] ?>
                        </div>
                    </div>
                    
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
        <?php
        }
        ?>
        

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
                    <a href="?page=detail_product" title="" class="thumb">
                        <img src="admin/upload/body-lotion-1024x683.png" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>