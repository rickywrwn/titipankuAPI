<?php
include("DbConnect.php");

$today = date("Y-m-d");

$sql = "SELECT * FROM postTrip WHERE tanggalPulang <= '$today' AND status != '0' ";
$result = mysqli_query($conn,$sql);

$trips=array();
if(mysqli_num_rows($result) > 0)
{
  while($row = $result->fetch_assoc()) {
      $id = $row["id"];
      $sql2 = "UPDATE postTrip SET status='0' WHERE id='$id' ";
      $result2 = mysqli_query($conn,$sql2);
      if($result2)
      {
        $newDate = date("d F Y", strtotime($row["tanggalPulang"]));
            $trip=array("id"=>$row["id"],"country"=>$row["country"],"tanggalPulang"=>$newDate,"status"=>$row["status"]);
            array_push($trips,$trip);
      }
    }
}
// headers to tell that result is JSON
header('Content-type: application/json');
echo json_encode($trips);
?>
