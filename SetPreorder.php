<?php
include("DbConnect.php");

  //upload gambar di xcode pake post
if(isset($_GET["action"]))
{
  $action = $_GET["action"];
  $today = date("Y-m-d");

    if($action == "decline"){
      //get harus diisi semua kalau tidak alamofire tidak mau ambil respon
        $idOffer = $_GET['idOffer'];
        $idPreorder = $_GET['idPreorder'];
        $idPembeli = $_GET['idPembeli'];
        $sql1 = "UPDATE offerPreorder SET status='0' WHERE id='$idOffer'";
        $result1 = mysqli_query($conn,$sql1);
        if($result1)
        {
          $sql2 = "INSERT INTO notification(name,tanggal,jenis,idTujuan,email) VALUES ('Pembelian Anda Ditolak', '$today','preorder','$idPreorder','$idPembeli')";
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
        $idPreorder = $_GET['idPreorder'];
        $idPembeli = $_GET['idPembeli'];
        $sql2 = "UPDATE offerPreorder SET status='2' WHERE id='$idOffer'";
        $result2 = mysqli_query($conn,$sql2);
        if($result2)
        {
          $sql2 = "INSERT INTO notification(name,tanggal,jenis,idTujuan,email) VALUES ('Pembelian Anda Diterima', '$today','preorder','$idPreorder','$idPembeli')";
          $result2 = mysqli_query($conn,$sql2);
          if($result2)
          {

            $response = array('success' => 1,
                     'message' => 'Terima Pembelian Sukses');
          }
          else
          {
              $response = array('success' => 0,
                       'message' => mysqli_error($conn));
          }
        }
        else
        {
            $response = array('success' => 2,
                     'message' => mysqli_error($conn));
        }

      // headers to tell that result is JSON
      header('Content-type: application/json');
      echo json_encode($response);

    }else if($action == "confirm"){

        $idOffer = $_GET['idOffer'];
        $idRequest = $_GET['idRequest'];
      if ($action2 == "upload") {

        //get max id untuk nama gambar yg diupload
        $target_dir = "/home/titq2258/public_html/uploads/";
        $target_file = $target_dir . basename($_FILES["userfile"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
            $check = getimagesize($_FILES["userfile"]["tmp_name"]);
            if($check !== false) {
                $response =  "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                $response =  "File is not an image.";
                $uploadOk = 0;
            }


        if (move_uploaded_file($_FILES["userfile"]["tmp_name"], $target_dir.'nota' . $idOffer.'.'.$imageFileType  )) {
                $response = "The file ". basename( $_FILES["userfile"]["name"]). " has been uploaded.";

            } else {
                $response = "Sorry, there was an error uploading your file.";
            }

            // headers to tell that result is JSON
            header('Content-type: application/json');
            echo json_encode($response);
      }else{
        $idPembeli = $_GET['idPembeli'];
      //get harus diisi semua kalau tidak alamofire tidak mau ambil respon
        $sql2 = "UPDATE offerPreorder SET status='3' WHERE id='$idOffer'";
        $result2 = mysqli_query($conn,$sql2);
        if($result2)
        {
          $sql2 = "INSERT INTO notification(name,tanggal,jenis,idTujuan,email) VALUES ('Barang Anda Sudah Dibelikan', '$today','preorder','$idRequest','$idPembeli')";
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
    }else if($action == "kirim"){
      //get harus diisi semua kalau tidak alamofire tidak mau ambil respon
        $idOffer = $_GET['idOffer'];
        $idRequest = $_GET['idRequest'];
        $nomorResi = $_GET['nomorResi'];
        $idPembeli = $_GET['idPembeli'];
        $sql2 = "UPDATE offerPreorder SET status='4',nomorResi='$nomorResi' WHERE id='$idOffer'";
        $result2 = mysqli_query($conn,$sql2);
        if($result2)
        {
          $sql2 = "INSERT INTO notification(name,tanggal,jenis,idTujuan,email) VALUES ('Barang Anda Sudah Dikirim', '$today','preorder','$idRequest','$idPembeli')";
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
        $idPemilik = $_GET['idPemilik'];
        $sql2 = "UPDATE offerPreorder SET status='5' WHERE id='$idOffer'";
        $result2 = mysqli_query($conn,$sql2);
        if($result2)
        {
          $sql2 = "INSERT INTO notification(name,tanggal,jenis,idTujuan,email) VALUES ('Barang Sudah Diterima', '$today','preorder','$idRequest','$idPemilik')";
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
