<?php

include('header.php');
include('functions.php');
$output='';

if(isset($_POST['search'])) {
  $searchq = $_POST['search'];

  $query = mysqli_query($conn, "SELECT * FROM auctions WHERE name LIKE '%$searchq%'");
  $count = mysqli_num_rows($query);
  if($count==0) {
    $output='';
  } else{
    while($row=mysqli_fetch_array($query)) {
      $name=$row['name'];
      $category=$row['category'];
      $status=$row['status'];

      $output .= '<div class="name_div"> '.$name.'</div><div class="category_div"> '.$category.'</div><div class="status_div"> '.$status.'</div>';
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php   print("$output"); ?>
  </body>
</html>
