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
        <div class="section-header">
            <h1>Content Goes Here</h1>
        </div>

        <div class="section-body">
        </div>
    </section>
</div>
<?php include 'layout-footer.php'; ?>