<?php

  session_start();

  
  if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $welcome_message = "Bienvenido, $username";
  } else {
    header('Location: login.php');
  }

  
  if (isset($_GET['logout'])) {
  
    session_destroy();
    header('Location: login.php');
    exit;
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokémon</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
  </head>
  <a> <img src="img/pok-mon-go-logo-png-30.png" alt="logo" /></a>
  <body>
    <div class="container"></div>
    <div id="modal" class="modal">
      <div class="modal-content">
        <span class="close">&times;</span>
        <?php if (isset($_SESSION['username'])): ?>
          <p><a class="btn-light btn" href="?logout">Cerrar sesión</a></p>
        <?php else: ?>
          <p><a href="login.php">Iniciar sesión</a></p>
        <?php endif; ?>
        <h2 id="modal-pokemon-name"></h2>
        <h3>Abilities:</h3>
        <ul id="modal-abilities"></ul>
      </div>
    </div>

    <script src="script.js"></script>
</html>
