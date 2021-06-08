<?php
session_start();

if(!isset($_SESSION['username'])) {
  $_SESSION['message'] = "Venligst log ind";
  header("location: index.php");
}
$username = $_SESSION['username'];
include('header.php');
include('nav.php');



$category = $_GET['catid'];
$query = "SELECT name, info, min_price, end_date FROM auctions WHERE category = '$category'";
$result = mysqli_query($conn, $query);

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Forside</title>
  </head>
  <body>
    Her er forsiden
    <?php if(isset($_SESSION['success'])) {
      echo $_SESSION['success'];
      unset($_SESSION['success']);
      echo $username;
    }  ?>

    <?php
    if(isset($_GET['catid'])) {
    while($row=mysqli_fetch_assoc($result)) {
      echo $row['name'] . ' ';
      echo $row['info'] . ' ';
      echo $row['min_price'] . ' ';
      echo $row['end_date'] . ' ';
      }
    }?>
  </body>
</html>
