<?php
  include("DbConnect.php");


  if(isset($_POST["action"]))
  {

  //get max id untuk nama gambar yg diupload
  $max = "SELECT MAX(id) AS max_id FROM postPreorder";
  $max1 =  mysqli_query($conn, $max);
  $row = mysqli_fetch_assoc($max1);
  $max_id=$row['max_id']; //max tidak perlu ditambah 1 karena sdh terinsert duluan

  //$target_dir = "/home/titq2258/public_html/uploads/";
  $target_dir = "uploadsPreorder/";
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


  if (move_uploaded_file($_FILES["userfile"]["tmp_name"], $target_dir.$max_id.'.'.$imageFileType  )) {
          $response = "The file ". basename( $_FILES["userfile"]["name"]). " has been uploaded.";

      } else {
          $response = "Sorry, there was an error uploading your file.";
      }

      // headers to tell that result is JSON
      header('Content-type: application/json');
      echo json_encode($response);
}else{
  echo "kosong";
}
?>
