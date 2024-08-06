<?php
$id = $_GET['id'];
delete_cart($id);
redirect('?page=cart');
