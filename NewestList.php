<?php
include("DbConnect.php");
date_default_timezone_set("Asia/Jakarta");

$bannerApps = array();
$imageName = array("ImageName"=>"");
array_push($bannerApps,$imageName);
$imageName = array("ImageName"=>"");
array_push($bannerApps,$imageName);
$imageName = array("ImageName"=>"");
array_push($bannerApps,$imageName);
$imageName = array("ImageName"=>"");
array_push($bannerApps,$imageName);

date_default_timezone_set("Asia/Jakarta");
$banner = array("name"=>"","apps"=>$bannerApps,"type"=>"");

$sql = "SELECT * FROM postRequest WHERE status != '0' ORDER BY id DESC";
$result = mysqli_query($conn,$sql);

$app=array();
if(mysqli_num_rows($result) > 0)
{
  while($row = $result->fetch_assoc()) {

          $newDate = date("d F Y", strtotime($row["tglPost"]));
          $newPrice = number_format($row["price"],0,",",".");
          $request=array("id"=>$row["id"],"valueHarga"=>$row["price"],"email"=>$row["email"],"name"=>$row["name"],"description"=>$row["description"],"category"=>$row["category"],"country"=>$row["country"],"price"=>$newPrice,"ImageName"=>$row["imageName"],"url"=>$row["url"],"qty"=>$row["qty"],"ukuran"=>$row["ukuran"],"berat"=>$row["berat"],"kotaKirim"=>$row["kotaKirim"],"idKota"=>$row["idKota"],"provinsi"=>$row["provinsi"],"tglPost"=>$newDate,"nomorResi"=>$row["nomorResi"],"status"=>$row["status"]);
          array_push($app,$request);
      }
}

$sql2 = "SELECT * FROM postPreorder where batasWaktu = '0' AND status != '0' ORDER BY id DESC";
$result2 = mysqli_query($conn,$sql2);

$trips=array();
if(mysqli_num_rows($result2) > 0)
{
  while($row = $result2->fetch_assoc()) {

          $newDate = date("d F Y", strtotime($row["deadline"]));
          $newDate1 = date("d F Y", strtotime($row["tglPost"]));
          $newPrice = number_format($row["price"],0,",",".");
          $trip=array("id"=>$row["id"],"email"=>$row["email"],"name"=>$row["name"],"description"=>$row["description"],"category"=>$row["category"],"country"=>$row["country"],"price"=>$newPrice,"ImageName"=>$row["imageName"],"url"=>$row["url"],"qty"=>$row["qty"],"berat"=>$row["berat"],"kotaKirim"=>$row["kotaKirim"],"idKota"=>$row["idKota"],"provinsi"=>$row["provinsi"],"tglPost"=>$newDate1,"status"=>$row["status"],"deadline"=>$newDate,"batasWaktu"=>$row["batasWaktu"],"valueHarga"=>$row["price"],"brand"=>$row["brand"]);
          array_push($trips,$trip);
      }
}

$sql1 = "SELECT * FROM postPreorder where batasWaktu = '1' AND status != '0' ORDER BY id DESC";
$result1 = mysqli_query($conn,$sql1);

$flashSale=array();
if(mysqli_num_rows($result1) > 0)
{
  while($row = $result1->fetch_assoc()) {

          $newDate = date("d F Y", strtotime($row["deadline"]));
          $newDate1 = date("d F Y", strtotime($row["tglPost"]));
          $newPrice = number_format($row["price"],0,",",".");

          $date = new DateTime($row["cdValue"]);
          $date2 =  new DateTime();
          $diffSeconds = $date->getTimestamp() - $date2->getTimestamp();

          $trip=array("id"=>$row["id"],"valueHarga"=>$row["price"],"email"=>$row["email"],"name"=>$row["name"],"description"=>$row["description"],"category"=>$row["category"],"country"=>$row["country"],"price"=>$newPrice,"ImageName"=>$row["imageName"],"url"=>$row["url"],"qty"=>$row["qty"],"berat"=>$row["berat"],"kotaKirim"=>$row["kotaKirim"],"idKota"=>$row["idKota"],"provinsi"=>$row["provinsi"],"tglPost"=>$newDate1,"status"=>$row["status"],"deadline"=>$newDate,"batasWaktu"=>$row["batasWaktu"],"cdText"=>$row["cdText"],"cdValue"=>$diffSeconds,"brand"=>$row["brand"]);
          array_push($flashSale,$trip);
      }
}

$maincategory = array();
$categories1 = array("name"=>"Permintaan Terbaru","apps"=>$app);
$categories2 = array("name"=>"Preorder Terbaru","apps"=>$trips);
$categories3 = array("name"=>"Preorder Berdurasi Terbaru","apps"=>$flashSale);

array_push($maincategory,$categories1);
array_push($maincategory,$categories2);
array_push($maincategory,$categories3);

$body = array("bannerCategory"=>$banner,"categories"=>$maincategory);
// headers to tell that result is JSON
header('Content-type: application/json');
echo json_encode($body);
?>
