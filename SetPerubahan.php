<?php
include("DbConnect.php");

  //upload gambar di xcode pake post
if(isset($_GET["action"]))
{
  $action = $_GET["action"];
 if($action == "confirm"){
      //get harus diisi semua kalau tidak alamofire tidak mau ambil respon
        $idOffer = $_GET['idOffer'];
        $idRequest = $_GET['idRequest'];
        $idPenawar = $_GET['idPenawar'];
        $idPemilik = $_GET['idPemilik'];
        $harga = $_GET['harga'];
        $today = date("Y-m-d");
        $saldo = $_GET['saldo'];
        $sql2 = "UPDATE offerRequest SET status='2', hargaPenawaran = '$harga' WHERE id='$idOffer'";
        $result2 = mysqli_query($conn,$sql2);
        if($result2)
        {
          $sql4 = "UPDATE user SET saldo='$saldo' WHERE email='$idPemilik'";
          $result4 = mysqli_query($conn,$sql4);
          if($result4)
          {
            $sql2 = "INSERT INTO notification(name,tanggal,jenis,idTujuan,email) VALUES ('Perubahan Harga Diterima', '$today','request','$idRequest','$idPenawar')";
            $result2 = mysqli_query($conn,$sql2);
            $response = array('success' => 1,
                     'message' => 'perubahan harga sukses');
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

      // headers to tell that result is JSON
      header('Content-type: application/json');
      echo json_encode($response);

    }
}

else
{
  $response = array(
           'message' => 'Tidak Bisa');
           echo json_encode($response);
}
?>
