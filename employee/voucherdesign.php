<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../login/index.php');
    exit;
}
$voucherId = $_SESSION['voucherId'];

require_once "../dbc.php";
require_once "testimage.php";
require_once "testmail.php";

if(isset($_POST['generateImage']))
{
    $sqlgetvoucherdetails='select employee.empName, employee.email, voucher.message, voucher.vPrice, voucher.expirydate, voucher.uiimage, voucher.vId, voucher_details.uniqueId, voucher_details.empId from voucher_details INNER JOIN voucher on voucher.vId=voucher_details.vId INNER JOIN employee ON employee.empId=voucher_details.empId where voucher_details.vId='.$voucherId;
    $result=mysqli_query($con,$sqlgetvoucherdetails);
    while($rowget=mysqli_fetch_array($result))
    {
        generateImage($rowget['empName'],$rowget['message'],$rowget['vPrice'],$rowget['expirydate'],$rowget['uniqueId'],$rowget['uiimage']);
        sendEmail($rowget['email'],$rowget['uniqueId']);
    }
}

?>
<?php include 'layout-header.php'; ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <form action="" method="post">
                <fieldset style="border: dashed; padding: 10px; border-width: 2px; ">
                    <legend style="  display: block; padding-left: 12px; padding-right: 12px; border: none;">Preview</legend>
                    <?php
                    $sqlgetdata = 'select employee.empName, employee.email, voucher.message, voucher.vPrice, voucher.expirydate, voucher.uiimage, voucher.vId, voucher_details.uniqueId, voucher_details.empId from voucher_details INNER JOIN voucher on voucher.vId=voucher_details.vId INNER JOIN employee ON employee.empId=voucher_details.empId where voucher_details.vId='.$voucherId.' LIMIT 1';
                    $result = mysqli_query($con, $sqlgetdata);
                    
                    while ($rowgetdata = mysqli_fetch_array($result)) {
                        echo "<input type='file' name='file' id='file' /><br><br>";
                        echo "<span id='uploaded_image'></span>";
                        echo '<img src="imageupload/' . $rowgetdata['uiimage'] . '" id="defaultImage">';
                        echo "<br><br>";
                        echo     "<h5>Hi, " . $rowgetdata['empName'] . "</h5>";
                        echo     "<p class='mb-2'>" . $rowgetdata['message'] . "</p>";
                        echo "<div class='row' style='width: 100%;'>";
                        echo     "<div class='col-md-5'>";
                        echo         "<img src='imageupload/view.png'>";
                        echo     "</div>";
                        echo     "<div class='col-md-7 my-auto'>";
                        echo         "<h3>Rs." . $rowgetdata['vPrice'] . "</h3>";
                        echo         "<h4>*Valid Till " . $rowgetdata['expirydate'] . "</h4>";
                        echo     "</div>";
                        echo "</div>";
                    }
                    ?>
                </fieldset>
                <br><br>
                <input type="submit" class="btn btn-primary" name="generateImage" value="Generate and Send Voucher">
            </form>
            <br><br>
           
        </div>

        <div class="section-body">
        <div class="card">
                  <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab2" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="home-tab2" data-toggle="tab" href="#home2" role="tab" aria-controls="home" aria-selected="true">Description</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#profile2" role="tab" aria-controls="profile" aria-selected="false">Terms & Conditions</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="contact-tab2" data-toggle="tab" href="#contact2" role="tab" aria-controls="contact" aria-selected="false">How to Redeem</a>
                      </li>
                    </ul>
                    <?php
                        $sqldes = "SELECT * FROM voucher where vId=".$voucherId;
                        $resultdes = mysqli_query($con, $sqldes);
                        
                        while ($rowdes = mysqli_fetch_array($resultdes)) {
                        
                    ?>
                    <div class="tab-content tab-bordered" id="myTab3Content">
                      <div class="tab-pane fade show active" id="home2" role="tabpanel" aria-labelledby="home-tab2">
                        <?php echo $rowdes['description'] ?>
                      </div>
                      <div class="tab-pane fade" id="profile2" role="tabpanel" aria-labelledby="profile-tab2">
                      <?php echo $rowdes['tc'] ?>
                      </div>
                      <div class="tab-pane fade" id="contact2" role="tabpanel" aria-labelledby="contact-tab2">
                      <?php echo $rowdes['reedem'] ?>
                      </div>
                      <?php
                        }?>
                    </div>
                  </div>
                </div>
        </div>
    </section>
</div>

<script>
$(document).ready(function(){
 $(document).on('change', '#file', function(){
  var name = document.getElementById("file").files[0].name;
  var form_data = new FormData();
  var ext = name.split('.').pop().toLowerCase();
  if(jQuery.inArray(ext, ['png','jpg','jpeg']) == -1) 
  {
   alert("Invalid Image File");
  }
  var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById("file").files[0]);
  var f = document.getElementById("file").files[0];
  var fsize = f.size||f.fileSize;
  if(fsize > 2000000)
  {
   alert("Image File Size is very big");
  }
  else
  {
   form_data.append("file", document.getElementById('file').files[0]);
   $.ajax({
    url:"upload.php",
    method:"POST",
    data: form_data,
    contentType: false,
    cache: false,
    processData: false,
    beforeSend:function(){
     $('#uploaded_image').html("<label class='text-success'>Image Uploading...</label>");
    },   
    success:function(data)
    {
     $('#uploaded_image').html(data);
     $('#defaultImage').hide();
    }
   });
  }
 });
});
</script>



<?php include 'layout-footer.php'; ?>