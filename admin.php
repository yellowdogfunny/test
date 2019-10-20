<?php
include "includes/conn.php";
?>
<html>
  <head>
    <title>Admin | Food&Stuff</title>
  </head>

  <body>
    <h1>F&S - Administration</h1>
    <hr />
    <!--TODO: Napravit da se ne moze stisnit upload button dok se ne ispune sva polja itd itd sa javascriptom-->
    <h3>Upload food or stuff to the database</h3>
    <form action="scripts/upload.php" method="POST" enctype="multipart/form-data">
      (
      <b>Food</b>
      <input type="radio" name="choice" value="food" checked="checked">
      )
      ---------
      (
      <b>Stuff</b>
      <input type="radio" name="choice" value="stuff">
      )

      <br /><br />
      <table>

        <tr>
          <td>Image:</td>
          <td><input type="file" name="file"/> <br /></td>
        </tr>

        <tr>
          <td>Name:</td>
          <td><input type="text" name="name"/> <br /></td>
        </tr>

        <tr>
          <td>Type:</td>
          <td><input type="text" name="type"/> <br /></td>
        </tr>

        <tr>
          <td>Description:</td>
          <td><input type="text" name="desc"/> <br /></td>
        </tr>

        <tr>
          <td>Price:</td>
          <td><input type="text" name="price"/> <br /></td>
        </tr>

        <tr>
          <td colspan="2"><input type="submit" value="Upload" name="submitbtn" /></td>
        </tr>
      </table>
    </form>


    <hr />


    <h3>Edit or delete FOOD from table</h3>
    <form class="" action="admin.php" method="GET">
      Search for item: <input type="text" name="searchInput"/>
      <input type="submit" name="searchSubmitBtn" value="Search">
      <button type="button" onclick="window.location.href='admin.php'" name="resetSearch">Reset</button>
    </form>

    <?php
      if(!isset($_GET['searchInput'])){
        $sql = "SELECT * FROM foodtable";
      }
      else{
        $searchInput = $_GET['searchInput'];
        $sql = "SELECT * FROM foodtable WHERE food_name='$searchInput'";
      }




      $sqlquery = mysqli_query($conn, $sql);

      while($row = mysqli_fetch_array($sqlquery)){
        $food_id = $row['food_id'];
        $food_img = $row['food_img'];
        $food_name = $row['food_name'];
        $food_type = $row['food_type'];
        $food_desc = $row['food_desc'];
        $food_price = $row['food_price'];

        /*echo "id: ".$food_id."<br />";
        echo "img: ".$food_img."<br />";
        echo "name: ".$food_name."<br />";
        echo "food type: ".$food_type."<br />";
        echo "desc: ".$food_desc."<br />";
        echo "price: ".$food_price."<br /><hr />";*/

    ?>
        <table>
          <tr>
            <td>ID:</td>
            <td><?php echo $food_id; ?></td>
          </tr>
          <tr>
            <td>Image:</td>
            <td><?php echo $food_img; ?></td>
          </tr>
          <tr>
            <td>Food name:</td>
            <td><?php echo $food_name; ?></td>
          </tr>
          <tr>
            <td>Food type:</td>
            <td><?php echo $food_type; ?></td>
          </tr>
          <tr>
            <td>Description:</td>
            <td><?php echo $food_desc; ?></td>
          </tr>
          <tr>
            <td>Price:</td>
            <td><?php echo $food_price; ?></td>
          </tr>
          <tr>
            <td>
              <a href="edit.php?id=<?php echo $food_id; ?>">- Edit -</a>
            </td>
            <td>
              <a href="admin.php?id=<?php echo $food_id; ?>">- Delete -</a>
              <?php
                if(isset($_GET['id'])){
                  $id = $_GET['id'];
                  $sqlquery2 = mysqli_query($conn, "DELETE FROM foodtable WHERE food_id = $id");
                }
              ?>
            </td>
          </tr>
        </table>
        <hr />
      <?php
      }
      ?>
  </body>
</html>
