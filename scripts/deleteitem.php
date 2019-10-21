<?php
include "../includes/conn.php";

if(!isset($_GET['delete_item'])){
  echo "Error";
}else{
  $delId = $_GET['delId'];
  $fromTable = $_GET['fromTable'];
  $itemImg= $_GET['itemImg'];
  $itemName = $_GET['itemName'];
  $itemType = $_GET['itemType'];
  $itemDesc = $_GET['itemDesc'];
  $itemPrice = $_GET['itemPrice'];



  if($fromTable == "foodtable"){
    $sql = "DELETE FROM foodtable WHERE food_id = '$delId'";
    mysqli_query($conn, $sql);

    echo "Deleted : <br /><br />";
    echo "id: ".$delId." <br /> from table: ".$fromTable."<br /> img: ".$itemImg. " <br /> Name: ".$itemName." <br /> Item type: ".$itemType." <br /> Desc: ".$itemDesc."<br /> price: ".$itemPrice."<br />";
    echo "<br /><br /><a href='../admin.php'>Admin home page</a>";
  }
  else if($fromTable == "stufftable"){
    $sql = "DELETE FROM stufftable WHERE stuff_id = '$delId'";
    mysqli_query($conn, $sql);

    echo "Deleted : <br /><br />";
    echo "id: ".$delId." <br /> from table: ".$fromTable."<br /> img: ".$itemImg. " <br /> Name: ".$itemName." <br /> Item type: ".$itemType." <br /> Desc: ".$itemDesc."<br /> price: ".$itemPrice."<br />";
    echo "<br /><br /><a href='../admin.php'>Admin home page</a>";
  }else{
    echo "Error";
  }



}
?>
