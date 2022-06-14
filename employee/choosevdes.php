<?php

// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../login/index.php');
    exit;
}
require_once "../dbc.php";

$companyId = $_GET['companyId'];
$vname = $_GET['vname'];
$vprice = $_GET['vprice'];
$message = $_GET['vnote'];
$expirydate = $_GET['expirydate'];
$description = trim($_GET['description']);
$tc = trim($_GET['tc']);
$reedem = trim($_GET['reedem']);

if (isset($_POST['submit'])) {

    $reminder = 0;
    $status = 'UNUSED';
    $uiimage = '1.png';
    //check upload file not error than insert data to database
    if (!isset($errorMsg)) {
        $sql = "insert into voucher(companyId,vName,vPrice,expirydate,message,description,tc,reedem,uiimage)
                values('" . $companyId . "','" . $vname . "','" . $vprice . "','" . $expirydate . "','" . $message . "','" . $description . "','" . $tc . "','" . $reedem . "','" . $uiimage . "')";
        $result = mysqli_query($con, $sql);
        $lastvoucherid = mysqli_insert_id($con);
        $_SESSION['voucherId']=$lastvoucherid;
        foreach ($_POST['checkboxdesg'] as $selected) {
            $sql = "insert into voucher_details(vId,empId,reminder,vstatus) values('" . $lastvoucherid . "','" . $selected . "','" . $reminder . "','" . $status . "')";
            $resultdata = mysqli_query($con, $sql);
        }
        if ($resultdata) {
            header('refresh:1;voucherdesign.php');
        } else {
            $errorMsg = 'Error ' . mysqli_error($con);
        }
    }
}

?>
<?php include 'layout-header.php'; ?>
<div class="main-content">
    <section class="section">
        <div class="card">
            <form action="" method="post">
                <div class="card-header">
                    <h4>Choose Designation</h4>
                </div>
                <div class="card-body">
                
                    <div class="form-group">
                        <label>Choose Designation</label>
                        <select id="designation" name="designation" class="custom-select" onchange="changedesig()">
                            <?php
                            $result = mysqli_query($con, "SELECT DISTINCT designation FROM employee where companyId=$companyId;");
                            while ($res = mysqli_fetch_array($result)) {
                                echo "<option value='" . $res['designation'] . "'>" . $res['designation'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-company">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="custom-checkbox custom-control">
                                                <input type="checkbox" data-checkboxes="mygroup" checked data-checkbox-role="dad" class="custom-control-input" id="checkbox-all">
                                                <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </th>
                                        <th>Employee Name</th>
                                        <th>Email</th>
                                        <th>Phone No.</th>
                                        <th>Designation</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sqlquery = "SELECT * FROM employee where companyId=$companyId ORDER BY designation;";
                                    $result = mysqli_query($con, $sqlquery);
                                    while ($rowgetdata = mysqli_fetch_array($result)) {
                                        echo "<tr>"; ?>
                                        <td class="p-0r text-center">
                                            <div class="custom-checkbox custom-control">
                                                <input type="checkbox" name="checkboxdesg[]" checked data-checkboxes="mygroup" class="custom-control-input <?php echo $rowgetdata['designation']; ?>" id="<?php echo $rowgetdata['empId']; ?>" value="<?php echo $rowgetdata['empId']; ?>">
                                                <label for="<?php echo $rowgetdata['empId']; ?>" class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </td>
                                    <?php
                                        echo "<td>" . $rowgetdata['empName'] . "</td>";
                                        echo "<td>" . $rowgetdata['email'] . "</td>";
                                        echo "<td>" . $rowgetdata['phoneNo'] . "</td>";
                                        echo "<td>" . $rowgetdata['designation'] . "</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <input type="submit" class="btn btn-primary" name="submit" value="Next">
                    </div>
            </form>
        </div>
</div>
<div class="section-body">
</div>
</section>
</div>
<?php include 'layout-footer.php'; ?>
<script>
    function changedesig() {
        var designation = document.getElementById("designation").value;
        console.log(designation);

        var items = document.getElementsByName('checkboxdesg');
        console.log("items", items);
        for (var i = 0; i < items.length; i++) {
            if (items[i].type == 'checkbox')
                items[i].checked = false;
        }

        var getdesig = document.getElementsByClassName(designation);
        console.log("getdesignation", getdesig)
        for (var i = 0; i < getdesig.length; i++) {
            getdesig[i].checked = true;
        }
    }
</script>