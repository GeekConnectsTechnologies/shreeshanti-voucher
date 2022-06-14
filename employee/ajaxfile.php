<?php

include "../dbc.php";

$vId=$_POST['option'];

$return_arr = array();

$query = "SELECT DISTINCT(designation) FROM employee WHERE companyId = (SELECT companyId FROM voucher WHERE vId = $vId)";

$result = mysqli_query($con,$query);
// echo 'result '.$result;
while($row = mysqli_fetch_array($result)){
    $designation = $row['designation'];

    $return_arr[] = $designation;
}

// Encoding array in JSON format
echo json_encode($return_arr);