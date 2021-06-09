<?php
session_start();

if(!isset($_SESSION['username'])) {
  $_SESSION['message'] = "Venligst log ind";
  header("location: index.php");
}
$username = $_SESSION['username'];
include('header.php');
include('nav.php');

$query_all = "SELECT id, category, name, info, min_price, end_date FROM auctions";
$result_all = mysqli_query($conn, $query_all);


if(isset($_GET['catid'])){
  $category = $_GET['catid'];
  $query = "SELECT id, name, info, min_price, end_date FROM auctions WHERE category = '$category'";
  $query_cat = "SELECT id, category FROM categories WHERE id = '$category'";
  $result = mysqli_query($conn, $query);
  $result_cat = mysqli_query($conn, $query_cat);
}

?>
    <title>Forside</title>
    Her er forsiden <br>
    <?php if(isset($_SESSION['success'])) {
      echo $_SESSION['success'];
      unset($_SESSION['success']);
      echo $username;
    }  ?>

    <?php
    if(isset($_GET['catid'])) {
      while($row2=mysqli_fetch_assoc($result_cat)){
      while($row=mysqli_fetch_assoc($result)) {
        ?>
        <div class ="auctions" onclick="location.href='single-product.php?catid=<?php echo($row2['id']);?>&pid=<?php echo($row['id']);?>';"> <?php
        ?> Auktions Nr: <?php echo $row['id'] . ' <br>';
        echo $row['name'] . ' <br>';
        ?> Information:<br><?php echo $row['info'] . ' <br>';
        ?> Pris: <?php echo $row['min_price'] . ' Kr <br>';
        ?> Slut dato:<br><?php echo $row['end_date'] . ' <p>';
      ?> </div> <?php } }
    }else{
      while($row=mysqli_fetch_assoc($result_all)) { ?>
        <div class ="auctions" onclick="location.href='single-product.php?catid=<?php echo($row['category'])?>&pid=<?php echo($row['id']);?>';"> <?php
        ?> Auktions Nr: <?php echo $row['id'] . ' <br>';
        echo $row['name'] . ' <br>';
        ?> Information:<br><?php echo $row['info'] . ' <br>';
        ?> Pris: <?php echo $row['min_price'] . ' Kr <br>';
        ?> Slut dato:<br><?php echo $row['end_date'] . ' <p>';
      ?></div><?php }
    }?>
  </body>
</html>
