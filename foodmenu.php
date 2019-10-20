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
  <title>FOOD MENU | Food&Stuff</title>
</head>

<body>
  <!-- HEADER -->
  <?php include "includes/headermenu.php"; ?>

  <!-- SORT MENU -->

  <div class="container-fluid sortMenuContainer">
    <div class="sortMenuDiv">
      All <input type="checkbox"/>
    </div>
    <div class="sortMenuDiv">
      Salads <input type="checkbox"/>
    </div>
    <div class="sortMenuDiv">
      Fastfood <input type="checkbox"/>
    </div>
    <div class="sortMenuDiv">
      Desserts <input type="checkbox"/>
    </div>
    <div class="sortMenuDiv">
      Drinks <input type="checkbox"/>
    </div>
  </div>

  <!-- CONTENT -->
  <div class="container">
    <div class="header2 fmHeader2 noBorder">
      <h2>All</h2>
    </div>
    <div class="row fnsContainer1 fnsContainer2">

      <?php
        $sql = 'SELECT * FROM foodtable';
        $sqlquery = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_array($sqlquery)){
          $food_id = $row['food_id'];
          $food_img = $row['food_img'];
          $food_name = $row['food_name'];
          //$food_type = $row['food_type'];
          $food_desc = $row['food_desc'];
          $food_price = $row['food_price'];
      ?>

          <div class="col-6 col-sm-6 col-md-4 col-lg-3 foodContainer food">
            <img src="<?php echo $food_img; ?>" class="img-responsive img-thumbnail" alt="">
            <div class="fmFoodName" title="<?php echo $food_name; ?>"><?php echo $food_name; ?></div>
            <div class="fmFoodDesc" title="<?php echo $food_desc; ?>">
              <?php echo $food_desc; ?>
            </div>
            <br />
            <div class="fmFoodPrice">
              <span class="itemPrice3">$ <?php echo $food_price; ?></span>
              <button class="addBtn3 btn btn-danger">Add to cart!</button>
            </div>
            <hr width="90%" color="red"/>
          </div>
      <?php
        }
      ?>
    </div>
  </div>

  <div class="footer1">
    <p>Stjepan Milardic 2019</p>
  </div>
</body>

</html>
