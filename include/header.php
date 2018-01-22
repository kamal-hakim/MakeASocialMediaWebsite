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
  </head>
  <body>
