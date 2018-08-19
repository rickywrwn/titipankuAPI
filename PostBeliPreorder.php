<?php
if(isset($_GET["action"]))
{
  include("DbConnect.php");

  $action = $_GET["action"];

if($action == "insert"){

    $email = $_GET['email'];
    $idPreorder = $_GET["idPreorder"];
    $qty = $_GET["qty"];
    $qtyNow = $_GET["qtyNow"];
    $kota = $_GET["kota"];
    $idKota = $_GET["idKota"];
    $hargaOngkir = $_GET["hargaOngkir"];
    $pengiriman = $_GET["pengiriman"];
    $saldo = $_GET["saldo"];
    $jumlah = $_GET['jumlah'];
    $today = date("Y-m-d");

    $sql5 = "INSERT INTO topup(email,jumlah,saldo,status,orderId,tglTopup,jenis,rekening) VALUES ('$email', '$jumlah','$saldo','sukses','$idPreorder','$today','Pembayaran Preorder','')";
    $result5 = mysqli_query($conn,$sql5);
    if($result5)
    {
      $sql1 = "INSERT INTO offerPreorder(idPreorder,idPembeli,tglBeli,qty,kota,idkota,hargaOngkir,pengiriman,nomorResi,jenisOngkir,status) VALUES ('$idPreorder', '$email', '$today','$qty','$kota','$idKota','$hargaOngkir','$pengiriman','0','-','1')";
      $result1 = mysqli_query($conn,$sql1);
      if($result1)
      {
        $sql3 = "UPDATE user SET saldo='$saldo' WHERE email='$email'";
        $result3 = mysqli_query($conn,$sql3);
        if($result3)
        {
          $sql4 = "UPDATE postPreorder SET qty='$qtyNow' WHERE id='$idPreorder'";
          $result4 = mysqli_query($conn,$sql4);
          if($result4)
          {
            $response = array('success' => 1,
                     'message' => 'Beli Preorder Sukses');

          }else{
              $response = array('success' => 0,
                       'message' => mysqli_error($conn));
          }
        }else{
            $response = array('success' => 0,
                     'message' => mysqli_error($conn));
        }
      }
      else
      {
          $response = array('success' => 0,
                   'message' => mysqli_error($conn));
      }
    }else
    {
        $response = array('success' => 0,
                 'message' => mysqli_error($conn));
    }
  }

  // headers to tell that result is JSON
  header('Content-type: application/json');
  echo json_encode($response);
}
else
{
  $response = array(
           'message' => 'Tidak Bisa');
           echo json_encode($response);
}
?>
