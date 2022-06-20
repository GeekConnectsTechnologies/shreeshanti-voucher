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

if(isset($_POST['btnSave'])){
    
    $cname = $_POST['cname'];
    $userId = $_SESSION['userId'];
    $date = date('d/m/Y h:i:s a', time());
    
    //check upload file not error than insert data to database
    if(!isset($errorMsg)){
        $sql = "insert into company(companyName,userId,date)
                values('".$cname."','".$userId."','".$date."')";
        $result = mysqli_query($con, $sql);
        if($result){
            $successMsg = 'New record added successfully <br><br> Upload Employee data';
            header('refresh:5;addexcel.php');
        }else{
            $errorMsg = 'Error '.mysqli_error($con);
        }
    }

}

?>
<?php include 'layout-header.php'; ?>
<div class="main-content">
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
                      <h4>Add Company</h4>
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                        <label>Company Name</label>
                        <input type="text" name='cname' class="form-control" required="">
                      </div>
                    </div>
                    <div class="card-footer text-right">
                    <input type="submit" class="btn btn-primary" name="btnSave" value="Submit">
                    </div>
                  </form>
                </div>
        <div class="section-body">
        </div>
    </section>
</div>
<?php include 'layout-footer.php'; ?>