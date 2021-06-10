<?php include('login-function.php'); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/login.css">
    <title>Registrer bruger</title>
  </head>
  <body>
    <div class="register_form">
    <form action="register.php" method="post">
      <?php include('errors.php'); ?>
      <label>Brugernavn</label>
      <input type="text" name="username" value="<?php echo $username; ?>"> <br>
      <label>E-mail</label>
      <input type="email" name="mail" value="<?php echo $mail; ?>"> <br>
      <label>Kodeord</label>
      <input type="password" name="password" value="<?php echo $password; ?>"> <br>
      <label>Bekræft kodeord</label>
      <input type="password" name="confirm_password" value="<?php echo $confirm_password; ?>"><br>
      <label>By</label><br>
      <input type="text" name="city" value="<?php echo $city; ?>"><br>
      <label>Fødselsdato</label>
      <input type="date" name="birth_date" value="<?php echo $birth_date; ?>">
      <button class="register_btn" type="submit" name="registration">Bekræft</button>
    </form>
  </div>
  </body>
</html>
