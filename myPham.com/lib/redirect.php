<?php

function redirect($url = '?page=trangChu')
{
    if (!empty($url)) {
        header("Location: {$url}");
        exit();
    }
}
