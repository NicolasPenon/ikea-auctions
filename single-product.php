<?php
session_start();
include('header.php');
include('nav.php');

if(isset($_GET['pid'])){
  $product = $_GET['pid'];
  $query = "SELECT id, category, name, info, min_price, end_date FROM auctions WHERE id = '$product'";
  $result = mysqli_query($conn, $query);
}

if(!isset($_SESSION['username'])) {
  $_SESSION['message'] = "Venligst log ind";
  header("location: index.php");
}
$username = mysqli_real_escape_string($conn, $_SESSION['username']);
$auc_bid = "";

if(isset($_POST['bid'])) {
  $auc_bid = mysqli_real_escape_string($conn, $_POST['bidinfo']);

  $user_id = "SELECT id FROM users WHERE username = '$username'";
  if($result2 = mysqli_query($conn, $user_id)) {
    $user = mysqli_fetch_assoc($result2);
    $u_id = ($user['id']);


  }


$insert = "INSERT INTO bids (amount, auction_id, user_id) VALUES ('$auc_bid', '$prod_id', '$u_id')";
mysqli_query($conn, $insert);

}
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    if(isset($_GET['pid'])) {
      while($row=mysqli_fetch_assoc($result)) {
        ?>
        <div class ="products"> <?php
        ?> Auktions Nr: <?php echo $row['id'] . ' <br>';
        echo $row['name'] . ' <br>';
        ?> Information:<br><?php echo $row['info'] . ' <br>';
        ?> Pris: <?php echo $row['min_price'] . ' Kr <br>';
        ?> Slut dato:<br><?php echo $row['end_date'] . ' <p>'; ?>
          <form method="post" action="profile.php">
            Beløb: <input type="number" step = "0.01" name="bidinfo" required>
            <input type="submit" value="Opret bud" name="bid">
          </form>
        </div> <?php debug($result); }
    }?>


  </body>
</html>
