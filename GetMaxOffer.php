<?php
include("DbConnect.php");

$max = "SELECT MAX(id) AS max_id FROM offerRequest";
$max1 =  mysqli_query($conn, $max);
$row = mysqli_fetch_assoc($max1);
$max_id=$row['max_id']+1;
$orderId = 'r'.$max_id;
$response = array('orderId' => $orderId);
// headers to tell that result is JSON
header('Content-type: application/json');
echo json_encode($response);
?>
