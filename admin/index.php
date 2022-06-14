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
        <div class="section-header">
            <h1>Content Goes Here</h1>
        </div>

        <div class="section-body">
        </div>
    </section>
</div>
<?php include 'layout-footer.php'; ?>