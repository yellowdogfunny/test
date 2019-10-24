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

<body class="stuffBody">
  <!-- HEADER -->
  <?php include "includes/headermenu.php"; ?>

  <!-- SORT MENU -->

  <div class="container-fluid sortMenuContainer">
    <div class="sortMenuDiv">
      <a href="stuff.php?scheck=All">All</a>
    </div>
    <div class="sortMenuDiv">
      <a href="stuff.php?scheck=Clothes">Clothes</a>
    </div>
    <div class="sortMenuDiv">
      <a href="stuff.php?scheck=Electronics">Electronics</a>
    </div>
    <div class="sortMenuDiv">
      <a href="stuff.php?scheck=Tools">Tools</a>
    </div>
    <div class="sortMenuDiv">
      <a href="stuff.php?scheck=Other">Other</a>
    </div>
  </div>

  <!-- CONTENT -->
  <div class="container stfContainer">
    <div class="header2 fmHeader2 noBorder">
      <h2><font color="grey">Stuff: <span id="foodtypeheader">All</span></font></h2>
    </div>
    <div class="row fnsContainer1 fnsContainer2 stuffContainer">

      <?php
        if(isset($_GET['scheck'])){
          $scheck = $_GET['scheck'];
          if($scheck == 'All'){
              $sql = "SELECT * FROM stufftable";
              echo "<script> document.getElementById('foodtypeheader').innerHTML = 'All'; </script>";
          }else{
            $sql = "SELECT * FROM stufftable WHERE stuff_type = '$scheck'";
            echo "<script> document.getElementById('foodtypeheader').innerHTML = '$scheck'; </script>";
          }
        }else{
          $sql = "SELECT * FROM stufftable";
          echo "<script> document.getElementById('foodtypeheader').innerHTML = 'All'; </script>";
        }
        //$sql = 'SELECT * FROM stufftable';
        $sqlquery = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_array($sqlquery)){
          $stuff_id = $row['stuff_id'];
          $stuff_img = $row['stuff_img'];
          $stuff_name = $row['stuff_name'];

          $stuff_desc = $row['stuff_desc'];
          $stuff_price = $row['stuff_price'];
      ?>

            <div class="col-6 col-sm-6 col-md-4 col-lg-3 foodContainer food stuff_stuffContainer">
                <a href="stuff_view.php?id=<?php echo $stuff_id; ?>">
                  <img src="<?php echo $stuff_img; ?>" class="img-responsive img-thumbnail" alt="">
                  <div class="fmFoodName" title="<?php echo $stuff_name; ?>"><?php echo $stuff_name; ?></div>
                  <div class="fmFoodDesc" title="<?php echo $stuff_desc; ?>">
                    <?php echo $stuff_desc; ?>
                  </div>
                  <br />
                </a>
                <div class="fmFoodPrice">
                  <span class="itemPrice3">$ <?php echo $stuff_price; ?></span>
                  <button class="addBtn3 btn btn-danger" onclick="alert('added to cart')">Add to cart!</button>
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
