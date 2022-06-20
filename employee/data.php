<?php
    // require_once "../dbc.php";
    // $sqlquery = "SELECT employee.empId, employee.empName , employee.phoneNo , employee.email, voucher_details.vstatus, voucher_details.vId, voucher_details.amount, voucher_details.reminder, voucher.expirydate, voucher.vPrice FROm ((voucher_details INNER JOIN employee ON voucher_details.empId=employee.empId) INNER JOIN voucher ON voucher_details.vId = voucher.vId )WHERE voucher_details.uniqueId = 22;";
    // $result = mysqli_query($con, $sqlquery);
    // // $data = mysqli_fetch_array($result);
    // while ($data = mysqli_fetch_array($result)) {
    // echo "Employee Name : " . $data['empName'] . "</br></br>";
    // echo "Employee Phone No. : " . $data['phoneNo'] . "</br></br>";
    // echo "Employee Email : " . $data['email'] . "</br></br>";
    // echo "Voucher Status : " . $data['vstatus'] . "</br></br>";
    // echo "Voucher Expiry Date : " . $data['expirydate'] . "</br></br>";
    // echo "Purchase Amount : " . $data['amount'] . "</br></br>";
    // echo "Reminder Count : " . $data['reminder'] . "</br></br>";
    // }
    
?>
<?php
    require_once "../dbc.php";
    if (isset($_GET['id']) && $_GET['id']!="") {
        $id = $_GET['id'];
        $sqlquery = "SELECT employee.empId, employee.empName , employee.phoneNo , employee.email, voucher_details.vstatus, voucher_details.vId, voucher_details.amount, voucher_details.reminder, voucher.expirydate, voucher.vPrice FROm ((voucher_details INNER JOIN employee ON voucher_details.empId=employee.empId) INNER JOIN voucher ON voucher_details.vId = voucher.vId )WHERE voucher_details.uniqueId =$id";
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