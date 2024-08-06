<script>
    function delete_cat(id) {
        debugger;
        var xacNhanXT = confirm("Bạn có muốn xóa dữ liệu này không ?");
        if (xacNhanXT) {
            window.location.href = "?page=delete_danhmucSP&id=" + id;
        }
    }

    function validateAdd() {
        var title = document.getElementById('title').value;
        var slug = document.getElementById('slug').value;

        var titleError = document.getElementById('titleError');
        if (title.length === 0) {
            titleError.textContent = "Vui lòng nhập tiêu đề";
            return false;
        } else {
            titleError.textContent = "";
        }

        var slugError = document.getElementById('slugError');
        if (slug.length === 0) {
            slugError.textContent = "Vui lòng nhập slug";
            return false;
        } else {
            slugError.textContent = "";
        }

        return true;
    }
</script>
<style>
    span.text_error {
        color: red;
        font-weight: bold;
        font-style: italic;
    }
</style>
<div id="main-content-wp" class="list-cat-page">
    <div class="wrap clearfix">
        <?php require 'inc/sidebar.php'; ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix" style="    display: flex;
        align-items: center;">

                    <h3 id="index" class="fl-left">Danh sách danh mục sản phẩm</h3>

                    <button id="openFormButton" id="add-new" style="display: inline-block;
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
                            <h3 id="index" class="fl-left">Thêm mới danh mục sản phẩm</h3>
                        </div>
                    </div>
                    <div class="section" id="detail-page">
                        <div class="section-detail">
                            <form id="dataForm" method="post" action="?page=add_danhMucSanPham" onsubmit="return validateAdd()">
                                <div class="mb-3">
                                    <label for="title" class="form-label text_title">Tên danh mục</label>
                                    <input type="text" class="form-control" id="title" name="title" aria-describedby="tên danh mục">
                                    <span class="text_error" id="titleError"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="title" class="form-label">Slug (Friendly_url)</label>
                                    <input type="text" class="form-control" id="slug" name="slug" aria-describedby="tên slug">
                                    <span class="text_error" id="slugError"></span>
                                </div>

                                <div class="d-flex">
                                    <div class="form-check" style="margin-right: 20px;">
                                        <input class="form-check-input" type="radio" name="btnTrangthai" id="flexRadioDefault1" value="1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Công khai
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="btnTrangthai" id="flexRadioDefault2" value="2">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Chờ duyệt
                                        </label>
                                    </div>
                                </div>
                                <button type="submit" name="btn-submit" id="btn-submit" class="btn btn-primary">Cập nhật</button>
                            </form>
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
                                    <td><span class="thead-text">Trạng thái</span></td>
                                    <td><span class="thead-text">Người tạo</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM `productcategory`";
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
                                                    <a href="" title=""><?php echo $item['productCategoryName'] ?></a>
                                                </div>
                                                <ul class="list-operation fl-right">
                                                    <li><a href="" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                    <li><a href="#" onclick="delete_cat(<?php echo $item['productCategoryID'] ?>)" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                </ul>
                                            </td>
                                            <td><span class="tbody-text"><?php if ($item['trangThai'] == 1) {
                                                                                echo " Hoạt động";
                                                                            } else {
                                                                                echo "Xét duyệt";
                                                                            } ?></span></td>
                                            <td><span class="tbody-text"><?php echo $item['nguoiTao'] ?></span></td>
                                            <td><span class="tbody-text"><?php echo $item['createdDate'] ?></span></td>
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
                                << /a>
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
<style>
    /* CSS cho cửa sổ modal */
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
    }

    /* CSS cho nội dung của cửa sổ modal */
    .modal-content {
        background-color: #fefefe;
        margin: 8% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 50%;
        border-radius: 10px;
    }

    .close {
        order: 1px solid #333;
        padding: 5px;

        border-radius: 49%;
    }

    .close:hover {
        background: red;
    }
</style>
<script>
    // Lấy ra các phần tử từ DOM
    const openFormButton = document.getElementById('openFormButton');
    const modal = document.getElementById('myModal');
    const closeButton = document.querySelector('.close');
    const dataForm = document.getElementById('dataForm');

    // Gắn sự kiện click cho nút mở form
    openFormButton.addEventListener('click', function() {
        modal.style.display = 'block'; // Hiển thị cửa sổ modal khi nhấn nút mở form
    });

    // Gắn sự kiện click cho nút đóng
    closeButton.addEventListener('click', function() {
        modal.style.display = 'none'; // Ẩn cửa sổ modal khi nhấn nút đóng
    });
</script>