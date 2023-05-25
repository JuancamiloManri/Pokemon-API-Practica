
 <?php
       
         include 'config.php';
         unset($message); 
        
         session_start();
  
         if (isset($_SESSION['username'])) {
             header('Location: index.php');
             exit;
         }

         if ($_SERVER['REQUEST_METHOD'] == 'POST') {

          $username = $_POST['username'];
          $password = $_POST['password'];


          $sql = "SELECT * FROM users WHERE username='$username'";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {

          $row = $result->fetch_assoc();
          $password_insert = $row['password'];

          if (password_verify($password, $password_insert)) {

              $_SESSION['username'] = $username;
              header('Location: index.php');
              exit;
          } else {
              header('Location: login.php?error=2');
          }
          } else {

              header('Location: login.php?error=1');
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
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/login.css" />
  </head>
  <body>
    <div class="container">
      <h1>
        <a>
          <img
            src="img/png-transparent-pokemon-logo-pokemon-nintendo-logo-thumbnail-fotor-bg-remover-2023052312439.png"
            class="poke"
            alt="logo"
        /></a>
      </h1>
      <?php
           
            if(isset($_GET['error']) && $_GET['error'] == 1) {
                echo '<p style="color: red;">User not found</p>';
            }
            if(isset($_GET['error']) && $_GET['error'] == 2) {
                echo '<p style="color: red;">Password incorrect</p>';
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
          <button type="submit" name="login">Login</button>
        </div>
      </form>
      <p>¿Do you want register? <a href="register.php"> Right here</a></p>
    </div>
  </body>
</html>

