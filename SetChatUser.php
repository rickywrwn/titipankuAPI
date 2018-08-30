<?php
include("DbConnect.php");

$idChatroom =  $_GET["idChatroom"];
$today = date("Y-m-d");

$sql1 = "UPDATE chatroom SET tanggal='$today' WHERE id='$idChatroom'";
$result1 = mysqli_query($conn,$sql1);
if($result1)
{
  $response = array('success' => 1,
           'message' => 'Update chat Sukses');
}
else
{
  $response = array('success' => 0,
           'message' => mysqli_error($conn));
}

// headers to tell that result is JSON
header('Content-type: application/json');
echo json_encode($response);
?>
