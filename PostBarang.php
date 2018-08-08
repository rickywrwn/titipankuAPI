<?php
  include("DbConnect.php");

  //upload gambar di xcode pake post
if(isset($_POST["action"]))
{
  $action = $_POST["action"];
  $action2 = $_POST["action2"];
  $email = $_POST['email'];

if($action == "insert"){

    if ($action2 == "upload") {

      //get max id untuk nama gambar yg diupload
      $max = "SELECT MAX(id) AS max_id FROM postRequest";
      $max1 =  mysqli_query($conn, $max);
      $row = mysqli_fetch_assoc($max1);
      $max_id=$row['max_id']; //max tidak perlu ditambah 1 karena sdh terinsert duluan

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


      if (move_uploaded_file($_FILES["userfile"]["tmp_name"], $target_dir.'b' . $max_id.'.'.$imageFileType  )) {
              $response = "The file ". basename( $_FILES["userfile"]["name"]). " has been uploaded.";

          } else {
              $response = "Sorry, there was an error uploading your file.";
          }

          // headers to tell that result is JSON
          header('Content-type: application/json');
          echo json_encode($response);
    }else{

      //get max id untuk nama gambar yg diupload
      $max = "SELECT MAX(id) AS max_id FROM postRequest";
      $max1 =  mysqli_query($conn, $max);
      $row = mysqli_fetch_assoc($max1);
      $max_id=$row['max_id'];
      $str_max = strval($max_id+1);//karena max blm termasuk yg diinsert
      $imgMax = 'b' . $str_max . '.jpg';


      //get harus diisi semua kalau tidak alamofire tidak mau ambil respon
        $email = $_POST['email'];
        $name = $_POST['name'];
        $desc = $_POST['description'];
        $category = $_POST['category'];
        $country = $_POST['country'];
        $price = $_POST['price'];
        $url = $_POST['url'];
        $qty = $_POST['qty'];
        $ukuran = $_POST['ukuran'];
        $berat = $_POST['berat'];
        $kotaKirim = $_POST['kotaKirim'];
        $idKota = $_POST['idKota'];
        $provinsi = $_POST['provinsi'];
        $today = date("Y-m-d");
        $sql1 = "INSERT INTO postRequest(email,name,description,category,country,price,imageName,url,qty,ukuran,berat,kotaKirim,idKota,provinsi,tglPost,status) VALUES ('$email', '$name', '$desc', '$category', '$country', '$price', '$imgMax' ,'$url' ,'$qty', '$ukuran', '$berat', '$kotaKirim','$idKota','$provinsi','$today','1')";
        $result1 = mysqli_query($conn,$sql1);
        if($result1)
        {
          $sql2 = "SELECT * FROM masterNegara WHERE nama='$country'";
          $result2 = mysqli_query($conn,$sql2);

          if(mysqli_num_rows($result2) > 0)
          {
            $response = array('success' => 1,
                     'message' => 'Post Barang Sukses');
          }else{

             $sql3 = "INSERT INTO masterNegara(nama) VALUES ('$country')";
             $result3 = mysqli_query($conn,$sql3);
             if($result3)
             {
               $response = array('success' => 1,
                        'message' => 'Post Barang dan negara Sukses');
             }
             else
             {
                 $response = array('success' => 0,
                          'message' => mysqli_error($conn));
             }
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
}
else
{
  $response = array(
           'message' => 'Tidak Bisa');
           echo json_encode($response);
}
?>
