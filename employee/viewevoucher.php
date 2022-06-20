<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if(!isset($_SESSION['IS_LOGIN']))
  {
    header('location:../index.php');
    die();
  }

  if(isset($_SESSION['ROLE']) && $_SESSION['ROLE']!='2')
  {
    header('location:../index.php');
    die();
  }
require_once "../dbc.php";

$vId = $_GET['vId'];
$vName = $_GET['vName'];

?>

<?php include 'layout-header.php'; ?>
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4><?php echo $vName ?></h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-company">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            #
                                        </th>
                                        <th>Employee Name</th>
                                        <th>Email</th>
                                        <th>Phone No.</th>
                                        <th>Designation</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sqlquery = "SELECT employee.empId, employee.empName , employee.phoneNo , employee.email, employee.designation, voucher_details.uniqueId, voucher_details.vstatus, voucher_details.vId FROm voucher_details INNER JOIN employee ON employee.empId=voucher_details.empId where vId = $vId;";
                                    $result = mysqli_query($con, $sqlquery);
                                    $counter = 1;
                                    while ($rowgetdata = mysqli_fetch_array($result)) {
                                        echo "<tr>";
                                        echo "<td>" . $counter . "</td>";
                                        echo "<td>" . $rowgetdata['empName'] . "</td>";
                                        echo "<td>" . $rowgetdata['email'] . "</td>";
                                        echo "<td>" . $rowgetdata['phoneNo'] . "</td>";
                                        echo "<td>" . $rowgetdata['designation'] . "</td>";
                                        echo "<td>" . $rowgetdata['vstatus'] . "</td>";
                                        echo "<td><button type='button' class='btn btn-primary' data-toggle='modal' data-target='#".$rowgetdata['uniqueId']."'>View</button></td>";
                                        $counter++;
                                        echo "</tr>";
                                    }
                                    ?>
                                    <div class="modal fade" id="<?php echo $rowgetdata['uniqueId'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Employee's Voucher Details</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?php
                                                        $sqlquery = "SELECT employee.empId, employee.empName , employee.phoneNo , employee.email, employee.designation, voucher_details.vstatus, voucher_details.vId, voucher_details.amount, voucher_details.reminder, voucher.expirydate, voucher.vPrice FROm ((voucher_details INNER JOIN employee ON voucher_details.empId=employee.empId) INNER JOIN voucher ON voucher_details.vId = voucher.vId )WHERE voucher_details.uniqueId = ".$rowgetdata['uniqueId']."";
                                                        $result = mysqli_query($con, $sqlquery);
                                                        $data = mysqli_fetch_array($result);
                                                        echo "Employee Name : " . $data['empName'] . "</br></br>";
                                                        echo "Employee Phone No. : " . $data['phoneNo'] . "</br></br>";
                                                        echo "Employee Email : " . $data['email'] . "</br></br>";
                                                        echo "Employee Designation : " . $data['designation'] . "</br></br>";
                                                        echo "Voucher Status : " . $data['vstatus'] . "</br></br>";
                                                        echo "Voucher Expiry Date : " . $data['expirydate'] . "</br></br>";
                                                        echo "Purchase Amount : " . $data['amount'] . "</br></br>";
                                                        echo "Reminder Count : " . $data['reminder'] . "</br></br>";
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-body">
        </div>
    </section>
</div>

<script type="text/javascript">
$(document).ready(function(){
    $('.modal').modal('show');
});
</script>

<?php include 'layout-footer.php'; ?>