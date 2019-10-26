<?php
include 'includes/conn.php';

session_start();
if(isset($_GET["action"])){
  if($_GET["action"] == "delete"){
    foreach ($_SESSION["shoppingcart"] as $key => $value) {
      if($value["item_id"] == $_GET["id"]){
        unset($_SESSION["shoppingcart"][$key]);
        echo "<script>window.location='cart.php'</script>";
      }
    }
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
    <title id="pagetitle">CART | Food&Stuff</title>
  </head>
  <body class="stuffBody">
    <!-- HEADER -->
    <?php include "includes/headermenu.php";

    if(isset($_GET['purchase'])){
      echo "<h2 align='center' class='purchase_success'>Purchase sucess <br /> <a href='index.php'>Home page</a></h2>";

      session_destroy();
    }else{

      ?>
      <!-- CONTENT -->
      <div class="container stfContainer">
        <div class="header2 fmHeader2 noBorder">
          <h2><font color="grey">Cart</span></font></h2>
        </div>
        <div class="row fnsContainer1 fnsContainer2 stuffContainer">

          <div class="table-responsive">
            <table class="table table-striped cart_table">
              <tr>
                <th>#</th>
                <th scope="col" class="cart_th_img"><!--Image--></th>
                <th scope="col">Item name </th>
                <th scope="col">Item price </th>
                <th></th>
              </tr>
              <?php
                if(!empty($_SESSION["shoppingcart"])){
                  $total = 0;
                  $cItemCount = 0;
                  foreach ($_SESSION["shoppingcart"] as $key => $value) {
                  ?>
                    <tr> <!-- delete je negdje na 14 min u onom videu -->
                      <td class="align-middle"><?php echo $cItemCount = $cItemCount + 1; ?></td>
                      <td>
                        <div class="cart_img">
                          <img src="<?php echo $value["item_img"] ?>" alt="" class="">
                        </div>
                      </td>
                      <td class="align-middle"><?php echo $value["item_name"]; ?></td>
                      <td class="align-middle">$<?php echo $value["item_price"]; ?></td>
                      <td class="align-middle"><a href="cart.php?action=delete&id=<?php echo $value["item_id"]; ?>" class="btn btn-danger removeBtn">X</a></td>
                    </tr>
                  <?php

                    $total = $total + ($value["item_price"]);

                  }
                  ?>
                  <tr class="cart_total">
                    <td colspan="2">TOTAL</td>
                    <td></td>
                    <td colspan="2">$<?php echo number_format($total, 2); ?></td>
                  </tr>
                  <tr>
                    <td colspan="5"><a class="btn btn-block btn-success purchaseBtn" href="cart.php?purchase">Purchase</a></td>
                  </tr>
                  <?php
                }else{
                  echo "<h4 align='center'>Cart is empty</h3>";
                }
              ?>
            </table>
          </div>



        </div>
      </div>


      <?php
    }

    ?>



    <?php include "includes/footer.php"; ?>

  </body>
</html>
