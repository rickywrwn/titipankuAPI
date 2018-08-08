<?php
include("DbConnect.php");

  //upload gambar di xcode pake post
if(isset($_GET["action"]))
{
  $action = $_GET["action"];

    if($action == "decline"){
      //get harus diisi semua kalau tidak alamofire tidak mau ambil respon
        $idOffer = $_GET['idOffer'];
        $sql1 = "UPDATE offerRequest SET status='0' WHERE id='$idOffer'";
        $result1 = mysqli_query($conn,$sql1);
        if($result1)
        {
            $response = array('success' => 1,
                     'message' => 'Tolak offer Sukses');
        }
        else
        {
            $response = array('success' => 0,
                     'message' => mysqli_error($conn));
        }

      // headers to tell that result is JSON
      header('Content-type: application/json');
      echo json_encode($response);
    }else if($action == "accept"){
      //get harus diisi semua kalau tidak alamofire tidak mau ambil respon
        $idOffer = $_GET['idOffer'];
        $idRequest = $_GET['idRequest'];
        $hargaOngkir = $_GET['hargaOngkir'];
        $jenisOngkir = $_GET['jenisOngkir'];
        $idPenawar = $_GET['idPenawar'];
        $saldo = $_GET['saldo'];
        $email = $_GET['email'];
        $sql2 = "UPDATE offerRequest SET status='2', hargaOngkir='$hargaOngkir', jenisOngkir='$jenisOngkir' WHERE id='$idOffer'";
        $result2 = mysqli_query($conn,$sql2);
        if($result2)
        {
          $sql3 = "UPDATE user SET saldo='$saldo' WHERE email='$email'";
          $result3 = mysqli_query($conn,$sql3);
          if($result3)
          {
            $sql4 = "UPDATE postRequest SET status='2',idPenawar='$idPenawar' WHERE id='$idRequest'";
            $result4 = mysqli_query($conn,$sql4);
            if($result4)
            {
              $sql1 = "UPDATE offerRequest SET status='0' WHERE status != '2'";
              $result1 = mysqli_query($conn,$sql1);
              if($result1)
              {
                $response = array('success' => 1,
                         'message' => 'Terima offer Sukses');
              }
              else
              {
                  $response = array('success' => 0,
                           'message' => mysqli_error($conn));
              }

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

      // headers to tell that result is JSON
      header('Content-type: application/json');
      echo json_encode($response);

    }else if($action == "confirm"){
      //get harus diisi semua kalau tidak alamofire tidak mau ambil respon
        $idOffer = $_GET['idOffer'];
        $idRequest = $_GET['idRequest'];
        $idPenawar = $_GET['idPenawar'];
        $email = $_GET['email'];
        $sql2 = "UPDATE offerRequest SET status='3' WHERE id='$idOffer'";
        $result2 = mysqli_query($conn,$sql2);
        if($result2)
        {
          $sql4 = "UPDATE postRequest SET status='3' WHERE id='$idRequest'";
          $result4 = mysqli_query($conn,$sql4);
          if($result4)
          {
            $response = array('success' => 1,
                     'message' => 'Barang Dibelikan Sukses');
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

    }else if($action == "kirim"){
      //get harus diisi semua kalau tidak alamofire tidak mau ambil respon
        $idOffer = $_GET['idOffer'];
        $idRequest = $_GET['idRequest'];
        $idPenawar = $_GET['idPenawar'];
        $nomorResi = $_GET['nomorResi'];
        $email = $_GET['email'];
        $sql2 = "UPDATE offerRequest SET status='4' WHERE id='$idOffer'";
        $result2 = mysqli_query($conn,$sql2);
        if($result2)
        {
          $sql4 = "UPDATE postRequest SET status='4',nomorResi='$nomorResi' WHERE id='$idRequest'";
          $result4 = mysqli_query($conn,$sql4);
          if($result4)
          {
            $response = array('success' => 1,
                     'message' => 'Pengiriman Barang Sukses');
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

    }else if($action == "terima"){
      //get harus diisi semua kalau tidak alamofire tidak mau ambil respon
        $idOffer = $_GET['idOffer'];
        $idRequest = $_GET['idRequest'];
        $email = $_GET['email'];
        $sql2 = "UPDATE offerRequest SET status='5' WHERE id='$idOffer'";
        $result2 = mysqli_query($conn,$sql2);
        if($result2)
        {
          $sql4 = "UPDATE postRequest SET status='5' WHERE id='$idRequest'";
          $result4 = mysqli_query($conn,$sql4);
          if($result4)
          {
            $response = array('success' => 1,
                     'message' => 'Penerimaan Barang Sukses');
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
    else if($action == "cancel"){
      //get harus diisi semua kalau tidak alamofire tidak mau ambil respon
        $idOffer = $_GET['idOffer'];
        $sql1 = "UPDATE offerRequest SET status='0' WHERE id='$idOffer'";
        $result1 = mysqli_query($conn,$sql1);
        if($result1)
        {
            $response = array('success' => 1,
                     'message' => 'Cancel offer Sukses');
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
