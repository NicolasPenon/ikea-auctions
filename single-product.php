<?php
session_start();
include('header.php');
include('nav.php');

if(isset($_GET['pid'])){
  $product = $_GET['pid'];
  $query = "SELECT id, category, name, info, min_price, end_date FROM auctions WHERE id = '$product'";
  $result = mysqli_query($conn, $query);
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
          <form method="post" action="single-product.php?catid=<?php echo($row['category'])?>&pid=<?php echo($row['id']);?>';">
            Beløb: <input type="number" name="bidinfo" required>
            <input type="submit" value="Opret bud">
          </form>  
        </div> <?php }
    }?>
  </body>
</html>
