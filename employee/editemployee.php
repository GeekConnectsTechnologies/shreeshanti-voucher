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

if(isset($_POST['update']))
{
    $empId = mysqli_real_escape_string($con, $_POST['empId']);
    $ename = mysqli_real_escape_string($con,$_POST['ename']);
    $email = mysqli_real_escape_string($con,$_POST['email']);
    $phoneNo = mysqli_real_escape_string($con,$_POST['phoneNo']);
    $designation = mysqli_real_escape_string($con,$_POST['designation']);
    
    if(empty($ename)) 
    {	
        echo "<font color='red'>Employee Name field is empty.</font><br/>";
    }
    elseif(empty($email)) 
    {	
        echo "<font color='red'>Please Enter the Email Address.</font><br/>";
    }
    elseif(empty($phoneNo)) 
    {	
        echo "<font color='red'>Please Enter the Phone Number.</font><br/>";
    }
    elseif(empty($designation)) 
    {	
        echo "<font color='red'>Please Enter the Designation.</font><br/>";
    }
    else 
    {	
        $result = mysqli_query($con, "UPDATE employee SET empName='$ename', email='$email', phoneNo='$phoneNo', designation='$designation' WHERE empId=$empId;");
        header("Location: viewemployee.php");
    }
}
?>
<?php include 'layout-header.php'; ?>
<div class="main-content">
        <?php
            $empId = $_GET['empId'];
            $result = mysqli_query($con, "SELECT * FROM employee WHERE empId=$empId;");
            while($res = mysqli_fetch_array($result))
            {
                $empName = $res['empName'];
                $email = $res['email'];
                $phoneNo = $res['phoneNo'];
                $designation = $res['designation'];
            }
        ?>
    <section class="section">
            <?php
                if(isset($errorMsg)){		
            ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $errorMsg; ?>
                </div>
            <?php
                }
            ?>
            <?php
            if(isset($successMsg)){		
            ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $successMsg; ?> - Redirecting In A Moment 
                </div>
            <?php
                }
            ?>
                <div class="card">
                  <form action="" method="post">
                    <div class="card-header">
                      <h4>Edit Employee</h4>
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                        <label>Employee Name</label>
                        <input type="text" name='ename' class="form-control" value="<?php echo $empName; ?>" required="">
                      </div>
                      <div class="form-group">
                        <label>Email</label>
                        <input type="text" name='email' class="form-control" value="<?php echo $email; ?>" required="">
                      </div>
                      <div class="form-group">
                        <label>Phone No.</label>
                        <input type="text" name='phoneNo' class="form-control" value="<?php echo $phoneNo; ?>" required="">
                      </div>
                      <div class="form-group">
                        <label>Designation</label>
                        <input type="text" name='designation' class="form-control" value="<?php echo $designation; ?>" required="">
                      </div>
                    </div>
                    <div class="card-footer text-right">
                    <input type="hidden" name="empId" value="<?php echo $_GET['empId'];?>">
                    <input type="submit" class="btn btn-primary" name="update" value="Submit">
                    </div>
                  </form>
                </div>
        <div class="section-body">
        </div>
    </section>
</div>
<?php include 'layout-footer.php'; ?>