<?php
if (isset($_POST['btn_update_cate'])) {
    update_cart_qty($_POST['qty']);
    redirect('?page=cart');
}
    