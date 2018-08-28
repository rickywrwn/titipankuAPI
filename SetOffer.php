<?php
include("DbConnect.php");

  //upload gambar di xcode pake post
if(isset($_GET["action"]))
{
  $action = $_GET["action"];

    if($action == "decline"){
      //get harus diisi semua kalau tidak alamofire tidak mau ambil respon
        $idOffer = $_GET['idOffer'];
        $idRequest = $_GET['idRequest'];
        $idPenawar = $_GET['idPenawar'];
        $today = date("Y-m-d");
        $sql1 = "UPDATE offerRequest SET status='0' WHERE id='$idOffer'";
        $result1 = mysqli_query($conn,$sql1);
        if($result1)
        {
          $sql2 = "INSERT INTO notification(name,tanggal,jenis,idTujuan,email) VALUES ('Penawaran Anda Ditolak', '$today','request','$idRequest','$idPenawar')";
          $result2 = mysqli_query($conn,$sql2);
          if($result2)
          {
              $response = array('success' => 1,
                       'message' => 'Tolak offer Sukses');
          }
          else
          {
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
    }else if($action == "accept"){
      //get harus diisi semua kalau tidak alamofire tidak mau ambil respon
        $idOffer = $_GET['idOffer'];
        $idRequest = $_GET['idRequest'];
        $hargaOngkir = $_GET['hargaOngkir'];
        $jenisOngkir = $_GET['jenisOngkir'];
        $idPenawar = $_GET['idPenawar'];
        $saldo = $_GET['saldo'];
        $email = $_GET['email'];
        $jumlah = $_GET['jumlah'];
        $today = date("Y-m-d");

        $sql5 = "INSERT INTO topup(email,jumlah,saldo,status,orderId,tglTopup,jenis,rekening) VALUES ('$email', '$jumlah','$saldo','sukses','$idOffer','$today','Pembayaran Request','')";
        $result5 = mysqli_query($conn,$sql5);
        if($result5)
        {
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
                $sql1 = "UPDATE offerRequest SET status='0' WHERE status != '2' AND idRequest='$idRequest'";
                $result1 = mysqli_query($conn,$sql1);
                if($result1)
                {
                  $sql2 = "INSERT INTO notification(name,tanggal,jenis,idTujuan,email) VALUES ('Penawaran Anda Diterima', '$today','request','$idRequest','$idPenawar')";
                  $result2 = mysqli_query($conn,$sql2);
                  if($result2)
                  {
                    $response = array('success' => 1,
                           'message' => 'Terima offer Sukses');
                  }
                  else
                  {
                      $response = array('success' => 0,
                               'message' => mysqli_error($conn));
                  }
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
        $today = date("Y-m-d");
        $sql2 = "UPDATE offerRequest SET status='3' WHERE id='$idOffer'";
        $result2 = mysqli_query($conn,$sql2);
        if($result2)
        {
          $sql4 = "UPDATE postRequest SET status='3' WHERE id='$idRequest'";
          $result4 = mysqli_query($conn,$sql4);
          if($result4)
          {
            $sql2 = "INSERT INTO notification(name,tanggal,jenis,idTujuan,email) VALUES ('Request Anda Sudah Dibelikan', '$today','request','$idRequest','$email')";
            $result2 = mysqli_query($conn,$sql2);
            if($result2)
            {
              $response = array('success' => 1,
                       'message' => 'Barang Dibelikan Sukses');
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
        $today = date("Y-m-d");
        $sql2 = "UPDATE offerRequest SET status='4' WHERE id='$idOffer'";
        $result2 = mysqli_query($conn,$sql2);
        if($result2)
        {
          $sql4 = "UPDATE postRequest SET status='4',nomorResi='$nomorResi' WHERE id='$idRequest'";
          $result4 = mysqli_query($conn,$sql4);
          if($result4)
          {
            $sql2 = "INSERT INTO notification(name,tanggal,jenis,idTujuan,email) VALUES ('Request Anda Sudah Dikirim', '$today','request','$idRequest','$email')";
            $result2 = mysqli_query($conn,$sql2);
            if($result2)
            {
              $response = array('success' => 1,
                     'message' => 'Pengiriman Barang Sukses');
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
        $jumlah = $_GET['jumlah'];
        $saldo = $_GET['saldo'];
        $idPenawar = $_GET['idPenawar'];
        $today = date("Y-m-d");

        $sql2 = "UPDATE offerRequest SET status='5' WHERE id='$idOffer'";
        $result2 = mysqli_query($conn,$sql2);
        if($result2)
        {
          $sql4 = "UPDATE postRequest SET status='5' WHERE id='$idRequest'";
          $result4 = mysqli_query($conn,$sql4);
          if($result4)
          {
              $sql5 = "INSERT INTO topup(email,jumlah,saldo,status,orderId,tglTopup,jenis,rekening) VALUES ('$idPenawar', '$jumlah','$saldo','sukses','$idOffer','$today','Penerimaan Request','')";
              $result5 = mysqli_query($conn,$sql5);
              if($result5)
              {
                $sql6 = "UPDATE user SET saldo='$saldo' WHERE email='$idPenawar'";
                $result6 = mysqli_query($conn,$sql6);
                if($result6){
                  $sql2 = "INSERT INTO notification(name,tanggal,jenis,idTujuan,email) VALUES ('Request Sudah Diterima oleh Requester', '$today','request','$idRequest','$idPenawar')";
                  $result2 = mysqli_query($conn,$sql2);
                  if($result2)
                  {
                    $response = array('success' => 1,
                             'message' => 'Penerimaan Barang Sukses');
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
              else
              {
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
