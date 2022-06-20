<?php

$con=mysqli_connect('localhost','root','','shreeshanti');
date_default_timezone_set('Asia/Kolkata');
$id=$_GET['id'];
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
  }
  //the SQL query to be executed
  $query = "SELECT DISTINCT vstatus ,COUNT(*) AS UnusedVouchers from voucher_details INNER JOIN voucher ON voucher_details.vId = voucher.vId WHERE voucher.vId='$id' GROUP BY vstatus ";
  //storing the result of the executed query
  $result = $con->query($query);
  //initialize the array to store the processed data
  $jsonArray = array();
  //check if there is any data returned by the SQL Query
  if ($result->num_rows > 0) {
    //Converting the results into an associative array
    while($row = $result->fetch_assoc()) {
      $jsonArrayItem = array();
      $jsonArrayItem['label'] = $row['vstatus'];
      $jsonArrayItem['value'] = $row['UnusedVouchers'];
      //append the above created object into the main array.
      array_push($jsonArray, $jsonArrayItem);
    }
  }
  //Closing the connection to DB
  $con->close();
  //set the response content type as JSON
  header('Content-type: application/json');
  //output the return value of json encode using the echo function.
  echo json_encode($jsonArray);
?>