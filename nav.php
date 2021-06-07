<?php
include('functions.php');

$query = "SELECT category FROM categories";
$category = mysqli_query($conn, $query);
$category_info = array();
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
        <?php $category_info[] = $row['category']; ?>
  <?php  }
 ?>

<?php for($i = 0; $i < count($category_info); $i++) { ?>
  <li class="categories_list">
    <a class="cat-titles" href="frontpage.php?catid=<?php echo $i; ?>">
      <?php echo $category_info[$i]; ?>
    </a>
  </li>
<?php } ?>








  </body>
</html>
