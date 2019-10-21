<?php

include "../includes/conn.php";

if(isset($_POST['submitbtn'])){

  $choice = $_POST['choice'];
  $name = $_POST['name'];
  $type = $_POST['type'];
  $desc = $_POST['desc'];
  $price = $_POST['price'];

  if($choice == 'food'){
    $tablename = 'foodtable';
  }elseif ($choice == 'stuff') {
    $tablename = 'stufftable';
  }else{
    echo "error - food or stuff not set";
  }

  $randStr = generateRandomString();
  $imageFile = $_FILES['file']['name'];
  $temp = $_FILES['file']['tmp_name'];

  $randImgName = $choice."_".$randStr."_".$imageFile;


  move_uploaded_file($temp, "../images/".$randImgName);
  $imgUrl = "http://localhost/projects/restaurant/images/$randImgName";
  mysqli_query($conn, "INSERT INTO $tablename VALUES
    (NULL, '$imgUrl', '$name', '$type', '$desc', '$price')
  ");

  echo $imageFile." - UPLOADED";
  header("refresh: 1; URL = ../admin.php");

} else{
  echo "Error bruh";
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>
