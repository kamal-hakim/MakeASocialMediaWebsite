<?php
  require 'config/config.php';

  if (isset($_SESSION['username'])) {
    $userLoggedIn = $_SESSION['username'];
    $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");
    $user = mysqli_fetch_array($user_details_query);
  }
  else {
    header("Location: register.php");
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Welcome to Swirlfeed</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>

    <link rel="stylesheet" href="/assets/css/bootstrap.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>
    <div class="top_bar">
      <div class="logo">
        <a href="index.php">Swirlfeed</a>
      </div>

      <nav>
        <a href="#">
          <?php echo "Welcome " . $user['first_name']; ?>
        </a>
        <a href="index.php">
          <i class="fa fa-home fa-lg" aria-hidden="true"></i>
        </a>
        <a href="#">
          <i class="fa fa-envelope fa-lg" aria-hidden="true"></i>
        </a>
        <a href="#">
          <i class="fa fa-bell-o fa-lg" aria-hidden="true"></i>
        </a>
        <a href="#">
          <i class="fa fa-users fa-lg" aria-hidden="true"></i>
        </a>
        <a href="#">
          <i class="fa fa-cog fa-lg" aria-hidden="true"></i>
        </a>
      </nav>
    </div>

    <div class="wrapper">
