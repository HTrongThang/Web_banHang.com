<?php
function add_cart($id, $connect, $sl)
{

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array('buy' => array());
    }

    $sql_pro_by_id = "SELECT * FROM `product` WHERE `productID`='$id'";
    $result_pro_by_id = $connect->query($sql_pro_by_id);
    $row_pro = $result_pro_by_id->fetch_assoc();
    $url_pro = "?page=detail_product&id=$id";
    $qty = $sl;


    if (isset($_SESSION['cart']['buy']) && array_key_exists($id, $_SESSION['cart']['buy'])) {
        $qty = $_SESSION['cart']['buy'][$id]['qty'] + $sl;
    }
    $_SESSION['cart']['buy'][$id] = array(
        'id' => $row_pro['productID'],
        'url' => $url_pro,
        'product_title' => $row_pro['productName'],
        'price' => $row_pro['price'],
        'product_thumd' => $row_pro['img_avatar'],
        'code' => $row_pro['productCode'],
        'qtyPro' => $row_pro['quantity'],
        'qty' => $qty,
        'sub_tatol' => (int)$row_pro['price'] * $qty
    );
    update_cart();
    return true;
}
function update_cart()
{
    if (isset($_SESSION['cart'])) {
        $num_order = 0;
        $total = 0;
        foreach ($_SESSION['cart']['buy'] as $item) {
            $num_order += $item['qty'];
            $total += $item['sub_tatol'];
        }
        $_SESSION['cart']['info'] = array(
            'num_order' => $num_order,
            'tatol' => $total,
        );
    }
}
function get_list_by_cart()
{
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart']['buy'] as &$item) {
            $item['url_delete_cart'] = "?page=delete_cart&id={$item['id']}";
        }
        return $_SESSION['cart']['buy'];
    }
}
function get_num_order_cart()
{
    if (isset($_SESSION['cart']['info']['num_order'])) {
        return $_SESSION['cart']['info']['num_order'];
    } else {
        return 0;
    }
    update_cart();
}


function get_tatol_product()
{
    if (isset($_SESSION['cart']['info']['tatol'])) {
        return $_SESSION['cart']['info']['tatol'];
    } else {
        return 0;
    }
}
function get_total_product()
{
    if (isset($_SESSION['cart']['info']['total'])) {
        return $_SESSION['cart']['info']['total'];
    } else {
        return 0;
    }
    update_cart();
}

function delete_cart($id)
{
    if (isset($_SESSION['cart'])) {
        if (!empty($id)) {
            unset($_SESSION['cart']['buy'][$id]);
        }
        update_cart();
    }
}
function delete_all_cart()
{
    if (isset($_SESSION['cart'])) {
        unset($_SESSION['cart']);
    }
    update_cart();
}
function update_cart_qty($qty)
{
    foreach ($qty as $id => $new_qty) {
        $_SESSION['cart']['buy'][$id]['qty'] = $new_qty;
        $_SESSION['cart']['buy'][$id]['sub_tatol'] = $new_qty * $_SESSION['cart']['buy'][$id]['price'];
        update_cart();
    }
}

function showarray($value)
{
    if (is_array($value)) {
        echo "<pre>";
        print_r($value);
        echo "</pre>";
    }
}
