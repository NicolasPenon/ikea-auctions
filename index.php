<?php include('login-function.php'); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/login.css">
    <title></title>
  </head>
  <body>
<?php include('errors.php'); ?>
  <div class="login_form">
    <form action="index.php" method="post">
      <label>Brugernavn</label>
      <input type="text" name="username"> <br>
      <label>Adgangskode</label>
      <input type="password" name="password">
      <button class="login_btn" type="submit" name="login">Log ind</button>
    </form>
    <p> Har du ikke en bruger? <a href="register.php">Klik her</a> </p>
  </div>
  </body>
</html>
