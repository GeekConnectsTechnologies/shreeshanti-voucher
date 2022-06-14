<?php
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: ../login/index.php');
	exit;
}
require_once "../dbc.php";
require_once ('./vendor/autoload.php');


if (isset($_POST["update"])) {
  $companyId = $_POST['companyId'];
    $allowedFileType = [
        'application/vnd.ms-excel',
        'text/xls',
        'text/xlsx',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
    ];

    if (in_array($_FILES["file"]["type"], $allowedFileType)) {

        $targetPath = 'uploads/' . $_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);

        $Reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

        $spreadSheet = $Reader->load($targetPath);
        $excelSheet = $spreadSheet->getActiveSheet();
        $spreadSheetAry = $excelSheet->toArray();
        $sheetCount = count($spreadSheetAry);

        for ($i = 0; $i <= $sheetCount; $i ++) {
            $empName = "";
            if (isset($spreadSheetAry[$i][0])) {
                $empName = mysqli_real_escape_string($con, $spreadSheetAry[$i][0]);
            }
            $email = "";
            if (isset($spreadSheetAry[$i][1])) {
                $email = mysqli_real_escape_string($con, $spreadSheetAry[$i][1]);
            }
            $phoneNo = "";
            if (isset($spreadSheetAry[$i][2])) {
                $phoneNo = mysqli_real_escape_string($con, $spreadSheetAry[$i][2]);
            }
            $designation = "";
            if (isset($spreadSheetAry[$i][3])) {
                $designation = mysqli_real_escape_string($con, $spreadSheetAry[$i][3]);
            }
            if (! empty($empName) || ! empty($email) || ! empty($phoneNo) || ! empty($designation)) {
                $query = "insert into employee(empName,email,phoneNo,designation,companyId) values('$empName','$email','$phoneNo','$designation','$companyId')";
                $result = mysqli_query($con, $query);
            }
        }
    } else {
        $type = "error";
        $message = "Invalid File Type. Upload Excel File.";
    }
    header('refresh:5;viewemployee.php');
}
?>
<?php include 'layout-header.php'; ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
                <div class="card">
                  <form action="" method="post" enctype="multipart/form-data">
                    <div class="card-header">
                      <h4>Add Excel</h4>
                    </div>
                    <div class="card-body">
                    <div class="form-group">
                      <label>Choose Company</label>
                      <select id="cId" name="companyId" class="custom-select">
                      <?php
                        $records = mysqli_query($con, "SELECT * From company");

                        while($data = mysqli_fetch_array($records))
                        {
                            echo "<option value='".$data['companyId']."'>" .$data['companyName']."</option>";
                        }
                    ?>
                      </select>
                    </div>
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="file" id="customFile" accept=".xls,.xlsx">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                      </div>
                    </div>
                    <div class="card-footer text-right">
                    <input type="submit" class="btn btn-primary" name="update" value="Submit">
                    </div>
                  </form>
                </div>
        </div>

        <div class="section-body">
        </div>
    </section>
</div>
<?php include 'layout-footer.php'; ?>
