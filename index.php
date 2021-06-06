<?php
include("functions.php");

$username = $password = $confirm_password = "";
$username_error = $password_error = $confirm_password_error = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
  if(empty(trim($_POST['username']))) {
    $username_error = "Venligst skriv et brugernavn.";
  } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST['username']))){
      $username_error = "Brugernavn kan kun indeholde bogstaver, tal og underscore.";
  } else{
      $sql = "SELECT id FROM users WHERE username = ?";

      if($stmt = mysqli_prepare($conn, $sql)){
        mysqli_stmt_bind_param($stmt, "s", $param_username);
        $param_username = trim($_POST['username']);
        if(mysqli_stmt_execute($stmt)){
          mysqli_stmt_store_result($stmt);
          if(mysqli_stmt_num_rows($stmt) == 1){
            $username_error = "Dette brugernavn er allerede i brug.";
          } else{
            $username = trim($_POST['username']);
          }
        } else{
          echo "Noget gik galt, prøv igen senere.";
        }
        mysqli_stmt_close($stmt);
      }
    }
    if(empty(trim($_POST['password']))){
      $password_error = "Venligst indtast et kodeord.";
    } elseif(strlen(trim($_POST['password'])) < 8){
      $password_error = "Kodeord skal være længere end 8 tegn.";
    } else{
      $password = trim($_POST['password']);
    }
    if(empty(trim($_POST['confirm_password']))){
      $confirm_password_error = "Bekræft kodeord.";
    } else{
      $confirm_password = trim($_POST['confirm_password']);
      if(empty($password_error) && ($password != $confirm_password)){
        $confirm_password_error = "Kodeordene er ikke ens.";
      }
    }
    if(empty($username_error) && empty($password_error) && empty($confirm_password_error)) {
      $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
      if($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
        $param_username = $username;
        $param_password = password_hash($password, PASSWORD_DEFAULT);
        if(mysqli_stmt_execute($stmt)){
          header("location: login.php");
        } else{
          echo "Prøv igen du.";
        }
        mysqli_stmt_close($stmt);
      }
    }
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
      <label>Brugernavn</label>
      <input type="text" name="username" value="<?php echo $username; ?>">
      <label>Kodeord</label>
      <input type="password" name="password" value="<?php echo $password; ?>">
      <label>Bekræft kodeord</label>
      <input type="password" name="confirm_password" value="<?php echo $confirm_password; ?>">
      <input type="submit" value="Bekræft">

    </form>

  </body>
</html>
