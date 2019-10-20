<?php
include "includes/conn.php";

if(isset($_POST['submit'])){
  $upd_id = $_POST['id2'];
  $upd_name = $_POST['upd_name'];
  $upd_type = $_POST['upd_type'];
  $upd_desc = $_POST['upd_desc'];
  $upd_price = $_POST['upd_price'];

  echo $upd_id." ".$upd_name." ". $upd_type ." ".$upd_desc." ". $upd_price;
?>


<?php

  
  $randStr = generateRandomString();
  $upd_file = $_FILES['file']['name'];
  $temp = $_FILES['file']['tmp_name'];

  $randImgName = $randStr."_".$upd_file;


  move_uploaded_file($temp, "./images/".$randImgName);
  $imgUrl = "http://localhost/projects/restaurant/images/$randImgName";


  mysqli_query($conn,
    "UPDATE foodtable SET

    food_img = '$imgUrl',
    food_name = '$upd_name',
    food_type = '$upd_type',
    food_desc = '$upd_desc',
    food_price = '$upd_price'

    WHERE food_id = '$upd_id';
    ");

    echo "Table sucessfully updated <br /> Redirecting to admin homepage...";
    header("refresh: 3; URL = admin.php");



}else{
  echo "Error <br />";
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
