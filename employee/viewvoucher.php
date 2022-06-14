<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: ../login/index.php');
	exit;
}
require_once "../dbc.php";
?>
<?php include 'layout-header.php'; ?>
<div class="main-content">
    <section class="section">
    <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Voucher Details</h4>
                    <div class="card-header-action">
                      <a href="addvoucher.php" class="btn btn-success">
                        Generate Voucher
                      </a>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-company">
                        <thead>
                          <tr>
                            <th class="text-center">
                              #
                            </th>
                            <th>Voucher Name</th>
                            <th>Price</th>
                            <th>Expiry Date</th>
                            <th>Message</th>
                            <th>Company Name</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $sqlquery = "SELECT voucher.vId, voucher.vName , voucher.vPrice , voucher.expirydate, voucher.message, company.companyName FROm company INNER JOIN voucher ON voucher.companyId=company.companyId;";
                            $result = mysqli_query($con,$sqlquery);
                            $counter = 1;
                            while ($rowgetdata=mysqli_fetch_array($result))
                            {
                              echo "<tr>";
                                echo "<td>".$counter."</td>";
                                echo "<td>".$rowgetdata['vName']."</td>";
                                echo "<td>".$rowgetdata['vPrice']."</td>";
                                echo "<td>".$rowgetdata['expirydate']."</td>";
                                echo "<td>".$rowgetdata['message']."</td>";
                                echo "<td>".$rowgetdata['companyName']."</td>";
                                echo "<td><a href='viewevoucher.php?vId=".$rowgetdata['vId']."&vName=".$rowgetdata['vName']."' class='btn btn-primary'>View</a></td>";
                                $counter++;
                              echo "</tr>";
                            }
                          ?>
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
<?php include 'layout-footer.php'; ?>