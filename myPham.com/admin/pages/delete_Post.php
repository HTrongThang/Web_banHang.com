<?php
$id = $_GET['id'];
$sql = "DELETE FROM `tb_post` WHERE `id`=$id";
$result = $connect->query($sql);
require 'list_post.php';

