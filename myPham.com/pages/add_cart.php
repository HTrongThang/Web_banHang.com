<?php
$id = $_GET['id'];
$sl = isset($_GET['qty']) ? $_GET['qty'] : 1;


if (add_cart($id, $connect, $sl)) {
    $response = array("success" => true);
    redirect('?page=cart');
} else {
    $response = array("success" => false);
}

echo json_encode($response);
