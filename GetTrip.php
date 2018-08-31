<?php
include("DbConnect.php");

$email = $_GET["email"];

$sql = "SELECT * FROM postTrip WHERE email = '$email' AND status != '0' ORDER BY id DESC ";
$result = mysqli_query($conn,$sql);

$trips=array();
if(mysqli_num_rows($result) > 0)
{
  while($row = $result->fetch_assoc()) {

      $newDate = date("d F Y", strtotime($row["tanggalPulang"]));
          $trip=array("id"=>$row["id"],"country"=>$row["country"],"tanggalPulang"=>$newDate,"status"=>$row["status"]);
          array_push($trips,$trip);
      }
}
// headers to tell that result is JSON
header('Content-type: application/json');
echo json_encode($trips);
?>
