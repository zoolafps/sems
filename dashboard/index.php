<?php

  session_start();

  if (isset($_SESSION['user_id'])) {
    header('Location: /php-login');
  }
      $conn = mysqli_connect(
        'localhost',
        'root',
        '',
        'sems'
      ) or die(mysqli_erro($mysqli));


  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE email = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
      $_SESSION['user_id'] = $results['id'];
      header("Location: /php-login");
    } else {
      $message = 'Sorry, those credentials do not match';
    }
  }

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Welcome to you WebApp</title>
    <!--  GOOGLE FONTS -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="./css/1.styles.css">
  </head>
  <body>

  <div class="contenedor">
  <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

      <h2>Login or SignUp</h2>

      <form action="../dashboard/index.php" method="POST">
        <div class="form">
          <input name="email" type="text" placeholder="Enter your email">
        <input name="password" type="password" placeholder="Enter your Password">
        <input name="confirm_password" type="password" placeholder="Confirm Password">
        </div>
        <div class="submit">
          <input type="submit" value="Submit">
        </div>
      </form>
      <ul><p>a</p><a href="signup.php"> SignUp</a></ul>
       
  </div>
    
  </body>
</html>
