<?php
$con = mysqli_connect("localhost", "root", "", "social"); //conection variable

if(mysqli_connect_errno())
{
  echo "Failed to connect: " . mysqli_connect_errno();
}

$query = mysqli_query($con, "INSERT INTO test VALUES('1', 'KamalHakim')");
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Welcome to Swirlfeed</title>
  </head>
  <body>
    Hello Kamal Hakim!
  </body>
</html>
