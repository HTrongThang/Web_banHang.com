<?php
function get_padding($num_pages, $page, $base_url="")
{
    $str_padding = "<ul class='pagination list-item clearfix'>";
    if($page > 1)
    {
        $str_padding .= "<li><a href='?page={$base_url}&trang=".($page-1)."'><i class='fa-solid fa-backward'></i></a></li>";
    }
    for ($i = 1; $i <= $num_pages; $i++) {
        $active_class = ($i == $page) ? "active" : "";
        $str_padding .= "<li class='$active_class'><a href=' ?page={$base_url}&trang={$i}'>$i</a></li>";
    }
    if($page < $num_pages)
    {
        $str_padding .= "<li><a href='?page={$base_url}&trang=".($page+1)."'><i class='fa-solid fa-forward'></i></a></li>";
    }
    $str_padding .= "</ul>";
    return $str_padding;
}
?>
