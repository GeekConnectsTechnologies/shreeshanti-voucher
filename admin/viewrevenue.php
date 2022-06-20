<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if(!isset($_SESSION['IS_LOGIN']))
  {
    header('location:../index.php');
    die();
  }

  if(isset($_SESSION['ROLE']) && $_SESSION['ROLE']!='1')
  {
    header('location:../index.php');
    die();
  }
require_once "../dbc.php";
?>
<?php
if (isset($_GET['delete'])) {
  $empId = $_GET['delete'];

  $sql = "delete from employee where empId=" . $empId;
  if (mysqli_query($con, $sql)) {
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
            <h4>Company Wise Revenue</h4>
            <!-- <div class="card-header-action">
                      <a href="addexcel.php" class="btn btn-success">
                        Add Employee's Excel
                      </a>
                    </div> -->
          </div>
          <!-- <div class="card-body">

                  </div> -->
        </div>
      </div>
    </div>
    <div class="section-body">
      <div class="row">
        <div class="col-lg-7 col-md-7 col-12">
          <div class="card">
            <div class="card-header">
              <h4>Revenue Chart</h4>
            </div>
            <div class="card-body">
                <div id="chart-container-issue">Chart Will Be Here</div>
            </div>
          </div>
        </div>
        <div class="col-5 col-sm-5 col-lg-5">
            <div class="card">
              <div class="card-header">
                <h4>Revenue Data</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped" id="table-company">
                    <thead>
                      <tr>
                        <th>Company Name</th>
                        <th>Revenue Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $sqlquery = "SELECT SUM(amount) AS TotalAmount, companyName from voucher_details INNER JOIN voucher ON voucher_details.vId = voucher.vId INNER JOIN company ON company.companyId=voucher.companyId GROUP BY company.companyId";
                      $result = mysqli_query($con, $sqlquery);
                      while ($rowgetdata = mysqli_fetch_array($result)) {
                        echo "<tr>";
                        echo "<td>" . $rowgetdata['companyName'] . "</td>";
                        echo "<td>" . $rowgetdata['TotalAmount'] . "</td>";
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
    </div>
  </section>
</div>
<footer class="main-footer">
    <div class="footer-left">
        Copyright &copy; 2021
    </div>

</footer>
</div>
</div>

<!-- General JS Scripts -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script src="../assets/js/stisla.js"></script>

<!-- JS Libraies -->

<!-- Template JS File -->
<script src="../assets/js/scripts.js"></script>
<script src="../assets/js/fusioncharts.js"></script>
<script src="../assets/js/fusioncharts.charts.js"></script>
<script src="../assets/js/themes/fusioncharts.theme.zune.js"></script>
<script src="../assets/js/custom.js"></script>
<script src="../assets/js/page/modules-datatables.js"></script>

<!-- Page Specific JS File -->
</body>

</html>

<script>
 $(function() {

    var urldata= 'chartdata3.php';
    $.ajax({

      url: urldata,
      type: "GET",
      success: function(data) {
        chartData = data;
        var chartProperties = {
          caption: "",
          xAxisName: "Date",
          yAxisName: "Orders",
          rotatevalues: "1",
          theme: "zune",
          "bgColor": "#fffffff",
          "plotHoverEffect": "1",
          "plotFillHoverColor": "#C318F5",
          "color":"#6D038C"
          
        };
        apiChart = new FusionCharts({
          type: "column2d",
          renderAt: "chart-container-issue",
          width: "100%",
          height: "270",
          dataFormat: "json",
          
          dataSource: {
            chart: chartProperties,
            data: chartData
          }
        });
        apiChart.render();
      }
    });
    console.log(urldata);
  });
</script>