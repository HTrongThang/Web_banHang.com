<!DOCTYPE html>
<html>

<head>
    <title>Quản lý Mỹ Phẩm</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="public/css/import/main.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="public/css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css" />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="public/css/bootstrap/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
    <link href="public/reset.css" rel="stylesheet" type="text/css" />
    <link href="public/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="public/style.css" rel="stylesheet" type="text/css" />
    <link href="public/responsive.css" rel="stylesheet" type="text/css" />
    <script src="public/js/jquery-2.2.4.min.js" type="text/javascript"></script>
    <script src="public/js/bootstrap/bootstrap.min.js" type="text/javascript"></script>
    <script src="public/js/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
    <script src="public/js/main.js" type="text/javascript"></script>
</head>

<style>
    .avatar {
        margin: 10px 0;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        object-fit: cover;
        overflow: hidden;
    }
</style>

<body>
    <div id="site">
        <div id="container">
            <div id="header-wp">
                <div class="wp-inner clearfix">
                    <a href="?page=Dashboards" title="" id="logo" class="fl-left">ADMIN</a>
                    <ul id="main-menu" class="fl-left">
                        <li>
                            <a href="?page=list_post" title="">Trang</a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="?page=add_page" title="">Thêm mới</a>
                                </li>
                                <li>
                                    <a href="?page=list_page" title="">Danh sách trang</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="?page=list_post" title="">Bài viết</a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="?page=add_post" title="">Thêm mới</a>
                                </li>
                                <li>
                                    <a href="?page=list_post" title="">Danh sách bài viết</a>
                                </li>
                                <li>

                                    <a href="?page=list_cat" title="">Danh mục bài viết</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="?page=list_product" title="">Sản phẩm</a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="?page=add_product" title="">Thêm mới</a>
                                </li>
                                <li>
                                    <a href="?page=list_product" title="">Danh sách sản phẩm</a>
                                </li>
                                <li>
                                    <a href="?page=list_cat" title="">Danh mục sản phẩm</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="" title="">Bán hàng</a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="?page=list_order" title="">Danh sách đơn hàng</a>
                                </li>
                                <li>
                                    <a href="?page=list_order" title="">Danh sách khách hàng</a>
                                </li>
                            </ul>
                        </li>
                        <li>

                            <a href="?page=menu" title="">Menu</a>
                        </li>
                    </ul>
                    <style>
                        #account:hover {
                            color: red;
                        }
                    </style>
                    <div id="dropdown-user" class="dropdown dropdown-extended fl-right">
                        <button class="dropdown-toggle clearfix" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="display: flex; align-items: center;">
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
                                    if ($resut_sql_query_info->num_rows > 0) {
                                        $item = $resut_sql_query_info->fetch_assoc();
                                        if (isset($item['user_avater'])) {
                            ?>
                                            <img src="<?php echo $item['user_avater']; ?>" srcset="" class="avatar">
                                            <h3 id="account" class="fl-right" style="font-size: 15px;"><?php echo $item['username']; ?> <i class="fa-solid fa-caret-down"></i></h3>
                                        <?php
                                        } else {
                                        ?>

                                            <img src="upload/images.png" alt="" srcset="">



                                            <h3 id="account" class="fl-right" style="font-size: 15px;"><?php echo $item['username']; ?><i class="fa-solid fa-caret-down"></i></h3>
                            <?php
                                        }
                                    }
                                }
                            }
                            ?>
                        </button>

                        <ul class="dropdown-menu">
                            <li><a href="?page=info_account" title="Thông tin cá nhân">Thông tin tài khoản</a></li>
                            <li><a href="?page=logoutAdmin" title="Thoát">Đăng xuất</a></li>
                        </ul>
                    </div>


                </div>
            </div>
        </div>
    </div>