<style>
    tr td {
        vertical-align: middle !important;
        /* Căn giữa theo chiều dọc */
    }
</style>
<div id="main-content-wp" class="list-product-page list-slider">
    <div class="wrap clearfix">
        <?php require 'inc/sidebar.php'; ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách nhân viên</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                        </ul>
                        <form method="GET" class="form_search form-s fl-right " style="width: 44%;
    margin: 0 auto;
    padding: 20px; background-color: white; border: none;">
                            <input type="text" name="s" id="s">
                            <input type="submit" name="sm_s" value="Tìm kiếm">
                        </form>
                    </div>

                    <div class="table-responsive">
                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Hình ảnh</span></td>
                                    <td><span class="thead-text">Tên</span></td>
                                    <td><span class="thead-text"><Em></Em>Email</span></td>

                                    <td><span class="thead-text">SDT</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql_list_user = "SELECT * FROM `users` WHERE `userTypeID`='2'";
                                $result_list_user = $connect->query($sql_list_user);
                                if ($result_list_user->num_rows > 0) {
                                    $stt = 1;
                                    while ($item = $result_list_user->fetch_assoc()) {
                                ?>

                                        <tr>
                                            <td><input type="checkbox" name="checkItem" class="checkItem"></td>
                                            <td><span class="tbody-text "><?php echo $stt; ?></span></td>
                                            <td>
                                                <div class="tbody-thumb">
                                                    <img src="<?php echo $item['user_avater']; ?>" alt="">
                                                </div>
                                            </td>

                                            <td >
                                                <span class="tbody-text text-danger " style="font-weight: bold;">  <?php echo $item['lastName'] . ' ' . $item['firstName']; ?></span>

                                                <ul class="list-operation fl-right">
                                                    <li><a href="" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                </ul>
                                            </td>
                                            <td><span class="tbody-text"><?php echo $item['email']; ?></span></td>

                                            <td><span class="tbody-text"><?php echo $item['phoneNumber']; ?></span></td>
                                            <td><span class="tbody-text"><?php echo $item['isTime']; ?></span></td>
                                            <td><button type="button" class="btn btn-outline-info">Xem chi tiết</button></td>
                                        </tr>

                                <?php
                                        $stt++;
                                    }
                                }
                                ?>


                            </tbody>
                            <tfoot>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Hình ảnh</span></td>

                                    <td><span class="thead-text">Tên</span></td>
                                    <td><span class="thead-text">Email</span></td>

                                    <td><span class="thead-text">SDT</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <p id="desc" class="fl-left">Chọn vào checkbox để lựa chọn tất cả</p>
                    <ul id="list-paging" class="fl-right">
                        <li>
                            <a href="" title="">
                                <</a>
                        </li>
                        <li>
                            <a href="" title="">1</a>
                        </li>
                        <li>
                            <a href="" title="">2</a>
                        </li>
                        <li>
                            <a href="" title="">3</a>
                        </li>
                        <li>
                            <a href="" title="">></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>