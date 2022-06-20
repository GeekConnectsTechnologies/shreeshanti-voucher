<?php
    require_once "../dbc.php";
    if (isset($_GET['id']) && $_GET['id']!="") {
        $id = $_GET['id'];
        $sqlquery = "UPDATE voucher_details SET vstatus = USED WHERE uniqueId = $id";
        $result = mysqli_query($con, $sqlquery);
        $voucherarray=array();
        while ($data = mysqli_fetch_assoc($result)) {
            $voucherarray[] = $data;
        }
        echo json_encode($voucherarray,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
        mysqli_close($con);
    }
    else 
    {
        $response["status"] = "false";

    }
?>