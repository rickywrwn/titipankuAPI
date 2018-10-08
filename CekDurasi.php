<?php
include("DbConnect.php");
date_default_timezone_set("Asia/Jakarta");
$today = date("Y-m-d H:i:s");

$sql = "SELECT * FROM postPreorder WHERE batasWaktu = '1' ";
$result = mysqli_query($conn,$sql);

$trips=array();
if(mysqli_num_rows($result) > 0)
{
  while($row = $result->fetch_assoc()) {
      $id = $row["id"];
      $tglPost = $row["cdValue"];

      if ($today <= $tglPost) {

        array_push($trips,"belum selesai");
      }else{
        $sql2 = "UPDATE postPreorder SET status='0' WHERE id='$id' ";
        $result2 = mysqli_query($conn,$sql2);
        if($result2)
        {
              $trip=array("id"=>$row["id"],"deadline"=>$row["deadline"],"status"=>$row["status"], "waktu"=>"selesai");
              array_push($trips,$trip);
        }
      }


    }
}

// headers to tell that result is JSON
header('Content-type: application/json');
echo json_encode($trips);
?>
