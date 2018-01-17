<?php
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
$error_array = ""; //Holds error messages

if(isset($_POST['register_button']))
{
    //Registration form values

    //First name
    $fname = strip_tags($_POST['reg_fname']); //strip_tags is for security purpose. It strips out HTML tags in the form
    $fname = str_replace(' ', '', $fname); // remove spaces
    $fname = ucfirst(strtolower($fname)); // uppercase first letter

    //Last name
    $lname = strip_tags($_POST['reg_lname']); //strip_tags is for security purpose. It strips out HTML tags in the form
    $lname = str_replace(' ', '', $lname); // remove spaces
    $lname = ucfirst(strtolower($lname)); // uppercase first letter

    //email
    $em = strip_tags($_POST['reg_email']); //strip_tags is for security purpose. It strips out HTML tags in the form
    $em = str_replace(' ', '', $em); // remove spaces
    $em = ucfirst(strtolower($em)); // uppercase first letter

    //email confirmation
    $em2 = strip_tags($_POST['reg_email2']); //strip_tags is for security purpose. It strips out HTML tags in the form
    $em2 = str_replace(' ', '', $em2); // remove spaces
    $em2 = ucfirst(strtolower($em2)); // uppercase first letter

    //password
    $password = strip_tags($_POST['reg_password']); //strip_tags is for security purpose. It strips out HTML tags in the form

    //password confirmation
    $password = strip_tags($_POST['reg_password2']); //strip_tags is for security purpose. It strips out HTML tags in the form

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
            echo "Email already exist";
          }
        }
        else {
          echo "Email not valid!";
        }

        if(strlen($fname > 25) || strlen($fname) < 2) {
          echo "Your first name must be between 2 and 25 characters";
        }

        if(strlen($lname > 25) || strlen($lname) < 2) {
          echo "Your last name must be between 2 and 25 characters";
        }

        if($password != $password2) {
          echo "Passwords do not match!";
        }
        else {
          if(preg_match('/[^A-Za-z0-9]/', $password)) { //regular expression to check must be A-Z, a-z, and contain numbers
              echo "Your password can only contain english characters or numbers";
          }
        }

        if(strlen($password > 30) || strlen($password) < 5) {
          echo "Your password must be between 5 and 30 characters long";
        }
    }
    else {
      echo "Emails don't match";
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
      <input type="text" name="reg_fname" placeholder="First Name" required>
      <br>
      <input type="text" name="reg_lname" placeholder="Last Name" required>
      <br>
      <input type="email" name="reg_email" placeholder="Email" required>
      <br>
      <input type="email" name="reg_email2" placeholder="Confirm Email" required>
      <br>
      <input type="password" name="reg_password" placeholder="Password" required>
      <br>
      <input type="password" name="reg_password2" placeholder="Confirm Password" required>
      <br>
      <input type="submit" name="register_button" value="Register">
    </form>
  </body>
</html>
