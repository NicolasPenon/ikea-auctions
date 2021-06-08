<?php
session_start();

if(!isset($_SESSION['username'])) {
  $_SESSION['message'] = "Venligst log ind";
  header("location: index.php");
}
$username = $_SESSION['username'];
include('header.php');
include('nav.php');

$query_all = "SELECT id, name, info, min_price, end_date FROM auctions";
$result_all = mysqli_query($conn, $query_all);

if(isset($_GET['catid'])){
  $category = $_GET['catid'];
  $query = "SELECT id, name, info, min_price, end_date FROM auctions WHERE category = '$category'";
  $result = mysqli_query($conn, $query); }

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Forside</title>
  </head>
  <body>
    Her er forsiden <br>
    <?php if(isset($_SESSION['success'])) {
      echo $_SESSION['success'];
      unset($_SESSION['success']);
      echo $username;
    }  ?>

    <?php
    if(isset($_GET['catid'])) {
      while($row=mysqli_fetch_assoc($result)) { ?>
        <div class ="auctions"> <?php
        ?> Auktions Nr: <?php echo $row['id'] . ' <br>';
        echo $row['name'] . ' <br>';
        ?> Information:<br><?php echo $row['info'] . ' <br>';
        ?> Pris: <?php echo $row['min_price'] . ' Kr <br>';
        ?> Slut dato:<br><?php echo $row['end_date'] . ' <p>';
      }?></div><?php
    }else{
      while($row=mysqli_fetch_assoc($result_all)) { ?>
        <div class ="auctions"> <?php
        ?> Auktions Nr: <?php echo $row['id'] . ' <br>';
        echo $row['name'] . ' <br>';
        ?> Information:<br><?php echo $row['info'] . ' <br>';
        ?> Pris: <?php echo $row['min_price'] . ' Kr <br>';
        ?> Slut dato:<br><?php echo $row['end_date'] . ' <p>';
      }?></div><?php
    }?>
  </body>
</html>
