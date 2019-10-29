<?php
include "includes/conn.php";

if(isset($_POST['submit'])){
  $item_id = $_GET["item_id"];
  $item_img = $_GET["item_img"];
  $item_name = $_GET["item_name"];
  $item_type = $_GET["item_type"];
  $item_desc = $_GET["item_desc"];
  $item_price = $_GET["item_price"];
  $tablename = $_GET["tablename"];



  $upd_id = $_POST['id2'];
  $upd_name = $_POST['upd_name'];
  $upd_type = $_POST['upd_type'];
  $upd_desc = $_POST['upd_desc'];
  $upd_price = $_POST['upd_price'];

  $crntImg = $_POST['currentImg'];
  //echo "<hr /><hr />.$crntImg.<hr /><hr />";
  //TODO: ako se promjeni sve osim slike, ostane slika koja je bila prije

  //ako je admin odabrao novu sliku
  if(!empty($_FILES["file"]["name"])){
    $randStr = generateRandomString();
    $upd_file = $_FILES['file']['name'];
    $temp = $_FILES['file']['tmp_name'];

    $randImgName = "item_upd_".$item_id."_".$randStr."_".$upd_file;


    move_uploaded_file($temp, "./images/".$randImgName);
    $imgUrl = "images/$randImgName";

    echo "<br /><br />Image changed: YES <br /><br />";


    //: ovo je debugger
    echo "Tablica: ".$tablename."<hr />";
    echo "<br /><br />".$item_id."<br />".$crntImg."<br />".$item_name."<br />".$item_type."<br />".$item_desc."<br />".$item_price."<br /><br />";

    echo "SE MJENJA S OVIM<br /><br />";

    echo $upd_id."<br /> ".$imgUrl."<br />".$upd_name."<br /> ". $upd_type ."<br />".$upd_desc."<br />". $upd_price."<br /><br />";


  }else if(empty($_FILES["file"]["name"])){ //ako nije odabrao novu sliku
    $imgUrl = $item_img;
    echo "<br />Image changed: NO <br /><br />";

    //: ovo je debugger
    echo "Tablica: ".$tablename."<hr />";
    echo "<br /><br />".$item_id."<br />".$crntImg."<br />".$item_name."<br />".$item_type."<br />".$item_desc."<br />".$item_price."<br /><br />";

    echo "SE MJENJA S OVIM<br /><br />";

    echo $upd_id."<br /> ".$crntImg."<br />".$upd_name."<br /> ". $upd_type ."<br />".$upd_desc."<br />". $upd_price."<br /><br />";
  }else{
    echo "error idk";
  }






  if($tablename == 'foodtable'){
    /*
    $item_id = 'food_id';
    $item_img = 'food_img';
    $item_name = 'food_foodname';
    $item_type = 'food_type';
    $item_desc = 'food_desc';
    $item_price = 'food_price';
    */
    mysqli_query($conn,
      "UPDATE $tablename SET

      food_img = '$imgUrl',
      food_name = '$upd_name',
      food_type= '$upd_type',
      food_desc= '$upd_desc',
      food_price= '$upd_price'

      WHERE food_id = '$upd_id';
      ");

      echo $tablename." table sucessfully updated <br /> <a href='admin.php'>Click here to go to admin home page</a>";
      //header("refresh: 3; URL = admin.php");

  }else if($tablename == 'stufftable'){
    /*
    $item_id = 'stuff_id';
    $item_img = 'stuff_img';
    $item_name = 'stuff_foodname';
    $item_type = 'stuff_type';
    $item_desc = 'stuff_desc';
    $item_price = 'stuff_price';
    */

    mysqli_query($conn,
      "UPDATE $tablename SET

      stuff_img = '$imgUrl',
      stuff_name = '$upd_name',
      stuff_type= '$upd_type',
      stuff_desc= '$upd_desc',
      stuff_price= '$upd_price'

      WHERE stuff_id = '$upd_id';
      ");

      echo $tablename." table sucessfully updated<br /> <br /> <a href='admin.php'>Click here to go to admin home page</a>";
      //header("refresh: 3; URL = admin.php");
  }else{
    echo "error - tablename not set";
  }





}else if(isset($_GET['deleteid'])){
  $delId = $_GET['deleteid'];
  $fromTable = $_GET['fromtable'];
  $itemImg = $_GET['itemImg'];
  $itemName = $_GET['itemName'];
  $itemType = $_GET['itemType'];
  $itemDesc = $_GET['itemDesc'];
  $itemPrice = $_GET['itemPrice'];

  echo "Item to be deleted <br /><br />  ID: ".$delId." <br /> From table: ".$fromTable. "<br /> Img: ".$itemImg."<br />Name: ".$itemName."<br />Type: ".$itemType."<br />Desc: ".$itemDesc."<br />Price: ".$itemPrice."<br /><hr />";


  ?>
  <a href="scripts/deleteitem.php?delete_item&delId=<?php  echo $delId?>&fromTable=<?php  echo $fromTable?>&itemImg=<?php  echo $itemImg?>&itemName=<?php  echo $itemName?>&itemType=<?php  echo $itemType?>&itemDesc=<?php  echo $itemDesc?>&itemPrice=<?php  echo $itemPrice?>"> DELETE ITEM </a>
  <?php
  echo "- - -";
  echo "<button onclick='history.go(-1);'> Cancel </button>";

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
