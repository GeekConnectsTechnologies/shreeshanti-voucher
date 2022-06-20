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

if(!isset($_SESSION['voucherId']))
{
  unset($_SESSION['voucherId']);
}
require_once "../dbc.php";

?>
<?php include 'layout-header.php'; ?>
<div class="main-content">
  <section class="section">
    <?php
    if (isset($errorMsg)) {
    ?>
      <div class="alert alert-danger" role="alert">
        <?php echo $errorMsg; ?>
      </div>
    <?php
    }
    ?>
    <?php
    if (isset($successMsg)) {
    ?>
      <div class="alert alert-success" role="alert">
        <?php echo $successMsg; ?> - Redirecting In A Moment
      </div>
    <?php
    }
    ?>
    <div class="card">
      <form action="choosevdes.php" method="get">
        <div class="card-header">
          <h4>Add Voucher</h4>
        </div>
        <div class="card-body">
          <div class="form-group">
            <label>Choose Company</label>
            <select id="companyId" name="companyId" class="custom-select">
              <?php
              $records = mysqli_query($con, "SELECT * From company");

              while ($data = mysqli_fetch_array($records)) {
                echo "<option value='" . $data['companyId'] . "'>" . $data['companyName'] . "</option>";
              }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label>Voucher Name</label>
            <input type="text" name='vname' class="form-control" required>
          </div>
          <div class="form-group">
            <label>Price</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">₹</span>
              </div>
              <input type="text" name="vprice" class="form-control" aria-label="Amount (to the nearest dollar)">
              <div class="input-group-append">
                <span class="input-group-text">.00</span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label>Expiry Date</label>
            <input type="date" id="datepicker" name="expirydate" class="form-control">
          </div>
          <div class="form-group">
            <label>Message for Receiver</label>
            <input type="text" name='vnote' class="form-control" required="">
          </div>
          <div class="form-group">
            <label>Description</label>
            <textarea rows="7" name="description" class="form-control"></textarea>
          </div>
          <div class="form-group">
            <label>T & C</label>
            <textarea name="tc" class="form-control" style=" min-width:500px; max-width:100%;min-height:170px;height:100%;width:100%;">1. This voucher can be redeemed at Peter England Vadodara and Ankeleshwar store of Shree shanti.
2. This voucher has to be redeemed in full in a single transaction. Partial redemption is not allowed. 
3. This voucher cannot be exchanged for cash or cheque.
4. This voucher cannot be revalidated once expired.
5. Any dispute should be referred to the company and the decision of the company shall be final.
6. This voucher can not be clubbed with any other scheme
7. This voucher is applicable only for garments. </textarea>
          </div>
          <div class="form-group">
            <label>How to Reedem</label>
            <textarea name="reedem" class="form-control" style=" min-width:500px; max-width:100%;min-height:220px;height:100%;width:100%;">
1. Visit the outlet in Following address

Vadodara : 1 Trimurti Bhavan, Opp Maharani School, Navrang Cinema Road, Raopura, Vadodara 390001
Ankleshwar : Omkar 2, Shop No. 6-7 Opp. GIDC Railway Station, Near Lords Plaza, Ankleshwar 393002

2. Before making the purchase confirm about the acceptance of voucher at the store.
3. Choose the garments which  you would like to buy.
4. Show your voucher details to the cashier at the time of billing & pay any balance amount by cash ,card or UPI.
            </textarea>
          </div>
          <!-- <div class="form-group">
                      <label class="d-block">Select Delivery Mode</label>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="delivery[]" value="email" id="defaultCheck1">
                        <label class="form-check-label" for="defaultCheck1">
                          Email
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="delivery[]" value="sms" id="defaultCheck2">
                        <label class="form-check-label" for="defaultCheck2">
                          SMS
                        </label>
                      </div>
                    </div> -->
        </div>
        <div class="card-footer text-right">
          <input type="submit" class="btn btn-primary" name="btnSave" value="Next">
        </div>
      </form>
    </div>
    <div class="section-body">
    </div>
  </section>
</div>


<?php include 'layout-footer.php'; ?>