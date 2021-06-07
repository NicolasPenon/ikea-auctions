<?php
include("functions.php");
session_start();

$username = "";
$mail = "";
$city = "";
$birth_date = "";
$errors = array();

if(isset($_POST['registration'])) {
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $mail = mysqli_real_escape_string($conn, $_POST['mail']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
  $city = mysqli_real_escape_string($conn, $_POST['city']);
  $birth_date = mysqli_real_escape_string($conn, $_POST['birth_date']);

  if (empty($username)) { array_push($errors, "Brugernavn påkrævet"); }
  if (empty($mail)) { array_push($errors, "E-mail påkrævet"); }
  if (empty($password)) { array_push($errors, "Kodeord påkrævet"); }
  if ($password != $confirm_password) {
    array_push($errors, "Kodeord er ikke ens");
  }

  $username_check = "SELECT * FROM users WHERE username='$username' OR mail='$mail' LIMIT 1";
  $results = mysqli_query($conn, $username_check);
  $user = mysqli_fetch_assoc($results);

  if($user) {
    if($user['usernamer'] === $username) {
      array_push($errors, "Brugernavn er allerede i brug");
    }
    if($user['mail'] === $mail) {
      array_push($errors, "E-mail er allerede i brug");
    }
  }

  if(count($errors) == 0) {
    $password = md5($password);
    $query = "INSERT INTO users (username, mail, password, city, birth_date) VALUES('$username','$mail', '$password','$city','$birth_date')";
    mysqli_query($conn, $query);
    $_SESSION['username'] = $username;
    $_SESSION['success'] = "Du er nu logget ind";
    header('location: index.php');
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
    <form action="index.php" method="post">
      <?php include('errors.php'); ?>
      <label>Brugernavn</label>
      <input type="text" name="username" value="<?php echo $username; ?>">
      <label>E-mail</label>
      <input type="email" name="mail" value="<?php echo $email; ?>">
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
