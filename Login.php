<?php
if(isset($_GET["action"]))
{
  include("DbConnect.php");

  $action = $_GET["action"];
  $email = $_GET['email'];

  if($action == "" || $action == "")
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

  }else if($action == "facebook" ){
    //$password = md5($_GET["password"]);


    $sql = "SELECT * FROM user WHERE email = '$email'";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result) > 0)
    {
      $response = array('success' => 1,
               'message' => 'Login dengan facebook Berhasil');
    }else{

      $name = $_GET['name'];
      $today = date("Y-m-d");

      $pass = md5('pass');
      $sql1 = "INSERT INTO user(email,password,name,bio,tanggalDaftar,status) VALUES ('$email', '$pass', '$name', '', '$today','1')";
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

  }
  else if($action == "google" ){
    //$password = md5($_GET["password"]);


    $sql = "SELECT * FROM user WHERE email = '$email'";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result) > 0)
    {
      $response = array('success' => 1,
               'message' => 'Login dengan google Berhasil');
    }else{

      $name = $_GET['name'];
      $today = date("Y-m-d");

      $pass = md5('pass');
      $sql1 = "INSERT INTO user(email,password,name,bio,tanggalDaftar,status) VALUES ('$email', '$pass', '$name', '', '$today','1')";
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
      $pass = md5($password);
      $sql1 = "INSERT INTO user(email,password,name,bio,tanggalDaftar,status) VALUES ('$email', '$pass', '$name', '', '$today','1')";
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

    $pass = md5($password);
    $sql = "SELECT * FROM user WHERE email = '$email'";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result) > 0)
    {
      //Berarti Username Ada
      $sql = "SELECT * FROM user WHERE email = '$email' AND password = '$pass' AND status = '1' ";
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
