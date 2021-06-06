<?php
include("functions.php");

$username = $password = $confirm_password = "";
$username_error = $password_error = $confirm_password_error = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
  if(empty(trim($_POST['username']))) {
    $username_error = "Venligst skriv et brugernavn.";
  } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST['username'])))
    {
      $username_error = "Brugernavn kan kun indeholde bogstaver, tal og underscore.";
    } else{
      $sql = "SELECT id FROM users WHERE username = ?";
      if($stmt = mysqli($conn, $sql)){
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
          
        }
      }
    }
  }
}
