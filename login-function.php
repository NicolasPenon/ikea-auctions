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
  $birth_date = mysqli_real_escape_string($conn, date('Y-m-d', strtotime($_POST['birth_date'])));

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
    header('location: frontpage.php');
  }
}

//"Registrer brugere" kode herfra og op

//Login kode herunder

if(isset($_POST['login'])) {
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  if(empty($username)) {
    array_push($errors, "Brugernavn påkrævet");
  }
  if(empty($password)) {
    array_push($errors, "Kodeord påkrævet");
  }

  if(count($errors) == 0) {
    $password = md5($password);
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $results = mysqli_query($conn, $query);
    if(mysqli_num_rows($results) == 1) {
      $_SESSION['username'] = $username;
      $_SESSION['success'] = "Du er nu logget ind";
      header('location: frontpage.php');
    }else {
      array_push($errors, "Forkert brugernavn eller adgangskode");
    }
  }
}
?>
