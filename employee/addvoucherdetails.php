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

// if (isset($_POST['submit'])) {

//     $vname = $_POST['vname'];
//     $vprice = $_POST['vprice'];
//     $vnote = $_POST['vnote'];
//     $expirydate = $_POST['expirydate'];
//     $reminder = 0;
//     $status = 'UNUSED';
//     //check upload file not error than insert data to database
//     if (!isset($errorMsg)) {
//         $sql = "insert into voucher(companyId,vName,vPrice,expirydate,notes)
//                 values('" . $companyId . "','" . $vname . "','" . $vprice . "','" . $expirydate . "','" . $vnote . "')";
//         $result = mysqli_query($con, $sql);
//         $lastvoucherid = mysqli_insert_id($con);
//         foreach ($_POST['checkboxdesg'] as $selected) {
//             $sql = "insert into voucher_detail(vId,empId,reminder,vstatus) values('" . $lastvoucherid . "','" . $selected . "','" . $reminder . "','" . $status . "')";
//             $resultdata = mysqli_query($con, $sql);
//         }
//         if ($resultdata) {
//             $successMsg = 'New record added successfully';
//             header('refresh:5;viewvoucher.php');
//         } else {
//             $errorMsg = 'Error ' . mysqli_error($con);
//         }
//     }
// }

?>
<?php include 'layout-header.php'; ?>
<div class="main-content">
    <section class="section">
        <?php
        if (isset($errorMsg)) {
        ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $errorMsg; ?>
            </div>
        <?php
        }
        ?>
        <?php
        if (isset($successMsg)) {
        ?>
            <div class="alert alert-success" role="alert">
                <?php echo $successMsg; ?> - Redirecting In A Moment
            </div>
        <?php
        }
        ?>
        <div class="card">
            <form action="choosevdes.php" method="post">
                <div class="card-header">
                    <h4>Add Voucher Details</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Voucher Name</label>
                        <input type="text" name='vname' class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">₹</span>
                            </div>
                            <input type="text" name="vprice" class="form-control" aria-label="Amount (to the nearest dollar)">
                            <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Expiry Date</label>
                        <input type="date" name="expirydate" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Message for Receiver</label>
                        <input type="text" name='vnote' class="form-control" required="">
                    </div>
                    <div class="form-group">
                      <label>Description</label>
                      <textarea rows="7" name="description" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                      <label>T & C</label>
                      <textarea name="tc" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                      <label>How to Reedem</label>
                      <textarea name="reedem" class="form-control"></textarea>
                    </div>
                    <!-- <div class="form-group">
                      <label class="d-block">Select Delivery Mode</label>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="delivery[]" value="email" id="defaultCheck1">
                        <label class="form-check-label" for="defaultCheck1">
                          Email
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="delivery[]" value="sms" id="defaultCheck2">
                        <label class="form-check-label" for="defaultCheck2">
                          SMS
                        </label>
                      </div>
                    </div> -->
                    <div class="card-footer text-right">
                        <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                    </div>
            </form>
        </div>
</div>
<div class="section-body">
</div>
</section>
</div>
<?php include 'layout-footer.php'; ?>
<!-- <script>
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
</script> -->