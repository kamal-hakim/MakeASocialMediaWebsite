<?php
  require 'config/config.php';

  if (isset($_SESSION['username'])) {
    $userLoggedIn = $_SESSION['username'];
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
    <link rel="stylesheet" href="/assets/bootstrap.css">
  </head>
  <body>
