<?php
include("DbConnect.php");

$sql1 = "SELECT * FROM postPreorder where batasWaktu = '1'";
$result1 = mysqli_query($conn,$sql1);

$apps=array();
if(mysqli_num_rows($result1) > 0)
{
  while($row = $result1->fetch_assoc()) {

          $newDate = date("d F Y", strtotime($row["deadline"]));
          $newDate1 = date("d F Y", strtotime($row["tglPost"]));
          $newPrice = number_format($row["price"]);
          $app=array("id"=>$row["id"],"email"=>$row["email"],"name"=>$row["name"],"description"=>$row["description"],"category"=>$row["category"],"country"=>$row["country"],"price"=>$newPrice,"ImageName"=>$row["imageName"],"url"=>$row["url"],"qty"=>$row["qty"],"berat"=>$row["berat"],"kotaKirim"=>$row["kotaKirim"],"idKota"=>$row["idKota"],"provinsi"=>$row["provinsi"],"tglPost"=>$newDate1,"status"=>$row["status"],"deadline"=>$newDate,"batasWaktu"=>$row["batasWaktu"],"cdText"=>$row["cdText"],"cdValue"=>$row["cdValue"]);
          array_push($apps,$app);
      }
}

// headers to tell that result is JSON
header('Content-type: application/json');
echo json_encode($apps);
?>