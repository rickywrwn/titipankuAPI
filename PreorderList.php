<?php
include("DbConnect.php");

$sql = "SELECT * FROM postPreorder ";
$result = mysqli_query($conn,$sql);

$trips=array();
if(mysqli_num_rows($result) > 0)
{
  while($row = $result->fetch_assoc()) {
          $trip=array("id"=>(int)$row["id"] ,"name"=>$row["name"],"category"=>$row["category"],"country"=>$row["country"],"price"=>(int)$row["price"],"imageName"=>$row["imageName"],"status"=>$row["status"]);
          array_push($trips,$trip);
      }
}
// headers to tell that result is JSON
header('Content-type: application/json');
echo json_encode($trips);
?>
