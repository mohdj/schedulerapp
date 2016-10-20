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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
 
    <style>
        body {
            background: #FFEAC3;
            padding-top: 5%;
            background-image: url("../images/pattern.jpg");
            background-repeat: repeat;
        }
        .login-box {
            padding: 10px 10px;
            border: 1px solid #444;
            background: #FFEAC3;
            border-radius: 4px 4px;
        }
        h2 {
            font-family: 'Pacifico', cursive;
        }
    </style>
</head>
<body>

    <div class="container-fluid">

        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="text-center"><h2>Muntasebaat Hifz Program</h2></div>
            </div>
            <div class="col-md-12"><br><br></div>

            <div class="col-md-4 col-md-offset-4">
                <div class="login-box">
                    <form method="POST">
                        <div class="form-group">
                            <label for="username">ITS ID:</label>
                            <input name="username" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input name="password" type="password" class="form-control">
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-success btn-block" value="Login" />
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-12"><br></div>
            <div class="col-md-4 col-md-offset-4">
                <div class="text-center"><em>Copyright &copy; 2016 Muntasebaat Hifz. All rights reserved.</em></div>
            </div>

        </div>
    </div>

</body>
</html>
