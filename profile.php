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
$users = "SELECT id, name, min_price, username FROM auction_users WHERE username = '$profile_data'";
$bids = "SELECT username, auction_id, amount FROM user_bids WHERE username = '$profile_data'";
$bids_won = "SELECT username, id, amount FROM bids_won WHERE username= '$profile_data' AND status = 2";
$sql = mysqli_query($conn, $query);
$bid_history = mysqli_query($conn, $bids);
$win_history = mysqli_query($conn, $bids_won);
$user_auction = mysqli_query($conn, $users);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/profile.css">
    <title>Min profil</title>
  </head>
  <body>
    <div class="flexcontainer">
      <?php
      if($sql) {
        while($row=mysqli_fetch_assoc($sql)) {
          ?> <div class="info"> <?php
          echo 'Brugernavn: ' . $row['username'] .' <br>';
          echo 'Email: ' . $row['mail'] . ' <br>';
          echo 'By: ' . $row['city'] . ' <br>';
          ?> </div> <?php
        }
      }
      ?>
      <p>
      </p>
      <div class="loopitems">
          <div class="titles">Tidligere bud: <br> </div>
          <?php
          if($bids) {
            while($row=mysqli_fetch_assoc($bid_history)){
              ?> <div class="bids"> <?php
              echo 'Brugernavn: ' . $row['username'] .' <br>';
              echo 'Auktionsnummer: ' . $row['auction_id'] . ' <br>';
              echo 'Beløb: ' . $row['amount'] . ' Kr<br>';
              ?> </div> <?php
            }
          } ?>
        <p>
        </p>
        <div class="titles">Bud vundet: <br></div>
        <?php
        if($bids_won) {
          while($row=mysqli_fetch_assoc($win_history)){
            ?> <div class="wins"> <?php
            echo 'Brugernavn: ' . $row['username'] .' <br>';
            echo 'Auktionsnummer: ' . $row['id'] . ' <br>';
            echo 'Beløb: ' . $row['amount'] . ' Kr<br>';
            ?> </div> <?php
          }
        } ?>
         <p>
         </p>
         <div class="titles">Dine auktioner: <br> </div>
         <?php
         if($users) {
           while($row=mysqli_fetch_assoc($user_auction)){
             ?> <div class="my_auction"> <?php
             echo 'Auktionsnummer: ' . $row['id'] . ' <br>';
             echo 'Produkt: ' . $row['name'] .' <br>';
             echo 'Pris: ' . $row['min_price'] . ' Kr<br>';
             ?> </div> <?php
           }
         } ?>
       </div>
     </div>
  </body>
</html>
