<?php

include 'config.php';

session_start();

if (isset($_SESSION['username'])) {
  header('Location: index.php');
  exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $username = $_POST['username'];
  $password = $_POST['password'];
  $verify_password = $_POST['verify_password'];

  if ($password !== $verify_password) {
    echo "Password do not match";
    header('Location: register.php?error=1');
  } else {
    $user_exist = "SELECT * FROM users WHERE username = '$username'";
    $user_result = $conn->query($user_exist);
    if ($user_result->num_rows > 0) {
      echo "Username already exist";
      header('Location: register.php?error=2');
      exit;
    }

     $password2 = password_hash($password, PASSWORD_DEFAULT);

    $insert_user = "INSERT INTO users (username, password) VALUES ('$username','$password2')";
    if ($conn->query($insert_user) === TRUE) {
      echo "Succesful register";

      $_SESSION['username'] = $username;
      header('Location: index.php');
      exit;
    } else {
      echo "Error: " . $insert_user . "<br>" . $conn->error;
    }
  }

  $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" type="text/css" href="css/register.css" />
  </head>
  <body>
    <div class="container">
      <h1>New User</h1>
        <?php
            // Mostrar una alerta si se recibió un parámetro de error en la URL
            if(isset($_GET['error']) && $_GET['error'] == 1) {
                echo '<p style="color: red;">Password must be equal</p>';
            }
        ?>
        <?php
            // Mostrar una alerta si se recibió un parámetro de error en la URL
            if(isset($_GET['error']) && $_GET['error'] == 2) {
                echo '<p style="color: red;">Try with other Username</p>';
            }
        ?>
      <form action="" method="post">
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" required />
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" required />
        </div>
        <div class="form-group">
          <label for="password">Verify Password</label>
          <input type="password" id="password" name="verify_password" required />
        </div>
        <div class="form-group">
          <button type="submit" name="register">Register</button>
        </div>
      </form>
      <a href="login.php"> Login</a>
    </div>
  </body>
</html>

