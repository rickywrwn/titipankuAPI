<?php
include("DbConnect.php");

$idTrip = $_GET["idTrip"];

$sql5 = "SELECT * FROM tripRequest WHERE idTrip ='$idTrip' ORDER BY id DESC";
$result5 = mysqli_query($conn,$sql5);

$offers=array();
if(mysqli_num_rows($result5) > 0)
{
  while($row = $result5->fetch_assoc()) {
          $offer=array("id"=>$row["id"],"idRequest"=>$row["idRequest"],"idTrip"=>$row["idTrip"],"email"=>$row["email"]);
          array_push($offers,$offer);
      }
}

  // headers to tell that result is JSON
  header('Content-type: application/json');
  echo json_encode($offers);
?>
