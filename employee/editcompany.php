<?php

// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: ../login/index.php');
	exit;
}
require_once "../dbc.php";

if(isset($_POST['update']))
{
    $companyId = mysqli_real_escape_string($con, $_POST['companyId']);
    $cname = mysqli_real_escape_string($con,$_POST['cname']);
    
    
    if(empty($cname)) 
    {	
        echo "<font color='red'>Company Name field is empty.</font><br/>";
    }
    else 
    {	
        $result = mysqli_query($con, "UPDATE company SET companyName='$cname' WHERE companyId=$companyId;");
        header("Location: viewcompany.php");
    }
}
?>
<?php include 'layout-header.php'; ?>
<div class="main-content">
        <?php
            $companyId = $_GET['companyId'];
            $result = mysqli_query($con, "SELECT * FROM company WHERE companyId=$companyId;");
            while($res = mysqli_fetch_array($result))
            {
                $cname = $res['companyName'];
                
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
                      <h4>Edit Company</h4>
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                        <label>Company Name</label>
                        <input type="text" name='cname' class="form-control" value="<?php echo $cname; ?>" required="">
                      </div>
                    </div>
                    <div class="card-footer text-right">
                    <input type="hidden" name="companyId" value="<?php echo $_GET['companyId'];?>">
                    <input type="submit" class="btn btn-primary" name="update" value="Submit">
                    </div>
                  </form>
                </div>
        <div class="section-body">
        </div>
    </section>
</div>
<?php include 'layout-footer.php'; ?>