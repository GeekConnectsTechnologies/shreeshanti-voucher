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
                </div>
              </div>
            </div>
            <div class="section-body">
          <div class="row">
        <?php
        
                      $sqlquery = "SELECT voucher.vId, voucher.vName , voucher.vPrice , voucher.expirydate, voucher.message, company.companyName FROm company INNER JOIN voucher ON voucher.companyId=company.companyId;";
                      $result = mysqli_query($con,$sqlquery);
                      while ($rowgetdata=mysqli_fetch_array($result))
                      {
                        
            echo "<div class='col-lg-3 col-md-6 col-sm-6 col-12'>";
            echo "<a href='viewevoucher.php?vId=".$rowgetdata['vId']."&vName=".$rowgetdata['vName']."'>";
            echo  "<div class='card card-statistic-1 pb-3'>";
            echo    "<div class='card-wrap'>";
            echo      "<div class='card-header'>";
            echo        "<h3 style='font-size : 22px;'>".$rowgetdata['vName']."</h3>";
            echo      "</div>";
            echo "<br>";
            echo      "<div class='card-body'>";
            echo "Rs. ".$rowgetdata['vPrice'];
            echo        "<p style='font-size: 15px;'>".$rowgetdata['expirydate']."</p>";
            echo      "</div>";
            echo    "</div>";
            echo  "</div>";
            echo"</a>";
            echo"</div>";
            
                      }
            ?>
          </div>
        </div>
    </section>
</div>
<?php include 'layout-footer.php'; ?>