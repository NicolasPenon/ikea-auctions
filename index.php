<?php include('login-function.php'); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
<?php include('errors.php'); ?>
    <form action="index.php" method="post">
      <label>Brugernavn</label>
      <input type="text" name="username">
      <label>Adgangskode</label>
      <input type="password" name="password">
      <button type="submit" name="login">Log ind</button>
    </form>
    <p> Har du ikke en bruger? <a href="register.php">Klik her</a> </p>
  </body>
</html>
