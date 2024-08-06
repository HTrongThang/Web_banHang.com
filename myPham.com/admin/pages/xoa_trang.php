<?php
$id = $_GET['id'];
$sql = "DELETE FROM `category` WHERE `id`=$id";
$result = $connect->query($sql);
require 'list_page';
?>