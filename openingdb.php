<?php
function opendb(){
    $link = mysqli_connect("localhost", "root", "") or die("Connection error" . mysqli_error());
    mysqli_select_db($link, "info2_hf");
    mysqli_query($link, "set charachter_set_results='utf-8'");
    return $link;
}
?>