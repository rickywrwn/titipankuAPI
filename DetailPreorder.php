<?php
include("DbConnect.php");

$id = $_GET["id"];

$sql = "SELECT * FROM postPreorder WHERE id = '$id'";
$result = mysqli_query($conn,$sql);

$app=array();
if(mysqli_num_rows($result) > 0)
{
  while($row = $result->fetch_assoc()) {

    $newDate = date("d F Y", strtotime($row["deadline"]));
    $newDate1 = date("d F Y", strtotime($row["tglPost"]));
    $newPrice = number_format($row["price"]);
    $date = new DateTime($row["cdValue"]);
    $date2 =  new DateTime();
    $diffSeconds = $date->getTimestamp() - $date2->getTimestamp();
      $request=array("id"=>$row["id"],"email"=>$row["email"],"name"=>$row["name"],"description"=>$row["description"],"category"=>$row["category"],"country"=>$row["country"],"price"=>$newPrice,"valueHarga"=>$row["price"],"ImageName"=>$row["imageName"],"url"=>$row["url"],"qty"=>$row["qty"],"berat"=>$row["berat"],"kotaKirim"=>$row["kotaKirim"],"idKota"=>$row["idKota"],"provinsi"=>$row["provinsi"],"tglPost"=>$newDate1,"status"=>$row["status"],"deadline"=>$newDate,"batasWaktu"=>$row["batasWaktu"],"cdText"=>$row["cdText"],"cdValue"=>$diffSeconds,"brand"=>$row["brand"]);

  }
}
// headers to tell that result is JSON
header('Content-type: application/json');
echo json_encode($request);
?>
