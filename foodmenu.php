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
        'item_price' => $_POST['hidden_price']
      );
      $_SESSION["shoppingcart"][$count] = $item_array;
    }else{
      //echo "<script>alert('Item already added!')</script>";
      //echo "<script>window.location='foodmenu.php'</script>";
    }
  }else{
    $item_array = array(
      'item_id' => $_GET['item_id'],
      'item_name' => $_POST['hidden_name'],
      'item_price' => $_POST['hidden_price']
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
  <title id="pagetitle">FOOD MENU | Food&Stuff</title>
</head>

<body>
  <!-- HEADER -->
  <?php include "includes/headermenu.php"; ?>

  <!-- SORT MENU -->

  <div class="container-fluid sortMenuContainer">
    <div class="sortMenuDiv">
      <a href="foodmenu.php?fcheck=All">All</a>
    </div>
    <div class="sortMenuDiv">
      <a href="foodmenu.php?fcheck=Salads">Salads</a>
    </div>
    <div class="sortMenuDiv">
      <a href="foodmenu.php?fcheck=Fastfood">Fastfood</a>
    </div>
    <div class="sortMenuDiv">
      <a href="foodmenu.php?fcheck=Desserts">Desserts</a>
    </div>
    <div class="sortMenuDiv">
      <a href="foodmenu.php?fcheck=Drinks">Drinks</a>
    </div>
  </div>

  <!-- CONTENT -->
  <?php

  ?>
  <div class="container">
    <div class="header2 fmHeader2 noBorder">
      <h2>Food: <span id="foodtypeheader">All</span></h2>
    </div>
    <div class="row fnsContainer1 fnsContainer2">

      <?php
        if(isset($_GET['fcheck'])){
          $fcheck = $_GET['fcheck'];

          if($fcheck == 'All'){
            $sql = 'SELECT * FROM foodtable';
            echo "<script> document.getElementById('foodtypeheader').innerHTML = 'All'; </script>";
          }else if($fcheck == 'Salads'){
            $sql ="SELECT * FROM foodtable WHERE food_type = 'Salads'";
          }else if($fcheck == 'Fastfood'){
            $sql ="SELECT * FROM foodtable WHERE food_type = 'Fastfood'";
          }else if($fcheck == 'Desserts'){
            $sql ="SELECT * FROM foodtable WHERE food_type = 'Desserts'";
          }else if($fcheck == 'Drinks'){
            $sql ="SELECT * FROM foodtable WHERE food_type = 'Drinks'";
          }else{
            $sql = 'SELECT * FROM foodtable';
            echo "<script> document.getElementById('foodtypeheader').innerHTML = 'All'; </script>";
          }
          echo "<script> document.getElementById('foodtypeheader').innerHTML = '$fcheck'; </script>";
        }else{
          $sql = 'SELECT * FROM foodtable';
          echo "<script> document.getElementById('foodtypeheader').innerHTML = 'All'; </script>";
        }



        $sqlquery = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_array($sqlquery)){
          $food_id = $row['food_id'];
          $food_img = $row['food_img'];
          $food_name = $row['food_name'];
          //$food_type = $row['food_type'];
          $food_desc = $row['food_desc'];
          $food_price = $row['food_price'];
      ?>
          <div class="col-6 col-sm-6 col-md-4 col-lg-3 foodContainer food stuff_stuffContainer">

              <img src="<?php echo $food_img; ?>" class="img-responsive img-thumbnail" alt="">
              <div class="fmFoodName" title="<?php echo $food_name; ?>"><?php echo $food_name; ?></div>
              <div class="fmFoodDesc" title="<?php echo $food_desc; ?>">
                <?php echo $food_desc; ?>
              </div>
              <br />

              <div class="fmFoodPrice">
                <div class="text-danger itemPrice5">
                  $ <?php echo $food_price; ?>
                </div>

                <form class="" action="foodmenu.php?item_id=<?php echo $food_id; ?>" method="post">
                  <input type="hidden" name="hidden_name" value="<?php echo $food_name; ?>">
                  <input type="hidden" name="hidden_price" value="<?php echo $food_price; ?>">
                  <input type="submit" class="btn btn-danger" name="add2cartbtn" value="Add to cart!">
                </form>

              </div>
              <hr width="90%" color="red"/>

          </div>

      <?php
        }
      ?>
    </div>
  </div>

  <?php include "includes/footer.php"; ?>
</body>

</html>
