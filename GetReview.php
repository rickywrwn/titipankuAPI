<?php
include("DbConnect.php");

$email = $_GET["email"];

$sql5 = "SELECT * FROM reviewUser WHERE email ='$email' ORDER BY id DESC";
$result5 = mysqli_query($conn,$sql5);

$offers=array();
if(mysqli_num_rows($result5) > 0)
{
  while($row = $result5->fetch_assoc()) {
    $offer=array("id"=>$row["id"],"rating"=>$row["rating"],"review"=>$row["review"]);
    array_push($offers,$offer);
      }
}

  // headers to tell that result is JSON
  header('Content-type: application/json');
  echo json_encode($offers);
?>
