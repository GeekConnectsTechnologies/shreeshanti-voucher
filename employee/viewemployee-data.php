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
        $empId = $_GET['delete'];
       
          $sql = "delete from employee where empId=".$empId;
          if(mysqli_query($con, $sql)){
            header('location:viewemployee.php');
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
                    <h4>Employee Details</h4>
                    <!-- <div class="card-header-action">
                      <a href="addexcel.php" class="btn btn-success">
                        Add Employee's Excel
                      </a>
                    </div> -->
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
                            <th>Company Name</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $companyId = mysqli_real_escape_string($con, $_GET['companyId']);
                            $sqlquery = "SELECT employee.empId, employee.empName , employee.phoneNo , employee.email, employee.designation, company.companyName FROm company INNER JOIN employee ON employee.companyId=company.companyId WHERE company.companyId = $companyId;";
                            $result = mysqli_query($con,$sqlquery);
                            $counter = 1;
                            while ($rowgetdata=mysqli_fetch_array($result))
                            {
                              echo "<tr>";
                                echo "<td>".$counter."</td>";
                                echo "<td>".$rowgetdata['empName']."</td>";
                                echo "<td>".$rowgetdata['email']."</td>";
                                echo "<td>".$rowgetdata['phoneNo']."</td>";
                                echo "<td>".$rowgetdata['designation']."</td>";
                                echo "<td>".$rowgetdata['companyName']."</td>";
                                echo "<td><a href='editemployee.php?empId=".$rowgetdata['empId']."' class='btn btn-primary'>Edit</a>&nbsp&nbsp&nbsp<a href='viewemployee.php?delete=".$rowgetdata['empId']."' class='btn btn-danger' onclick='return confirm('Are you sure to delete this record?')'>Delete</a></td>";
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