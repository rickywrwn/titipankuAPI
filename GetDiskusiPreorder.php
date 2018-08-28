<?php
include("DbConnect.php");

$idPost = $_GET["idPost"];

$sql = "SELECT * FROM diskusiPreorder WHERE idPost='$idPost' ORDER BY id ASC";
$result = mysqli_query($conn,$sql);

$app=array();
if(mysqli_num_rows($result) > 0)
{
  while($row = $result->fetch_assoc()) {

          $newDate = date("d F Y", strtotime($row["tanggal"]));
          $request=array("id"=>$row["id"],"email"=>$row["email"],"isi"=>$row["isi"],"tanggal"=>$newDate);
          array_push($app,$request);
      }
}

// headers to tell that result is JSON
header('Content-type: application/json');
echo json_encode($app);
?>
