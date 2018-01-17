<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "social"); //conection variable

if(mysqli_connect_errno())
{
  echo "Failed to connect: " . mysqli_connect_errno();
}

//Declare variable to prevent errors
$fname = ""; //First name
$lname = ""; //Last name
$em = ""; //Email
$em2 = ""; //Email confirmation
$password = ""; //Password
$password2 = ""; //Password confirmation
$date = ""; //Sign up date
$error_array = array(); //Holds error messages

if(isset($_POST['register_button']))
{
    //Registration form values

    //First name
    $fname = strip_tags($_POST['reg_fname']); //strip_tags is for security purpose. It strips out HTML tags in the form
    $fname = str_replace(' ', '', $fname); // remove spaces
    $fname = ucfirst(strtolower($fname)); // uppercase first letter
    $_SESSION['reg_fname'] = $fname; //stores first name into session variable
    //Last name
    $lname = strip_tags($_POST['reg_lname']); //strip_tags is for security purpose. It strips out HTML tags in the form
    $lname = str_replace(' ', '', $lname); // remove spaces
    $lname = ucfirst(strtolower($lname)); // uppercase first letter
    $_SESSION['reg_lname'] = $lname; //stores last name into session variable

    //email
    $em = strip_tags($_POST['reg_email']); //strip_tags is for security purpose. It strips out HTML tags in the form
    $em = str_replace(' ', '', $em); // remove spaces
    $em = ucfirst(strtolower($em)); // uppercase first letter
    $_SESSION['reg_email'] = $em; //stores email into session variable

    //email confirmation
    $em2 = strip_tags($_POST['reg_email2']); //strip_tags is for security purpose. It strips out HTML tags in the form
    $em2 = str_replace(' ', '', $em2); // remove spaces
    $em2 = ucfirst(strtolower($em2)); // uppercase first letter
    $_SESSION['reg_email2'] = $em2; //stores email into session variable

    //password
    $password = strip_tags($_POST['reg_password']); //strip_tags is for security purpose. It strips out HTML tags in the form

    //password confirmation
    $password2 = strip_tags($_POST['reg_password2']); //strip_tags is for security purpose. It strips out HTML tags in the form

    //Date
    $date = date("Y-m-d"); //gets current date

    if($em == $em2) {
        // check if email is in valid format
        if(filter_var($em, FILTER_VALIDATE_EMAIL)) {
          $em = filter_var($em, FILTER_VALIDATE_EMAIL);

          //check if email is already exist
          $e_check = mysqli_query($con, "SELECT email FROM users WHERE email='$em'");

          //Count the number of rows returned
          $num_rows = mysqli_num_rows($e_check);

          if($num_rows > 0) {
            array_push($error_array, "Email already exist<br>");
          }
        }
        else {
          array_push($error_array, "Email format is not valid<br>");
        }

        if(strlen($fname > 25) || strlen($fname) < 2) {
          array_push($error_array, "Your first name must be between 2 and 25 characters<br>");
        }

        if(strlen($lname > 25) || strlen($lname) < 2) {
          array_push($error_array, "Your last name must be between 2 and 25 characters<br>");
        }

        if($password != $password2) {
          array_push($error_array, "Passwords do not match!<br>");
        }
        else {
          if(preg_match('/[^A-Za-z0-9]/', $password)) { //regular expression to check must be A-Z, a-z, and contain numbers
              array_push($error_array, "Your password can only contain english characters or numbers");
          }
        }

        if(strlen($password > 30) || strlen($password) < 5) {
          array_push($error_array, "Your password must be between 5 and 30 characters long");
        }
    }
    else {
      array_push($error_array, "Email do not match<br>");
    }
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Welcome to Swirlfeed</title>
  </head>
  <body>
    <form class="" action="register.php" method="post">
      <input type="text" name="reg_fname" placeholder="First Name" value ="<?php
      if(isset($_SESSION['reg_fname'])) {
          echo $_SESSION['reg_fname'];
      }
      ?>" required>

      <br>
      <input type="text" name="reg_lname" placeholder="Last Name" value ="<?php
      if(isset($_SESSION['reg_lname'])) {
          echo $_SESSION['reg_lname'];
      }
      ?>"required>
      <br>
      <input type="email" name="reg_email" placeholder="Email" value ="<?php
      if(isset($_SESSION['reg_email'])) {
          echo $_SESSION['reg_email'];
      }
      ?>" required>
      <br>
      <input type="email" name="reg_email2" placeholder="Confirm Email" value ="<?php
      if(isset($_SESSION['reg_email2'])) {
          echo $_SESSION['reg_email2'];
      }
      ?>" required>
      <br>
      <input type="password" name="reg_password" placeholder="Password" required>
      <br>
      <input type="password" name="reg_password2" placeholder="Confirm Password" required>
      <br>
      <input type="submit" name="register_button" value="Register">
    </form>
  </body>
</html>
