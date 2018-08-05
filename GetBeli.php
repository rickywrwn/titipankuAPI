<?php
include("DbConnect.php");

$idPreorder = $_GET["idPreorder"];

$sql = "SELECT * FROM offerPreorder WHERE idPreorder = '$idPreorder' AND status = '1'";
$result = mysqli_query($conn,$sql);

$offers=array();
if(mysqli_num_rows($result) > 0)
{

  while($row = $result->fetch_assoc()) {
          $newDate = date("d F Y", strtotime($row["tglBeli"]));
          $newPrice = number_format((int)$row["hargaOngkir"]);
          $offer=array("id"=>$row["id"],"idPembeli"=>$row["idPembeli"],"tglBeli"=>$newDate,"hargaOngkir"=>$newPrice,"valueHarga"=>$row["hargaOngkir"],"qty"=>$row["qty"],"idKota"=>$row["idKota"],"kota"=>$row["kota"],"pengiriman"=>$row["pengiriman"],"resi"=>$row["resi"],"status"=>$row["status"]);
          array_push($offers,$offer);
      }

  // headers to tell that result is JSON
  header('Content-type: application/json');
  echo json_encode($offers);
}else{
  $response = array('success' => 0,
           'message' => 'ada offer status selain 1');
  // headers to tell that result is JSON
  header('Content-type: application/json');
  echo json_encode($response);
}
?>
