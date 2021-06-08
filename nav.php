<?php
include('functions.php');

$query = "SELECT id, category FROM categories";
$category = mysqli_query($conn, $query);


?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

<h1> Kategorier </h2>
    <div onclick="location.href='frontpage.php';" class="products_box">
      <a class="rtext">Alle produkter</a>
    </div>

<?php
    while($row=mysqli_fetch_assoc($category)) { ?>
      <li>
        <a href="frontpage.php?catid=<?php echo $row['id']; ?>"><?php echo $row['category']; ?></a>
      </li>
  <?php } ?>

  </body>
</html>
