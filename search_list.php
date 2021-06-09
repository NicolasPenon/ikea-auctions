<?php

include('header.php');
include('nav.php');
$output='';

if(isset($_POST['search'])) {
  $searchq = $_POST['search'];

  $query = mysqli_query($conn, "SELECT * FROM auctionall WHERE name LIKE '%$searchq%'");
  $count = mysqli_num_rows($query);
  if($count==0) {
    $output='';
  } else{
    while($row=mysqli_fetch_array($query)) {
      $id=$row['id'];
      $name=$row['name'];
      $category=$row['category'];
      $status=$row['status'];

      $output .= '<div class="search_item"> '.$id.' '.$name.' '.$category.' '.$status.'</div>';
    }
  }
}
?>

    <?php print("$output"); ?>
  </body>
</html>
