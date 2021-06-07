<?php include('login-function.php'); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form action="register.php" method="post">
      <?php include('errors.php'); ?>
      <label>Brugernavn</label>
      <input type="text" name="username" value="<?php echo $username; ?>">
      <label>E-mail</label>
      <input type="email" name="mail" value="<?php echo $mail; ?>">
      <label>Kodeord</label>
      <input type="password" name="password" value="<?php echo $password; ?>">
      <label>Bekræft kodeord</label>
      <input type="password" name="confirm_password" value="<?php echo $confirm_password; ?>">
      <label>By</label>
      <input type="text" name="city" value="<?php echo $city; ?>">
      <label>Fødselsdato</label>
      <input type="date" name="birth_date" value="<?php echo $birth_date; ?>">
      <button type="submit" name="registration">Bekræft</button>
    </form>

  </body>
</html>
