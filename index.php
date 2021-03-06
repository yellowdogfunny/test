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
      //echo "<script>window.location='index.php'</script>";
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
$buttonName1 = "Add to cart!";
$buttonName2 = "(IN CART)!";
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
  <link href="https://fonts.googleapis.com/css?family=Dancing+Script&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">

  <title id="pagetitle">HOME | Food&Stuff</title>
</head>

<body>
  <!-- HEADER -->
  <?php include "includes/headermenu.php"; ?>

  <!-- CONTENT -->
  <div class="container-fluid">

    <div class="sloganimg">
      <div class="slogan">We have everything! <br />
        <span class="slogan2">(literally)</span> <br />
        <span class="slogan2 fnsNatpis">Food&Stuff</span>
      </div>
    </div>


    <div class="container">
      <div class="header2 noBorder homeHeader2">
        <h2>SPECIAL FOOD/DRINKS OFFERS</h2>
      </div>

      <?php
        $sql = "SELECT * FROM foodtable ORDER BY food_id DESC LIMIT 2";
        $query = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_array($query)){
          $food_id = $row['food_id'];
          $food_img = $row['food_img'];
          $food_name = $row['food_name'];
          $food_type = $row['food_type'];
          $food_desc = $row['food_desc'];
          $food_price = $row['food_price'];

      ?>
      <div class="row fnsContainer1">
        <div class="col-md-4 foodPic">
          <img src="<?php echo $food_img; ?>" class="img-responsive img-thumbnail"/>
        </div>
        <div class="col-md-8 foodDescContainer">
          <h1 class="headerRes"><span class="newItem">NEW!</span> <?php echo $food_name; ?> </h1>
          <p class="lead"><?php echo $food_desc; ?></p>
          <div class="add2cart">
            <span class="itemPrice"><?php echo "$".$food_price; ?></span><br />

            <!-- Add to cart -->
            <form class="" action="index.php?item_id=<?php echo $food_id; ?>" method="post">
              <input type="hidden" name="hidden_name" value="<?php echo $food_name; ?>">
              <input type="hidden" name="hidden_price" value="<?php echo $food_price; ?>">
              <input type="hidden" name="hidden_img" value="<?php echo $food_img; ?>">
              <input type="submit" class="addBtn btn btn-danger" name="add2cartbtn" value="<?php echo $buttonName1;?>!">
            </form>

          </div>
        </div>
      </div>
      <?php
        }
      ?>

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
            <h4 class="header4"> <?php echo $stuff_name; ?> <span class="itemPrice2" style="color:red;"><br />$<?php echo $stuff_price; ?></span><br />

              <form class="" action="index.php?item_id=<?php echo $stuff_id; ?>" method="post">
                <input type="hidden" name="hidden_name" value="<?php echo $stuff_name; ?>">
                <input type="hidden" name="hidden_price" value="<?php echo $stuff_price; ?>">
                <input type="hidden" name="hidden_img" value="<?php echo $stuff_img; ?>">
                <input type="submit" class="btn btn-danger" name="add2cartbtn" value="<?php echo $buttonName1; ?>">
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
