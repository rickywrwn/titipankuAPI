<?php

include("DbConnect.php");

$email = $_GET['email'];
$token = $_GET["token"];

$sql2 = "UPDATE user SET device='$token' WHERE email='$email'";
$result2 = mysqli_query($conn,$sql2);
if($result2){
  $response = array('success' => 1,
           'message' => 'Update Device Sukses');
}



  // headers to tell that result is JSON
  header('Content-type: application/json');
  echo json_encode($response);
?>
