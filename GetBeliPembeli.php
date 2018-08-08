<?php
include("DbConnect.php");

$idPreorder = $_GET["idPreorder"];
$idPembeli = $_GET["idPembeli"];

  $sql = "SELECT * FROM offerPreorder WHERE idPreorder = '$idPreorder' AND status != '0' AND idPembeli = '$idPembeli' ORDER BY id DESC";
  $result = mysqli_query($conn,$sql);

  $offers=array();
  if(mysqli_num_rows($result) > 0)
  {

    while($row = $result->fetch_assoc()) {
            $newDate = date("d F Y", strtotime($row["tglBeli"]));
            $newPrice = number_format((int)$row["hargaOngkir"]);
            $offer=array("id"=>$row["id"],"idPembeli"=>$row["idPembeli"],"tglBeli"=>$newDate,"hargaOngkir"=>$newPrice,"valueHarga"=>$row["hargaOngkir"],"qty"=>$row["qty"],"idKota"=>$row["idKota"],"kota"=>$row["kota"],"pengiriman"=>$row["pengiriman"],"jenisOngkir"=>$row["jenisOngkir"],"nomorResi"=>$row["nomorResi"],"status"=>$row["status"]);
            array_push($offers,$offer);
        }

    // headers to tell that result is JSON
    header('Content-type: application/json');
    echo json_encode($offers);
  }else{
    $response = array('success' => 0,
             'message' => 'Kosong');
    // headers to tell that result is JSON
    header('Content-type: application/json');
    echo json_encode($response);
  }

?>
