<?php
include("DbConnect.php");

$today = date("Y-m-d");

$sql = "SELECT * FROM postPreorder WHERE status = '4' ";
$result = mysqli_query($conn,$sql);

$trips=array();
if(mysqli_num_rows($result) > 0)
{
  while($row = $result->fetch_assoc()) {
      $id = $row["id"];
      $tglPost = $row["deadline"];
      $cekDate = date('Y-m-d', strtotime($tglPost. ' + 7 days'));
      if($today == $cekDate){
        $sql2 = "UPDATE offerRequest SET status='0' WHERE id='$id' ";
        $result2 = mysqli_query($conn,$sql2);
        if($result2)
        {
              $trip=array("id"=>$row["id"],"deadline"=>$row["deadline"],"status"=>$row["status"]);
              array_push($trips,$trip);
        }
      }

    }
}

// headers to tell that result is JSON
header('Content-type: application/json');
echo json_encode($trips);
?>
