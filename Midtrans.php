<?php
include("DbConnect.php");

  $response = array('success' => 0,
           'message' => 'midtrans sukses');
  // headers to tell that result is JSON
  header('Content-type: application/json');
  echo json_encode($response);

?>
