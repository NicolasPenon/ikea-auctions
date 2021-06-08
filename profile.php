<?php
include('header.php');
include('functions.php');
session_start();

if(!isset($_SESSION['username'])) {
  $_SESSION['message'] = "Venligst log ind";
  header("location: index.php");
}
$profile_data = mysqli_real_escape_string($conn, $_SESSION['username']);
$query = "SELECT username, mail, city FROM users WHERE username = '$profile_data'";
$bids = "SELECT username, auction_id, amount FROM user_bids WHERE username = '$profile_data'";
$sql = mysqli_query($conn, $query);
$bid_history = mysqli_query($conn, $bids);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Min profil</title>
  </head>
  <body>
    <?php
    if($sql) {
      while($row=mysqli_fetch_assoc($sql)) {
        echo 'Username: ' . $row['username'] .' ';
        echo $row['mail'];
        echo $row['city'];
      }
    }
    ?>
    <p>
    </p>
    <?php
    if($bids) {
      while($row=mysqli_fetch_assoc($bid_history)){
        echo $row['username'];
        echo $row['auction_id'];
        echo $row['amount'];
      }
    }
     ?>
  </body>
</html>
