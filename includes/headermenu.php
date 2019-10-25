<?php
header('Cache-Control: no-cache');
?>
<div class="container-fluid">
  <nav class="navbar navbar-expand-md navbar-light bg-light">
    <div class="logodiv">
      <a class="navbar-brand" href="index.php"><img src="foodnstufflogo.png" width="100em"/></a>
    </div>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item"><a class="nav-link homeBtn" href="index.php" id="navHome">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="foodmenu.php" id="navFoodMenu">Food Menu</a></li>
        <li class="nav-item"><a class="nav-link" href="stuff.php" id="navStuff">Stuff</a></li>
        <li class="nav-item"><a class="nav-link" href="#" id="navAboutUs">About us</a></li>
        <li class="nav-item">
          <button class="btn btn-outline-dark my-2 my-md-0 cartBtn" onclick="window.location.href='cart.php'">
            <i class="fas fa-shopping-cart">
               <?php
               if(isset($_SESSION["shoppingcart"])){
                 if(count($_SESSION["shoppingcart"]) > 0) {
                   echo count($_SESSION["shoppingcart"]);
                 } else{
                   echo "0";
                 }
               }else{
                 echo "0";
               }
               ?>
             </i>
           </button>
         </li>
      </ul>
      <form class="form-inline my-2 my-md-0" action="searchresults.php" method="GET">
        <input class="form-control mr-md-2 inputField" type="search" placeholder="Search something..." aria-label="Search" name="searchInput">
        <button class="btn btn-outline-dark my-2 my-md-0 searchBtn" type="submit" name="searchSubmit"><i class="fas fa-search fa-sm searchIcon"></i></button>
      </form>

    </div>
  </nav>
</div>

<script>

</script>
