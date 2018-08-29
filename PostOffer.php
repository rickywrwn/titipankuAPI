<?php
  include("DbConnect.php");

  //upload gambar di xcode pake post
if(isset($_GET["action"]))
{
  $action = $_GET["action"];


  if($action == "insert"){

    //get harus diisi semua kalau tidak alamofire tidak mau ambil respon
      $idTrip = $_GET['idTrip'];
      $idRequest = $_GET['idRequest'];
      $idPenawar = $_GET['idPenawar'];
      $idPemilik = $_GET['idPemilik'];
      $email = $_GET['email'];
      $hargaPenawaran = $_GET['hargaPenawaran'];
      $tglPulang = $_GET['tglPulang'];
      $provinsi = $_GET['provinsi'];
      $kota = $_GET['kota'];
      $idKota = $_GET['idKota'];
      $today = date("Y-m-d");
      $timestamp = strtotime($tglPulang);
      $back = date("Y-m-d H:i:s", $timestamp);

      $sql1 = "INSERT INTO offerRequest(idRequest,idPenawar,idPemilik,tglOffer,hargaPenawaran,tglPulang,provinsi,kota,idKota,hargaOngkir,jenisOngkir,status) VALUES ('$idRequest', '$idPenawar', '$idPemilik', '$today' , '$hargaPenawaran', '$back', '$provinsi', '$kota' ,'$idKota',0,'' ,'1')";
      $result1 = mysqli_query($conn,$sql1);
      if($result1)
      {
        $sql2 = "INSERT INTO notification(name,tanggal,jenis,idTujuan,email) VALUES ('Anda Mendapat Penawaran Baru', '$today','request','$idRequest','$email')";
        $result2 = mysqli_query($conn,$sql2);
        if($result2)
        {
          $sql2 = "INSERT INTO tripRequest(idTrip,idRequest,email,tanggal) VALUES ('$idTrip','$idRequest','$idPenawar','$today')";
          $result2 = mysqli_query($conn,$sql2);
          if($result2)
          {
            $response = array('success' => 1,
                     'message' => 'Post offer Sukses');
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
      }
      else
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
