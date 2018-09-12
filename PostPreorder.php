<?php
include("DbConnect.php");

if(isset($_POST["action"]))
{
  date_default_timezone_set("Asia/Jakarta");

  $action = $_POST["action"];
  $action2 = $_POST["action2"];
  $email = $_POST['email'];

  if($action == "insert"){

    if ($action2 == "upload") {
      //get max id untuk nama gambar yg diupload
      $max = "SELECT MAX(id) AS max_id FROM postPreorder";
      $max1 =  mysqli_query($conn, $max);
      $row = mysqli_fetch_assoc($max1);
      $max_id=$row['max_id']; //max tidak perlu ditambah 1 karena sdh terinsert duluan

      $target_dir = "/home/titq2258/public_html/uploads/";
    //$target_dir = "uploadsPreorder/";
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


      if (move_uploaded_file($_FILES["userfile"]["tmp_name"], $target_dir.'p' .$max_id.'.'.$imageFileType  )) {
              $response = "The file ". basename( $_FILES["userfile"]["name"]). " has been uploaded.";

          } else {
              $response = "Sorry, there was an error uploading your file.";
          }

          // headers to tell that result is JSON
          header('Content-type: application/json');
          echo json_encode($response);
    }else{

      //get max id untuk nama gambar yg diupload
      $max = "SELECT MAX(id) AS max_id FROM postPreorder";
      $max1 =  mysqli_query($conn, $max);
      $row = mysqli_fetch_assoc($max1);
      $max_id=$row['max_id'];
      $str_max = strval($max_id+1);//karena max blm termasuk yg diinsert
      $imgMax = 'p' . $str_max . '.jpg';

      //get harus diisi semua kalau tidak alamofire tidak mau ambil respon
        $name = $_POST['name'];
        $desc = $_POST['description'];
        $category = $_POST['category'];
        $country = $_POST['country'];
        $kota = $_POST['kota'];
        $price = $_POST['price'];
        $url = $_POST['url'];
        $qty = $_POST['qty'];
        $berat = $_POST['berat'];
        $deadline = $_POST['deadline'];
        $idKota = $_POST['idKota'];
        $provinsi = $_POST['provinsi'];
        $batasWaktu = $_POST['batasWaktu'];
        $cdText = $_POST['countdownText'];
        $cdValue = $_POST['countdownValue'];
        $brand = $_POST['brand'];
        $today = date("Y-m-d");
        $time = date("Y-m-d H:i:s", time() + $cdValue);

        $sql1 = "INSERT INTO postPreorder(email,name,description,category,country,kotaKirim,price,imageName,url,qty,berat,deadline,idKota,provinsi,batasWaktu,cdText,cdValue,brand,tglPost,status) VALUES ('$email', '$name', '$desc', '$category', '$country', '$kota', '$price', '$imgMax', '$url', '$qty', '$berat', '$deadline', '$idKota', '$provinsi', '$batasWaktu', '$cdText', '$time','$brand', '$today', '1')";
        $result1 = mysqli_query($conn,$sql1);
        if($result1)
        {
            $response = array('success' => 1,
                     'message' => 'Post Preorder Sukses');
        }
        else
        {
            $response = array('success' => 0,
                     //'message' => mysqli_error($conn)
                   'message' =>mysqli_error($conn).$price.$url.$qty.$berat.$deadline.$imgMax);
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
