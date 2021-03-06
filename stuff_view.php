<?php include 'includes/conn.php';
session_start();
if(isset($_POST['add2cartbtn'])){
  if(isset($_SESSION['shoppingcart'])){
    $item_array_id = array_column($_SESSION["shoppingcart"], "item_id");
    if(!in_array($_GET['item_id'], $item_array_id)){
      $count = count($_SESSION["shoppingcart"]);
      $item_array = array(
        'item_id' => $_GET['item_id'],
        'item_name' => $_POST['hidden_name'],
        'item_price' => $_POST['hidden_price'],
        'item_img' => $_POST['hidden_img']
      );
      $_SESSION["shoppingcart"][$count] = $item_array;
    }else{
      //echo "<script>alert('Item already added!')</script>";
      //echo "<script>window.location='stuff_view.php'</script>";
    }
  }else{
    $item_array = array(
      'item_id' => $_GET['item_id'],
      'item_name' => $_POST['hidden_name'],
      'item_price' => $_POST['hidden_price'],
      'item_img' => $_POST['hidden_img']
    );
    $_SESSION["shoppingcart"][0] = $item_array;
  }
}
?>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/83dfe2e2a2.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css?family=Barlow&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <title id="pagetitle">STUFF | Food&Stuff</title>
</head>

<body>
  <!-- HEADER -->
  <?php include "includes/headermenu.php"; ?>

  <!-- CONTENT -->
  <div class="container">

    <div class="header2 fmHeader2 noBorder">
      <h2 id="stuff-title">-</h2>
    </div>

    <div class="row fnsContainer1 fnsContainer2 clickedItemContainer">

      <?php
      if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "SELECT * FROM stufftable WHERE stuff_id = '$id'";
        $query = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_array($query)){
          $stuff_id = $row['stuff_id'];
          $stuff_img = $row['stuff_img'];
          $stuff_name = $row['stuff_name'];

          $stuff_desc = $row['stuff_desc'];
          $stuff_price = $row['stuff_price'];
      ?>
          <div class="col-12 col-md-7 stuffFullImage">
            <img src="<?php echo $stuff_img; ?>" class="img-responsive img-thumbnail" alt="">
          </div>

          <div class="col-12 col-md-5 stuffDescDiv">
            <div class="fmFoodName" title="<?php echo $stuff_name; ?>"><?php echo $stuff_name; ?></div>
            <div class="fmFoodDesc" title="<?php echo $stuff_desc; ?>">
              <?php echo $stuff_desc; ?>
            </div>
            <br />
            <div class="fmFoodPrice svStuffPrice">
              <span class="itemPrice3 itemPrice4 itemPrice5">$ <?php echo $stuff_price; ?></span>
              <br>
              <form class="" action="stuff_view.php?item_id=<?php echo $stuff_id; ?>&id=<?php echo $id; ?>" method="post">
                <input type="hidden" name="hidden_name" value="<?php echo $stuff_name; ?>">
                <input type="hidden" name="hidden_price" value="<?php echo $stuff_price; ?>">
                <input type="hidden" name="hidden_img" value="<?php echo $stuff_img; ?>">
                <input type="submit" class="btn btn-danger" name="add2cartbtn" value="Add to cart!">
              </form>

            </div>
          </div>

      <?php
        }
        echo "<script>
          document.getElementById('stuff-title').innerHTML = '$stuff_name'
        </script>";
      }
  ?>

    </div>
    <div class="header2 noBorder">
      <h2>Recommended stuff: <?php if(isset($_COOKIE["recommendedStuff"])){echo $_COOKIE["recommendedStuff"];}else{echo " ";} ?></h2> <!-- recommended content na temelju searchanja na stranici, a ako nista nema searchano, po defaultu nesta stavit recommended -->
    </div>

    <div class="row fnsContainer1 rcmItems">

      <?php
        if(isset($_COOKIE["recommendedStuff"])){
          $ckStuffType = $_COOKIE["recommendedStuff"];
          $sql2 = "SELECT * FROM stufftable WHERE stuff_type = '$ckStuffType' ORDER BY stuff_id LIMIT 4";
        }else{
          $sql2 = "SELECT * FROM stufftable ORDER BY stuff_id LIMIT 4";
        }

        $query2 = mysqli_query($conn, $sql2);

        while($row2 = mysqli_fetch_array($query2)){
          $stuff_id = $row2['stuff_id'];
          $stuff_img = $row2['stuff_img'];
          $stuff_name = $row2['stuff_name'];
          $stuff_type = $row2['stuff_type'];
          $stuff_desc = $row2['stuff_desc'];
          $stuff_price = $row2['stuff_price'];

          ?>

          <div class="col-6 col-sm-6 col-md-4 col-lg-3 itemPic">
            <a href="stuff_view.php?id=<?php echo $stuff_id; ?>">
              <img src="<?php echo $stuff_img; ?>" class="img-responsive img-thumbnail itemImage"/>
            </a>
            <h4 class="header4"> <?php echo $stuff_name; ?>
            <br />
            <span class="itemPrice2" style="color:red;">$<?php echo $stuff_price; ?></span>
            <br />
            </h4>
              <form class="" action="stuff_view.php?item_id=<?php echo $stuff_id; ?>&id=<?php echo $id; ?>" method="post">
                <input type="hidden" name="hidden_name" value="<?php echo $stuff_name; ?>">
                <input type="hidden" name="hidden_price" value="<?php echo $stuff_price; ?>">
                <input type="hidden" name="hidden_img" value="<?php echo $stuff_img; ?>">
                <input type="submit" class="btn btn-danger" name="add2cartbtn" value="Add to cart!">
              </form>

            <hr color="red" width="80%"/>
          </div>

          <?php

        }
      ?>

    </div>
  </div>

  <?php include "includes/footer.php"; ?>
</body>

</html>
