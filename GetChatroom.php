<?php
include("DbConnect.php");

$email = $_GET["email"];

$sql = "SELECT * FROM chatroom WHERE emailA='$email' OR emailB='$email' ORDER BY id ASC";
$result = mysqli_query($conn,$sql);

$app=array();
if(mysqli_num_rows($result) > 0)
{
  while($row = $result->fetch_assoc()) {

    $newDate = date("d F Y", strtotime($row["tanggal"]));

    $request=array("id"=>$row["id"],"emailA"=>$row["emailA"],"emailB"=>$row["emailB"],"tanggal"=>$newDate,"jenis"=>$row["jenis"],"tujuan"=>$row["tujuan"],"idTujuan"=>$row["idTujuan"]);
          array_push($app,$request);
      }
}

// headers to tell that result is JSON
header('Content-type: application/json');
echo json_encode($app);
?>
