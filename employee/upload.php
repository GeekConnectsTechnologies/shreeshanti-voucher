<?php
session_start();

require_once "../dbc.php";

$voucherId = $_SESSION['voucherId'];
//upload.php
if($_FILES["file"]["name"] != '')
{
    $test = explode('.', $_FILES["file"]["name"]);
    $ext = end($test);
    $name = rand(100, 999) . '.' . $ext;
    $location = './imageupload/' . $name;  
    move_uploaded_file($_FILES["file"]["tmp_name"], $location);
    echo '<img src="'.$location.'" height="300" width="600" class="img-thumbnail" id="voucherDesign" />';
    $sqlgetdata = "UPDATE voucher SET uiimage='$name' WHERE vId=$voucherId";
    $result = mysqli_query($con, $sqlgetdata);
}
