<?php
include("header.php");
include("nav.php");
session_start();

if(!isset($_SESSION['username'])) {
  $_SESSION['message'] = "Venligst log ind";
  header("location: index.php");
}
$username = mysqli_real_escape_string($conn, $_SESSION['username']);
$prod_name = "";
$category = "";
$prod_info = "";
$min_prce = "";
$end_date = "";

if(isset($_POST['auction']))  {
  $prod_name = mysqli_real_escape_string($conn, $_POST['name']);
  $category = mysqli_real_escape_string($conn, $_POST['categories']);
  $prod_info = mysqli_real_escape_string($conn, $_POST['info']);
  $min_price = mysqli_real_escape_string($conn, $_POST['price']);
  $end_date = mysqli_real_escape_string($conn, date('Y-m-d-h-m', strtotime($_POST['end_date'])));

  $default_status = "SELECT * FROM status WHERE default_value=1";
  $user_id = "SELECT id FROM users WHERE username='$username'";
  if($result = mysqli_query($conn, $default_status)) {
    echo "Din auktion er nu oprettet";
    $status = mysqli_fetch_assoc($result);
    $default = ($status['id']);

  if($result2 = mysqli_query($conn, $user_id)) {

    $users = mysqli_fetch_assoc($result2);
    $u_id = ($users['id']);
  }
}

  $query = "INSERT INTO auctions (name, category, info, min_price, user_id, end_date, status) VALUES ('$prod_name', '$category', '$prod_info', '$min_price', '$u_id', '$end_date', '$default')";
  mysqli_query($conn, $query);
  header('post-auction.php');
}
?>
    <main>
     <div class="auction_form">
       <form action="post-auction.php" method="post">

         <label for="prod_name">Produktnavn</label><br>
         <input id="prod_name" type="text" name="name" required><br>
         <label for="category-select">Kategori</label><br>

         <select id="category-select" name="categories" required>
           <option value="">Vælg venligst en kategori</option>
           <option value="1">Stol</option>
           <option value="2">Bord</option>
           <option value="3">Lampe</option>
           <option value="4">Reol</option>
           <option value="5">Madras</option>
         </select> <br>
         <label for="prod_info">Produktinfo</label><br>
         <input id="prod_info" type="text" name="info" required><br>
         <label for="min_price">Minimums Pris</label><br>
         <input id="min_price" type="number" min="1" step="0.01" name="price" required><br>
         <label for="date">Slut dato</label><br>
         <input id="date" type="datetime-local" name="end_date" required><br>
         <input id="auction_div" type="submit" name="auction" value="Opret auktion">
       </form>
     </div>
   </main>
   </div>
   </body>
 </html>
