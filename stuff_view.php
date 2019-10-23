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
              <span class="itemPrice3 itemPrice4">$ <?php echo $stuff_price; ?></span>
              <button class="addBtn3 addBtn4 btn btn-danger">Add to cart!</button>
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
      <h2>Recommended stuff: clothes</h2> <!-- recommended content na temelju searchanja na stranici, a ako nista nema searchano, po defaultu nesta stavit recommended -->
    </div>

    <div class="row fnsContainer1 rcmItems">

      <?php
        $sql2 = "SELECT * FROM stufftable ORDER BY stuff_id LIMIT 4";
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


      <!--
      <div class="col-6 col-sm-6 col-md-4 col-lg-3 itemPic">
        <img src="images/jakna.jpg" class="img-responsive img-thumbnail itemImage"/>
        <h4 class="header4">Jakna <span class="itemPrice2" style="color:red;">$20.99</span><button class="addBtn2 btn btn-danger">Add to cart!</button></h4>
        <hr color="red" width="80%"/>
      </div>
      <div class="col-6 col-sm-6 col-md-4 col-lg-3 itemPic">
        <img src="images/jakna.jpg" class="img-responsive img-thumbnail itemImage"/>
        <h4 class="header4">Jakna <span class="itemPrice2" style="color:red;">$20.99</span><button class="addBtn2 btn btn-danger">Add to cart!</button></h4>
        <hr color="red" width="80%"/>
      </div>
      <div class="col-6 col-sm-6 col-md-4 col-lg-3 itemPic">
        <img src="images/jakna.jpg" class="img-responsive img-thumbnail itemImage"/>
        <h4 class="header4">Jakna <span class="itemPrice2" style="color:red;">$20.99</span><button class="addBtn2 btn btn-danger">Add to cart!</button></h4>
        <hr color="red" width="80%"/>
      </div>
    -->
    </div>
  </div>

  <?php include "includes/footer.php"; ?>
</body>

</html>
