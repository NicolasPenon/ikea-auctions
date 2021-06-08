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
$bids_won = "SELECT username, id, amount FROM bids_won WHERE username= '$profile_data' AND status = 2";
$sql = mysqli_query($conn, $query);
$bid_history = mysqli_query($conn, $bids);
$win_history = mysqli_query($conn, $bids_won);
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
        echo 'Brugernavn: ' . $row['username'] .' <br>';
        echo 'Email: ' . $row['mail'] . ' <br>';
        echo 'By: ' . $row['city'] . ' <br>';
      }
    }
    ?>
    <p>
    </p>
    Tidligere bud: <br>
    <?php
    if($bids) {
      while($row=mysqli_fetch_assoc($bid_history)){
        echo 'Brugernavn: ' . $row['username'] .' <br>';
        echo 'Auktionsnummer: ' . $row['auction_id'] . ' <br>';
        echo 'Beløb: ' . $row['amount'] . ' Kr<br>';
      }
    } ?>
    <p>
    </p>
    Bud vundet: <br>
    <?php
    if($bids_won) {
      while($row=mysqli_fetch_assoc($win_history)){
        echo 'Brugernavn: ' . $row['username'] .' <br>';
        echo 'Auktionsnummer: ' . $row['id'] . ' <br>';
        echo 'Beløb: ' . $row['amount'] . ' Kr<br>';
      }
    }
     ?>
  </body>
</html>
