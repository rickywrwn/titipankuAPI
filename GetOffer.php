<?php
include("DbConnect.php");

$idRequest = $_GET["idRequest"];

$sql5 = "SELECT * FROM offerRequest WHERE idRequest = '$idRequest' AND status = '7' ORDER BY id DESC";
$result5 = mysqli_query($conn,$sql5);

$offers=array();
if(mysqli_num_rows($result5) > 0)
{
  while($row = $result5->fetch_assoc()) {
          $newDate = date("d F Y", strtotime($row["tglOffer"]));
          $newDate1 = date("d F Y", strtotime($row["tglPulang"]));
          $newPrice = number_format((int)$row["hargaPenawaran"]);
          $offer=array("id"=>$row["id"],"qty"=>"0","idRequest"=>$row["idRequest"],"idPenawar"=>$row["idPenawar"],"tglOffer"=>$newDate,"hargaPenawaran"=>$newPrice,"valueHarga"=>$row["hargaPenawaran"],"tglPulang"=>$newDate1,"idKota"=>$row["idKota"],"kota"=>$row["kota"],"hargaOngkir"=>$row["hargaOngkir"],"jenisOngkir"=>$row["jenisOngkir"],"status"=>$row["status"]);
          array_push($offers,$offer);
      }

  // headers to tell that result is JSON
  header('Content-type: application/json');
  echo json_encode($offers);
}else{
  $sql5 = "SELECT * FROM offerRequest WHERE idRequest = '$idRequest' AND status = '6' ORDER BY id DESC";
  $result5 = mysqli_query($conn,$sql5);

  $offers=array();
  if(mysqli_num_rows($result5) > 0)
  {
    while($row = $result5->fetch_assoc()) {
            $newDate = date("d F Y", strtotime($row["tglOffer"]));
            $newDate1 = date("d F Y", strtotime($row["tglPulang"]));
            $newPrice = number_format((int)$row["hargaPenawaran"]);
            $offer=array("id"=>$row["id"],"qty"=>"0","idRequest"=>$row["idRequest"],"idPenawar"=>$row["idPenawar"],"tglOffer"=>$newDate,"hargaPenawaran"=>$newPrice,"valueHarga"=>$row["hargaPenawaran"],"tglPulang"=>$newDate1,"idKota"=>$row["idKota"],"kota"=>$row["kota"],"hargaOngkir"=>$row["hargaOngkir"],"jenisOngkir"=>$row["jenisOngkir"],"status"=>$row["status"]);
            array_push($offers,$offer);
        }

    // headers to tell that result is JSON
    header('Content-type: application/json');
    echo json_encode($offers);
  }else{
    $sql5 = "SELECT * FROM offerRequest WHERE idRequest = '$idRequest' AND status = '5' ORDER BY id DESC";
    $result5 = mysqli_query($conn,$sql5);

    $offers=array();
    if(mysqli_num_rows($result5) > 0)
    {
      while($row = $result5->fetch_assoc()) {
              $newDate = date("d F Y", strtotime($row["tglOffer"]));
              $newDate1 = date("d F Y", strtotime($row["tglPulang"]));
              $newPrice = number_format((int)$row["hargaPenawaran"]);
              $offer=array("id"=>$row["id"],"qty"=>"0","idRequest"=>$row["idRequest"],"idPenawar"=>$row["idPenawar"],"tglOffer"=>$newDate,"hargaPenawaran"=>$newPrice,"valueHarga"=>$row["hargaPenawaran"],"tglPulang"=>$newDate1,"idKota"=>$row["idKota"],"kota"=>$row["kota"],"hargaOngkir"=>$row["hargaOngkir"],"jenisOngkir"=>$row["jenisOngkir"],"status"=>$row["status"]);
              array_push($offers,$offer);
          }

      // headers to tell that result is JSON
      header('Content-type: application/json');
      echo json_encode($offers);
    }else{
      $sql4 = "SELECT * FROM offerRequest WHERE idRequest = '$idRequest' AND status = '4' ORDER BY id DESC";
      $result4 = mysqli_query($conn,$sql4);

      $offers=array();
      if(mysqli_num_rows($result4) > 0)
      {
        while($row = $result4->fetch_assoc()) {
                $newDate = date("d F Y", strtotime($row["tglOffer"]));
                $newDate1 = date("d F Y", strtotime($row["tglPulang"]));
                $newPrice = number_format((int)$row["hargaPenawaran"]);
                $offer=array("id"=>$row["id"],"qty"=>"0","idRequest"=>$row["idRequest"],"idPenawar"=>$row["idPenawar"],"tglOffer"=>$newDate,"hargaPenawaran"=>$newPrice,"valueHarga"=>$row["hargaPenawaran"],"tglPulang"=>$newDate1,"idKota"=>$row["idKota"],"kota"=>$row["kota"],"hargaOngkir"=>$row["hargaOngkir"],"jenisOngkir"=>$row["jenisOngkir"],"status"=>$row["status"]);
                array_push($offers,$offer);
            }

        // headers to tell that result is JSON
        header('Content-type: application/json');
        echo json_encode($offers);
      }else{
        $sql3 = "SELECT * FROM offerRequest WHERE idRequest = '$idRequest' AND status = '3' ORDER BY id DESC";
        $result3 = mysqli_query($conn,$sql3);

        $offers=array();
        if(mysqli_num_rows($result3) > 0)
        {
          while($row = $result3->fetch_assoc()) {
                  $newDate = date("d F Y", strtotime($row["tglOffer"]));
                  $newDate1 = date("d F Y", strtotime($row["tglPulang"]));
                  $newPrice = number_format((int)$row["hargaPenawaran"]);
                  $offer=array("id"=>$row["id"],"qty"=>"0","idRequest"=>$row["idRequest"],"idPenawar"=>$row["idPenawar"],"tglOffer"=>$newDate,"hargaPenawaran"=>$newPrice,"valueHarga"=>$row["hargaPenawaran"],"tglPulang"=>$newDate1,"idKota"=>$row["idKota"],"kota"=>$row["kota"],"hargaOngkir"=>$row["hargaOngkir"],"jenisOngkir"=>$row["jenisOngkir"],"status"=>$row["status"]);
                  array_push($offers,$offer);
              }

          // headers to tell that result is JSON
          header('Content-type: application/json');
          echo json_encode($offers);
        }else{
          $sql1 = "SELECT * FROM offerRequest WHERE idRequest = '$idRequest' AND status = '2' ORDER BY id DESC";
          $result1 = mysqli_query($conn,$sql1);

          $offers=array();
          if(mysqli_num_rows($result1) > 0)
          {
            while($row = $result1->fetch_assoc()) {
                    $newDate = date("d F Y", strtotime($row["tglOffer"]));
                    $newDate1 = date("d F Y", strtotime($row["tglPulang"]));
                    $newPrice = number_format((int)$row["hargaPenawaran"]);
                    $offer=array("id"=>$row["id"],"qty"=>"0","idRequest"=>$row["idRequest"],"idPenawar"=>$row["idPenawar"],"tglOffer"=>$newDate,"hargaPenawaran"=>$newPrice,"valueHarga"=>$row["hargaPenawaran"],"tglPulang"=>$newDate1,"idKota"=>$row["idKota"],"kota"=>$row["kota"],"hargaOngkir"=>$row["hargaOngkir"],"jenisOngkir"=>$row["jenisOngkir"],"status"=>$row["status"]);
                    array_push($offers,$offer);
                }

            // headers to tell that result is JSON
            header('Content-type: application/json');
            echo json_encode($offers);
          }else{
            $sql = "SELECT * FROM offerRequest WHERE idRequest = '$idRequest' AND status = '1' ORDER BY id DESC";
            $result = mysqli_query($conn,$sql);

            $offers=array();
            if(mysqli_num_rows($result) > 0)
            {

              while($row = $result->fetch_assoc()) {
                      $newDate = date("d F Y", strtotime($row["tglOffer"]));
                      $newDate1 = date("d F Y", strtotime($row["tglPulang"]));
                      $newPrice = number_format((int)$row["hargaPenawaran"]);
                      $offer=array("id"=>$row["id"],"qty"=>"0","idRequest"=>$row["idRequest"],"idPenawar"=>$row["idPenawar"],"tglOffer"=>$newDate,"hargaPenawaran"=>$newPrice,"valueHarga"=>$row["hargaPenawaran"],"tglPulang"=>$newDate1,"idKota"=>$row["idKota"],"kota"=>$row["kota"],"hargaOngkir"=>$row["hargaOngkir"],"jenisOngkir"=>$row["jenisOngkir"],"status"=>$row["status"]);
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
        }
      }
    }
  }
}

?>
