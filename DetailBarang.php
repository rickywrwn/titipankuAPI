<?php
include("DbConnect.php");

$id = $_GET["id"];

$sql = "SELECT * FROM postRequest WHERE id = '$id'";
$result = mysqli_query($conn,$sql);

$app=array();
if(mysqli_num_rows($result) > 0)
{
  while($row = $result->fetch_assoc()) {
          $newPrice = number_format($row["price"]);
          $newDate = date("d F Y", strtotime($row["tglPost"]));
          $request=array("id"=>$row["id"],"email"=>["email"] ,"email"=>$row["email"],"name"=>$row["name"],"description"=>$row["description"],"category"=>$row["category"],"country"=>$row["country"],"price"=>$newPrice,"ImageName"=>$row["imageName"],"url"=>$row["url"],"qty"=>$row["qty"],"ukuran"=>$row["ukuran"],"berat"=>$row["berat"],"kotaKirim"=>$row["kotaKirim"],"idKota"=>$row["idKota"],"provinsi"=>$row["provinsi"],"tglPost"=> $newDate,"status"=>$row["status"]);
      }
}
// headers to tell that result is JSON
header('Content-type: application/json');
echo json_encode($request);
?>
