<!DOCTYPE html>
<html>

<head>
    <title>HASAKI STORE</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="public/css/bootstrap/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
    <link href="public/css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="public/reset.css" rel="stylesheet" type="text/css" />


    <link href="public/css/bootstrap-5.3.3-dist/bootstrap-5.3.3-dist/css/bootstrap-grid.min.css" rel="stylesheet" type="text/css" />


    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link href="public/css/carousel/owl.carousel.css" rel="stylesheet" type="text/css" />
    <link href="public/css/carousel/owl.theme.css" rel="stylesheet" type="text/css" />
    <link href="public/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="public/style.css" rel="stylesheet" type="text/css" />
    <link href="public/responsive.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="public/js/jquery-2.2.4.min.js" type="text/javascript"></script>
    <script src="public/js/elevatezoom-master/jquery.elevatezoom.js" type="text/javascript"></script>
    <script src="public/js/bootstrap/bootstrap.min.js" type="text/javascript"></script>
    <script src="public/js/carousel/owl.carousel.js" type="text/javascript"></script>
    <script src="public/js/main.js" type="text/javascript"></script>
    <script src="public/css/bootstrap-5.3.3-dist/bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>

    </body>
</head>

<body>
    <div id="site">
        <div id="container">
            <div id="header-wp">
                <div id="head-top" class="clearfix">
                    <div class="wp-inner">
                        <a href="" title="" id="payment-link" class="fl-left">Hình thức thanh toán</a>
                        <div id="main-menu-wp" class="fl-right">
                            <ul id="main-menu" class="clearfix">
                                <?php
                                $sqL_category = "SELECT * FROM `category`";
                                $result_cate = $connect->query($sqL_category);
                                if ($result_cate->num_rows > 0) {
                                    foreach ($result_cate as $item) {
                                ?>
                                        <li>
                                            <a href="?page=<?php echo $item['biDanh'] ?>" title=""><?php echo $item['tieuDe'] ?></a>
                                        </li>
                                <?php
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div id="head-body" class="clearfix">
                    <div class="wp-inner">
                        <a href="?page=trangChu" title="" id="logo" class="fl-left"><img src="https://hasaki.vn/v3/images/graphics/logo_site.svg" style="padding-top: 5px;" /></a>
                        <div id="search-wp" class="fl-left">
                            <form method="POST" action="?page=search">
                                <input type="text" name="s" id="s" placeholder="Nhập từ khóa tìm kiếm tại đây!">
                                <button type="submit" id="sm-s">Tìm kiếm</button>
                            </form>
                        </div>
                        <div id="action-wp" class="fl-right">
                            <div id="advisory-wp" class="fl-left">
                                <span class="title">Tư vấn</span>
                                <span class="phone">0356.587.127</span>
                            </div>


                            <div id="btn-respon" class="fl-right"><i class="fa fa-bars" aria-hidden="true"></i></div>
                            <a href="?page=cart" title="giỏ hàng" id="cart-respon-wp" class="fl-right">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                            </a>
                            <div id="btn-respon" class="fl-right"><i class="fa fa-bars" aria-hidden="true"></i></div>

                            <div id="user-wp" class="fl-left" style="position: relative;">

                                <?php

                                if (isset($_SESSION["user"])) {
                                    $username = $_SESSION["user"];
                                    $sql_query_user_id = "SELECT `userID` FROM `users` WHERE `username`='$username'";
                                    $result_sql_query_user_id = $connect->query($sql_query_user_id);

                                    if ($result_sql_query_user_id->num_rows > 0) {
                                        $row_sql_query = $result_sql_query_user_id->fetch_assoc();
                                        $user_id = $row_sql_query['userID'];
                                        $sql_query_info = "SELECT * FROM `users` WHERE `userID`='$user_id'";
                                        $resut_sql_query_info = $connect->query($sql_query_info);
                                        $item = $resut_sql_query_info->fetch_assoc();
                                ?>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle pad" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <img src="<?php echo $item['user_avater']?>" alt="" srcset="" style="width: 50px;">

                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="?page=showCart">Giỏ hàng</a></li>

                                                <li><a class="dropdown-item" href="?page=info_user">Thông tin người dùng</a></li>
                                                <li><a class="dropdown-item" href="?page=logout">Đăng xuất</a></li>

                                            </ul>
                                        </div>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-regular fa-user"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="?page=showLogin">Đăng nhập</a></li>
                                            <li><a class="dropdown-item" href="?page=showLogin">Đăng ký</a></li>
                                        </ul>
                                    </div>
                                <?php } ?>

                            </div>

                            <div class="fl-right" style="border-right: 1px solid #590d3433; position: absolute; top: 64px; right: 243px; font-size: 80px;"><i class="fa-solid fa-pipe"></i></div>



                            <div id="cart-wp" class="fl-right">
                                <div id="btn-cart">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    <?php
                                    $num_order = get_num_order_cart();
                                    if ($num_order > 0) {
                                    ?>
                                        <span id="num"><?php echo $num_order; ?></span>
                                    <?php
                                    }
                                    ?>

                                </div>
                                <div id="dropdown">
                                    <p class="desc">Có <span><?php echo $num_order; ?></span> trong giỏ hàng</p>
                                    <ul class="list-cart">
                                        <?php
                                        $list_buy = get_list_by_cart();
                                        if ((int)$list_buy > 0) {
                                            foreach ($list_buy as $item) {
                                        ?>
                                                <li class="clearfix">
                                                    <a href="" title="" class="thumb fl-left">
                                                        <img src="admin/<?php echo $item['product_thumd'] ?>" alt="">
                                                    </a>
                                                    <div class="info fl-right">
                                                        <a href="" title="" class="product-name"><?php echo $item['product_title'] ?>"</a>
                                                        <p class="price"><?php echo number_format($item['price'], 0, '.', '.') ?>VND"</p>
                                                        <p class="qty">Số lượng: <span><?php echo $item['qty'] ?>"</span></p>
                                                    </div>
                                                </li>
                                        <?php
                                            }
                                        }
                                        ?>


                                    </ul>
                                    <div class="total-price clearfix">
                                        <p class="title fl-left">Tổng:</p>
                                        <p class="price fl-right"><?php
                                                                    $tatol = get_tatol_product();
                                                                    echo number_format($tatol, 0, '.', '.')
                                                                    ?>VND</p>
                                    </div>

                                    <div class="action-cart clearfix">
                                        <a href="?page=cart" title="Giỏ hàng" class="view-cart fl-left">Giỏ hàng</a>
                                        <a href="?page=checkout" title="Thanh toán" class="checkout fl-right">Thanh toán</a>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>