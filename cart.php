<?php
session_start();
if(isset($_GET['purchase'])){
  echo "<h2>Purchase sucess <br /> <a href='index.php'>Home page</a></h2>";

  session_destroy();
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <table>
      <tr>
        <th>Item name: </th>
        <th>Item price: </th>
      </tr>
      <?php
        if(!empty($_SESSION["shoppingcart"])){
          $total = 0;
          foreach ($_SESSION["shoppingcart"] as $key => $value) {
          ?>
            <tr> <!-- delete je negdje na 14 min u onom videu -->
              <td><?php echo $value["item_name"]; ?></td>
              <td><?php echo $value["item_price"]; ?></td>
            </tr>
          <?php

            $total = $total + ($value["item_price"]);

          }
          ?>
          <tr>
            <td>TOTAL</td>
            <td>$<?php echo number_format($total, 2); ?></td>
            <td><a href="cart.php?purchase">Purchase</a></td>
          </tr>
          <?php
        }else{
          echo "Nothing in cart";
        }
      ?>

      <?php
      ?>
    </table>
  </body>
</html>
