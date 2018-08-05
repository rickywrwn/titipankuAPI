<?php
include("DbConnect.php");

$idRequest = $_GET["idRequest"];

$sql1 = "SELECT * FROM offerRequest WHERE idRequest = '$idRequest' AND status = '2'";
$result1 = mysqli_query($conn,$sql1);

$offers=array();
if(mysqli_num_rows($result1) > 0)
{
  while($row = $result1->fetch_assoc()) {
          $newDate = date("d F Y", strtotime($row["tglOffer"]));
          $newDate1 = date("d F Y", strtotime($row["tglPulang"]));
          $newPrice = number_format((int)$row["hargaPenawaran"]);
          $offer=array("id"=>$row["id"],"idPenawar"=>$row["idPenawar"],"tglOffer"=>$newDate,"hargaPenawaran"=>$newPrice,"valueHarga"=>$row["hargaPenawaran"],"tglPulang"=>$newDate1,"idKota"=>$row["idKota"],"kota"=>$row["kota"],"hargaOngkir"=>$row["hargaOngkir"],"jenisOngkir"=>$row["jenisOngkir"],"status"=>$row["status"]);
          array_push($offers,$offer);
      }

  // headers to tell that result is JSON
  header('Content-type: application/json');
  echo json_encode($offers);
}else{
  $sql = "SELECT * FROM offerRequest WHERE idRequest = '$idRequest' AND status = '1'";
  $result = mysqli_query($conn,$sql);

  $offers=array();
  if(mysqli_num_rows($result) > 0)
  {

    while($row = $result->fetch_assoc()) {
            $newDate = date("d F Y", strtotime($row["tglOffer"]));
            $newDate1 = date("d F Y", strtotime($row["tglPulang"]));
            $newPrice = number_format((int)$row["hargaPenawaran"]);
            $offer=array("id"=>$row["id"],"idPenawar"=>$row["idPenawar"],"tglOffer"=>$newDate,"hargaPenawaran"=>$newPrice,"valueHarga"=>$row["hargaPenawaran"],"tglPulang"=>$newDate1,"idKota"=>$row["idKota"],"kota"=>$row["kota"],"hargaOngkir"=>$row["hargaOngkir"],"jenisOngkir"=>$row["jenisOngkir"],"status"=>$row["status"]);
            array_push($offers,$offer);
        }

    // headers to tell that result is JSON
    header('Content-type: application/json');
    echo json_encode($offers);
  }else{
    $response = array('success' => 0,
             'message' => 'tidak ada');
    // headers to tell that result is JSON
    header('Content-type: application/json');
    echo json_encode($response);
  }
}

?>
