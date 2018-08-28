<?php
include("DbConnect.php");

$email = $_GET["email"];

$sql = "SELECT * FROM notification WHERE email='$email' ORDER BY id DESC";
$result = mysqli_query($conn,$sql);

$app=array();
if(mysqli_num_rows($result) > 0)
{
  while($row = $result->fetch_assoc()) {

          $newDate = date("d F Y", strtotime($row["tanggal"]));
          $request=array("id"=>$row["id"],"email"=>$row["email"],"name"=>$row["name"],"tanggal"=>$newDate,"idTujuan"=>$row["idTujuan"],"jenis"=>$row["jenis"]);
          array_push($app,$request);
      }
}

// headers to tell that result is JSON
header('Content-type: application/json');
echo json_encode($app);
?>
