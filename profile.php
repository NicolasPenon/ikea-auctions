<?php
include('functions.php');
session_start();

if(!isset($_SESSION['username'])) {
  $_SESSION['message'] = "Venligst log ind";
  header("location: index.php");
}
$profile_data = mysqli_real_escape_string($conn, $_SESSION['username']);
$query = "SELECT username, mail, city FROM users WHERE username = '$profile_data'";
$sql = mysqli_query($conn, $query);

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
        echo $row['username']; echo $row['mail']; echo $row['city'];
      }
    }
    ?>
  </body>
</html>
