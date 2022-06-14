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
<?php
    if(isset($_GET['delete'])){
        $companyId = $_GET['delete'];
       
          $sql = "delete from company where companyId=".$companyId;
          if(mysqli_query($con, $sql)){
            header('location:viewcompany.php');
          }
      
    }
?>
<?php include 'layout-header.php'; ?>
<div class="main-content">
    <section class="section">
    <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Company Details</h4>
                    <div class="card-header-action">
                      <a href="addcompany.php" class="btn btn-success">
                        Add New
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
                            <th>Comapany Name</th>
                            <th>User Name</th>
                            <th>Date & Time</th>
                            <!-- <th>Action</th> -->
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $sqlquery = "SELECT company.companyName,company.companyId, user_detail.name, company.date FROm company INNER JOIN user_detail ON user_detail.userId=company.userId;";
                            $result = mysqli_query($con,$sqlquery);
                            $counter = 1;
                            while ($rowgetdata=mysqli_fetch_array($result))
                            {
                              echo "<tr>";
                                echo "<td>".$counter."</td>";
                                echo "<td>".$rowgetdata['companyName']."</td>";
                                echo "<td>".$rowgetdata['name']."</td>";
                                echo "<td>".$rowgetdata['date']."</td>";
                                // echo "<td><a href='editcompany.php?companyId=".$rowgetdata['companyId']."' class='btn btn-primary'>Edit</a>&nbsp&nbsp&nbsp<a href='viewcompany.php?delete=".$rowgetdata['companyId']."' class='btn btn-danger' onclick='return confirm('Are you sure to delete this record?')'>Delete</a></td>";
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