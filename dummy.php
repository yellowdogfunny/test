<?php
/*
  $conn = mysqli_connect("localhost", "root", "", "fnsdb");
  $sql = 'SELECT * FROM foodtable';
  $sqlquery = mysqli_query($conn, $sql);

  while($row = mysqli_fetch_array($sqlquery)){
    $food_id = $row['food_id'];
    $food_img = $row['food_img'];
    $food_name = $row['food_name'];
    $food_type = $row['food_type'];
    $food_desc = $row['food_desc'];
    $food_price = $row['food_price'];

    echo "id: ".$food_id."<br />";
    echo "img: ".$food_img."<br />";
    echo "name: ".$food_name."<br />";
    echo "food type: ".$food_type."<br />";
    echo "desc: ".$food_desc."<br />";
    echo "price: ".$food_price."<br /><hr />";
  }*/

?>
<form action="dummy.php" method="GET">
  <select name="selection">
    <option>
      bruh 1
    </option>
    <option>
      bruh 2
    </option>
    <option>
      bruh 3
    </option>
  </select>
  <input type="submit"/>
</form>

<?php
  if(isset($_GET['submit'])){
    echo $_GET['selection'];
  }
?>
