<?php

include "includes/conn.php";

if(!isset($_GET['id'])){
  echo "error <br /> <a href='admin.php'>go back</a>";
}else{
  $id = $_GET['id'];
  $sql = "SELECT * FROM foodtable WHERE food_id = $id";
  $query = mysqli_query($conn, $sql);



  while($row = mysqli_fetch_array($query)){
    $food_id = $row['food_id'];
    $food_img = $row['food_img'];
    $food_name = $row['food_name'];
    $food_type = $row['food_type'];
    $food_desc = $row['food_desc'];
    $food_price = $row['food_price'];


    ?>
  <form action="editprocess.php" method="POST" enctype="multipart/form-data">
    <table>
      <tr>
        <td>ID: </td>
        <td><input type="text" value="<?php echo $food_id; ?>" name="id2"/></td>
      </tr>
      <tr>
        <td>Image: </td>
        <td><input type="file" value="<?php echo $food_img; ?>" name="file"/></td>
      </tr>
      <tr>
        <td>Name: </td>
        <td><input type="text" value="<?php echo $food_name; ?>" name="upd_name"/></td>
      </tr>
      <tr>
        <td>Type: </td>
        <td><input type="text" value="<?php echo $food_type; ?>" name="upd_type"/></td>
      </tr>
      <tr>
        <td>Description: </td>
        <td><input type="text" value="<?php echo $food_desc; ?>" name="upd_desc"/></td>
      </tr>
      <tr>
        <td>Price: </td>
        <td><input type="text" value="<?php echo $food_price; ?>" name="upd_price"/></td>
      </tr>
      <tr>
        <td><input type="submit" value="Apply changes" name="submit"/></td>
        <td>
          <a href="edit.php?deleteid=<?php echo $food_id; ?>&id='deleted'">- Delete -</a>
        </td>

      </tr>
    </table>
  </form>

  <?php
  }
  ?>
  <hr />
<?php
}

if(isset($_GET['deleteid'])){
  $id = $_GET['deleteid'];
  $sqlquery2 = mysqli_query($conn, "DELETE FROM foodtable WHERE food_id = $id");
  echo "Item deleted<hr /> <a href='admin.php'>Click here to go to Admin homepage</a>";
}else{
  echo " - ";
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
