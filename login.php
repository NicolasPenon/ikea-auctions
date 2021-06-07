<?php

session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: welcome.php");
  exit;
}

include("functions.php")
$username = $password = "";
$username_error = $password_error = $login_error = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

  if(empty(trim($_POST["username"]))){
    $username_error = "Venligst indsæt brugernavn.";
  } else{
    $username = trim($_POST["username"]);
  }

  if(empty(trim($_POST["password"]))){
    $password_error = "Venligst indsæt password.";
  } else{
    $password = trim($_POST["password"]);
  }

  if(empty($username_error) && empty($password_error)){
    $sql = "SELECT id, username, password FROM users WHERE username = ?";

    if($stmt = mysqli_prepare($link, $sql)){
      mysqli_stmt_bind_param($stmt, "s", $param_username);

      $param_username = $username;

      if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_store_result($stmt);

        if(mysqli_stmt_num_rows($stmt) == 1){
          mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
          if(mysqli_stmt_fetch($stmt)){
            if(password_verify($password, $hashed_password)){

            session_start();
            $_SESSION["loggedin"] = true;
            $_SESSION["id"] = $id;
            $_SESSION["username"] = $username;

            header("location: welcome.php");
          } else{
            $login_error = "Forkert brugernavn eller password.";
          }
        }
      } else{
        $login_error = "Forkert brugernavn eller password.";
      }
    } else{
      echo "Hov! Noget gik galt. Venligst prøv igen senere.";
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
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <label>Brugernavn</label>
      <input type="text" name="username" class="form-control <?php echo (!empty($username_error)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
      <span class="invalid-feedback"><?php echo $username_error; ?></span>

      <label>Password</label>
      <input type="password" name="password" class="form-control <?php echo (!empty($password_error)) ? 'is-invalid' : ''; ?>">
      <span class="invalid-feedback"><?php $password_error ?></span>

      <input type="submit" value="login">

      <p>Har du ikke en bruger? <a href="index.php">Tilmeld dig nu</a>.</p>

    </form>
  </body>
</html>
