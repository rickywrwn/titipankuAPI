<?php
if(isset($_GET["action"]))
{
  include("DbConnect.php");

  $action = $_GET["action"];
  $email = $_GET['email'];

  if($action == "google" || $action == "facebook")
  {
    $sql1 = "INSERT INTO user(email,password,name) VALUES ('$email','a','b')";
    $result1 = mysqli_query($conn,$sql1);
    if($result1)
      {

        $response = array('success' => 0,
                   'message' => 'Login Sukses');
      }
      else
      {
        $response = array('success' => 0,
                   'message' => 'Login Gagal');
      }

  }else if($action == "register"){

    //$password = md5($_GET["password"]);
    $password = $_GET["password"];
    $name = $_GET["name"];

    $sql = "SELECT * FROM user WHERE email = '$email'";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result) > 0)
    {
      //Berarti Username Ada
      while($row = mysqli_fetch_array($result))
      {
         $response = array('success' => 0,
                   'message' => 'Email Sudah Terdaftar');
      }
    }else{
      $today = date("Y-m-d");
      $sql1 = "INSERT INTO user(email,password,name,bio,tanggalDaftar) VALUES ('$email', '$password', '$name', '', '$today')";
      $result1 = mysqli_query($conn,$sql1);
      if($result1)
      {
          $response = array('success' => 1,
                   'message' => 'Register Sukses');
      }
      else
      {
          $response = array('success' => 0,
                   'message' =>mysqli_error($conn));
      }
    }
  }else if($action == "login"){

    //$password = md5($_GET["password"]);
    $password = $_GET["password"];

    $sql = "SELECT * FROM user WHERE email = '$email'";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result) > 0)
    {
      //Berarti Username Ada
      $sql = "SELECT * FROM user WHERE email = '$email' AND password = '$password' AND status = '1' ";
      $result = mysqli_query($conn,$sql);
      if(mysqli_num_rows($result) > 0)
      {
        $response = array('success' => 1,
                 'message' => 'Login Berhasil');
      }else{
        $response = array('success' => 0,
                 'message' => 'Salah Password atau ID anda Diblokir');
      }
    }else{
      $response = array('success' => 2,
               'message' => 'Email Belum Terdaftar');
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
