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
                    <h4>Employee Details</h4>
                    <div class="card-header-action">
                      <a href="addexcel.php" class="btn btn-success">
                        Add Employee's Excel
                      </a>
                    </div>
                  </div>
                  </div>
              </div>
        </div>
        <div class="section-body">
          <div class="row">
        <?php
        
                      $sqlquery = "SELECT * FROM company";
                      $result = mysqli_query($con,$sqlquery);
                      while ($rowgetdata=mysqli_fetch_array($result))
                      {
                        
            echo "<div class='col-lg-3 col-md-6 col-sm-6 col-12'>";
            echo "<a href='viewemployee-data.php?companyId=".$rowgetdata['companyId']."'>";
            echo  "<div class='card card-statistic-1 pb-3'>";
            echo    "<div class='card-wrap'>";
            echo      "<div class='card-header'>";
            echo        "<h3 style='font-size : 24px;'>".$rowgetdata['companyName']."</h3>";
            echo      "</div>";
            echo      "<div class='card-body'>";
            $sqlcount = "SELECT COUNT(empId) AS Countemp FROM employee WHERE companyId=".$rowgetdata['companyId'];
            $results = mysqli_query($con,$sqlcount);
                      while ($rowcount=mysqli_fetch_array($results))
                      {
            echo        $rowcount['Countemp']." Employees";
                      }
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