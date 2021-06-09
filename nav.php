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
    <link rel="stylesheet" href="css/nav.css">
  </head>
  <body>

<div id="category">
  <h1> Kategorier </h2>
</div>
<div id="allproducts">
    <div onclick="location.href='frontpage.php';" class="products_box">
      <a class="rtext">Alle produkter</a>
    </div>
</div>

<?php
    while($row=mysqli_fetch_assoc($category)) { ?>
    <div id ="categorybox">
      <li>
        <a href="frontpage.php?catid=<?php echo $row['id']; ?>"><?php echo $row['category']; ?></a>
      </li>
    </div>
  <?php } ?>
