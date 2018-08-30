<?php
include("DbConnect.php");

$emailA = $_GET["emailA"];
$emailB = $_GET["emailB"];

$sql = "SELECT * FROM chatroom WHERE emailA='$emailA' AND emailB='$emailB' ORDER BY id ASC";
$result = mysqli_query($conn,$sql);

$app=array();
if(mysqli_num_rows($result) > 0)
{
  while($row = $result->fetch_assoc()) {

          $request=array("id"=>$row["id"],"emailA"=>$row["emailA"],"emailB"=>$row["emailB"],"tanggal"=>$row["tanggal"]);
          array_push($app,$request);
      }
}else{
  $sql = "SELECT * FROM chatroom WHERE emailA='$emailB' AND emailB='$emailA' ORDER BY id ASC";
  $result = mysqli_query($conn,$sql);

  $app=array();
  if(mysqli_num_rows($result) > 0)
  {
    while($row = $result->fetch_assoc()) {

            $request=array("id"=>$row["id"],"emailA"=>$row["emailA"],"emailB"=>$row["emailB"],"tanggal"=>$row["tanggal"]);
            array_push($app,$request);
        }
  }
}

// headers to tell that result is JSON
header('Content-type: application/json');
echo json_encode($app);
?>
