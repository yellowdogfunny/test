<?php include 'includes/conn.php';?>
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
            <button class="addBtn btn btn-danger">Add to cart!</button>
          </div>
        </div>
      </div>
      <?php
        }
      ?>
      <!--
      <div class="row fnsContainer1">
        <div class="col-md-4 foodPic">
          <img src="images/img4.jpg" class="img-responsive img-thumbnail"/>
        </div>
        <div class="col-md-8 foodDescContainer">
          <h1 class="headerRes"><span class="newItem">NEW!</span> Dijabetes XL </h1>
          <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus cum sed perferendis harum totam hic tempore soluta, labore assumenda beatae quas ullam itaque magni veritatis nam eius quasi tenetur. Porro.</p>
          <div class="add2cart">
            <span class="itemPrice">$9.99</span><br />
            <button class="addBtn btn btn-danger">Add to cart!</button>
          </div>
        </div>
      </div>
    </div> ovo obrisat mozda-->


    <div class="header2 noBorder">
      <h2>Recommended stuff: <?php echo $_COOKIE["recommendedStuff"]; ?></h2> <!-- recommended content na temelju searchanja na stranici, a ako nista nema searchano, po defaultu nesta stavit recommended -->
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
            <h4 class="header4"> <?php echo $stuff_name; ?> <span class="itemPrice2" style="color:red;"><br />$<?php echo $stuff_price; ?></span><br /><button class="addBtn2 btn btn-danger">Add to cart!</button></h4>
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
