<link rel="stylesheet" href="public/css/import/jquery-ui.css">


<div id="main-content-wp" class="list-cat-page">
    <div class="wrap clearfix">
        <?php require 'inc/sidebar.php'; ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix" style="    display: flex;
        align-items: center;">

                    <h3 id="index" class="fl-left">Danh sách danh mục</h3>

                    <button id="openFormButton" id="add-new" class="show-dialog btn btn-secondary" style="display: inline-block;
        color: #fff;
        background: #4fa327;
        padding: 4px 15px;
        margin: 20px; border: none;" type="submit">Thêm mới</button>

                </div>
            </div>
            <div id="myModal" class="modal">
                <div class="modal-content">
                    <div class="section" id="title-page">
                        <span class="close">x</span>
                        <div class="clearfix" style="display: flex; justify-content: center;">
                            <h3 id="index" class="fl-left">Thêm mới danh mục</h3>
                        </div>
                    </div>

                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="table-responsive">
                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Tiêu đề</span></td>
                                    <td><span class="thead-text">Mô tả</span></td>
                                    <td><span class="thead-text">Trạng thái</span></td>
                                    <td><span class="thead-text">Người tạo</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM `category_posts`  ORDER BY `thoiGianTao` DESC";

                                $result = $connect->query($sql);
                                if ($result->num_rows > 0) {
                                    $stt = 1;
                                    foreach ($result as $item) {
                                ?>
                                        <tr>
                                            <td><input type="checkbox" name="checkItem" class="checkItem"></td>
                                            <td><span class="tbody-text"><?php echo $stt; ?></h3></span>
                                            <td class="clearfix">
                                                <div class="tb-title fl-left">
                                                    <a href="" title=""><?php echo $item['tieuDe'] ?></a>
                                                </div>
                                                <ul class="list-operation fl-right">
                                                    <li> <a onclick="delete_cat(<?php echo $item['id_danhMuc'] ?>);" title="" class="del-product delete">
                                                            <i class="fa fa-trash-o"></i>
                                                        </a></li>
                                                    <li><a href="?page=update_cat&id=<?php echo $item['id_danhMuc'] ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                </ul>
                                            </td>
                                            <td><span class="tbody-text"><?php echo $item['noiDung'] ?></span></td>
                                            <td><span class="tbody-text"><?php if ($item['trangThai'] == 1) {
                                                                                echo " Hoạt động";
                                                                            } else {
                                                                                echo "Xét duyệt";
                                                                            } ?></span></td>
                                            <td><span class="tbody-text"><?php echo $item['nguoiTao'] ?></span></td>
                                            <td><span class="tbody-text"><?php echo $item['thoiGianTao'] ?></span></td>
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
                                    <td><span class="tfoot-text">STT</span></td>
                                    <td><span class="tfoot-text-text">Tiêu đề</span></td>
                                    <td><span class="tfoot-text">Mô tả</span></td>
                                    <td><span class="tfoot-text">Trạng thái</span></td>
                                    <td><span class="tfoot-text">Người tạo</span></td>
                                    <td><span class="tfoot-text">Thời gian</span></td>
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
                                < </a>
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

<div id="dialog" title="Dialog Title" style="display:none;">
    <form id="dataForm" method="post" action="?page=add_cat">
        <div class="mb-3">
            <label for="title" class="form-label text_title">Tên danh mục</label>
            <input type="text" class="form-control" id="title" name="title" aria-describedby="tên danh mục" required minlength="3" maxlength="100" style="width: 100%;">
        </div>
        <div class="mb-3">
            <label for="slug" class="form-label">Slug (Friendly_url)</label>
            <input type="text" class="form-control" id="slug" name="slug" aria-describedby="tên slug" required pattern="^[a-z0-9]+(?:-[a-z0-9]+)*$" style="width: 100%;">
        </div>
        <div class="mb-3">
            <label for="moTa" class="form-label">Mô tả</label>
            <input type="text" class="form-control" id="moTa" name="moTa" aria-describedby="mô tả" required minlength="10" maxlength="255" style="width: 100%;">
        </div>
        <div class="d-flex">
            <div class="form-check" style="margin-right: 20px;">
                <input class="form-check-input" type="radio" name="btnTrangthai" id="flexRadioDefault1" value="1" required>
                <label class="form-check-label" for="flexRadioDefault1">
                    Công khai
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="btnTrangthai" id="flexRadioDefault2" value="2" required>
                <label class="form-check-label" for="flexRadioDefault2">
                    Chờ duyệt
                </label>
            </div>
        </div>
        <button type="submit" name="btn-submit" id="btn-submit" class="btn btn-success " style="padding: 5px 10px; ">Cập nhật</button>
        <button type="button" id="btn-cancel" id="btn-submit" class="btn btn-danger" style="padding: 5px 10px; margin-left: 10px;">Hủy</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.3/jquery-ui.min.js"></script>

<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
<script>
    function delete_cat(id) {
        var xacNhanXT = confirm("Bạn có muốn xóa dữ liệu này không?");
        if (xacNhanXT) {
            $.ajax({
                url: '?page=delete_cat',
                type: 'POST',
                data: {
                    id: id
                },
                success: function(response) {
                    alert(response);
                    location.reload();
                },
                error: function() {
                    alert('Đã xảy ra lỗi khi xóa danh mục');
                }
            });
        }
    }
</script>

<script>
    $(document).ready(function() {
        $("#dialog").dialog({
            autoOpen: false, // Ban đầu dialog sẽ ẩn
            modal: true,
            title: "Thêm mới danh mục",
            width: 600
        });

        $(".show-dialog").click(function() {
            $("#dialog").dialog("open");
        });
        $("#btn-cancel").click(function() {
            $("#dialog").dialog("close");
        });
        document.getElementById('dataForm').addEventListener('submit', function(event) {
            let form = event.target;
            let title = form.title.value.trim();
            let slug = form.slug.value.trim();
            let moTa = form.moTa.value.trim();
            let radios = form.btnTrangthai;

            let radioChecked = Array.from(radios).some(radio => radio.checked);

            if (title.length < 3 || title.length > 100) {
                alert('Tên danh mục phải có độ dài từ 3 đến 100 ký tự.');
                event.preventDefault();
                return;
            }
            if (!/^[a-z0-9]+(?:-[a-z0-9]+)*$/.test(slug)) {
                alert('Slug không hợp lệ. Chỉ cho phép các ký tự chữ thường, số và dấu gạch ngang.');
                event.preventDefault();
                return;
            }
            if (moTa.length < 10 || moTa.length > 255) {
                alert('Mô tả phải có độ dài từ 10 đến 255 ký tự.');
                event.preventDefault();
                return;
            }
            if (!radioChecked) {
                alert('Vui lòng chọn trạng thái.');
                event.preventDefault();
                return;
            }
        });
    });
</script>