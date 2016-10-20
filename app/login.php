<?php
include("connection.php");
error_reporting(0);
session_start();

if (!is_null($_SESSION['login_user'])) {
    $temp = $_SESSION['login_user'];
    header("Location: searchdata.php?itsid=$temp");
}

if (!is_null($_SESSION['login_teacher'])) {
    header("Location: searchdata.php");
}


if($_SERVER["REQUEST_METHOD"] == "POST")
{
// username and password sent from Form
$myusername=mysqli_real_escape_string($link,$_POST['username']); 
$mypassword=mysqli_real_escape_string($link,$_POST['password']); 
$sql="SELECT ITS FROM students WHERE ITS='$myusername' and password='$mypassword'";
$result=mysqli_query($link,$sql);
$count=mysqli_num_rows($result);

$sql1="SELECT ITS FROM teachers WHERE ITS='$myusername' and password='$mypassword'";
$result1=mysqli_query($link,$sql1);
$count1=mysqli_num_rows($result1);


// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1)
{
    $_SESSION['login_user']=$myusername;
    header("location: searchdata.php?itsid=$myusername");
}
elseif ($count1 == 1) {
    $_SESSION['login_teacher']=$myusername;
    header("location: searchdata.php");
}
else 
{
echo "Your Login Name or Password is invalid";
}
}
?>


<!DOCTYPE html>
<html>
<head>
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
 
</head>
<body>
    <form method="POST">
  <fieldset>
    <legend>Login</legend>
    <br>
    <input type="text" name="username" value="" placeholder="ItsId">
    <br><br>
    <input type="password" name="password" value="" placeholder="Password">
    <br><br>
    <input type="submit" value="Login">
  </fieldset>
</form>
</body>
</html>
