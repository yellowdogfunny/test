<?php

include "includes/conn.php";

if(!isset($_GET['id']) && !isset($_GET['id2'])){
  echo "error <br /> <a href='admin.php'>go back</a>";
}else{

  if(isset($_GET['id'])){
    $id = $_GET['id'];
    $tablename = 'foodtable';
    $item_id = "food_id";
    $item_img = 'food_img';
    $item_name = 'food_name';
    $item_type = 'food_type';
    $item_desc = 'food_desc';
    $item_price = 'food_price';
    echo "Food (id)<hr />";

  }else if(isset($_GET['id2'])){
    $id = $_GET['id2'];
    $tablename = 'stufftable';
    $item_id = "stuff_id";
    $item_img = 'stuff_img';
    $item_name = 'stuff_name';
    $item_type = 'stuff_type';
    $item_desc = 'stuff_desc';
    $item_price = 'stuff_price';
    echo "Stuff (id2)<hr />";

  }

  $sql = "SELECT * FROM $tablename WHERE $item_id = $id";
  $query = mysqli_query($conn, $sql);



  while($row = mysqli_fetch_array($query)){
    $item_id = $row[$item_id];
    $item_img = $row[$item_img];
    $item_name = $row[$item_name];
    $item_type = $row[$item_type];
    $item_desc = $row[$item_desc];
    $item_price = $row[$item_price];


    ?>

  <form action="editprocess.php?item_id=<?php echo $item_id; ?>&item_img=<?php echo $item_img; ?>&item_name=<?php echo $item_name; ?>&item_type=<?php echo $item_type; ?>&item_desc=<?php echo $item_desc; ?>&item_price=<?php echo $item_price; ?>&tablename=<?php echo $tablename; ?>" method="POST" enctype="multipart/form-data">
    <table>
      <tr>
        <td>ID: </td>
        <td><input type="text" value="<?php echo $item_id; ?>" name="id2"/></td>
      </tr>
      <tr>
        <td>Select new image: </td>
        <td><input type="file" value="<?php echo $item_img; ?>" name="file"/></td>
      </tr>
      <tr>
        <td>Name: </td>
        <td><input type="text" value="<?php echo $item_name; ?>" name="upd_name"/></td>
      </tr>
      <tr>
        <td>Type: </td>
        <td><input type="text" value="<?php echo $item_type; ?>" name="upd_type"/></td>
      </tr>
      <tr>
        <td>Description: </td>
        <td><input type="text" value="<?php echo $item_desc; ?>" name="upd_desc"/></td>
      </tr>
      <tr>
        <td>Price: </td>
        <td><input type="text" value="<?php echo $item_price; ?>" name="upd_price"/></td>
      </tr>
      <tr>
        <td><input type="submit" value="Apply changes" name="submit"/></td>
        <td>
          <a href="editprocess.php?deleteid=<?php echo $item_id; ?>&fromtable=<?php echo $tablename; ?>&itemImg=<?php echo $item_img; ?>&itemName=<?php echo $item_name; ?>&itemType=<?php echo $item_type; ?>&itemDesc=<?php echo $item_desc; ?>&itemPrice=<?php echo $item_price; ?>">- Delete -</a>
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
