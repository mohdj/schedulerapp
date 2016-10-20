<?php
include('connection.php');

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
if($_POST)
{
  $raw_data = $_POST;
  function sanitize($v)
  {
    return addslashes($v);
  }
  $data = array_map("sanitize",$raw_data);
  extract($data);
    $sql = "INSERT INTO students(
                                        `ITS`,
                                        `password`,
                                        `Fullname`,
                                        `Farigyear`,
                                        `HifzSipara`,
                                        `Residence`,
                                        `Khidmat`,
                                        `Email`,
                                        `Skype`,
                                        `Mobile`,
                                        `Classtime`,
                                        `Hifzdays`
                                        )
                            VALUES (
                                    '$itsid',
                                    '$password',
                                    '$fullname',
                                    '$farigyear',
                                    '$hifzdonetill',
                                    '$residence',
                                    '$khidmat',
                                    '$email',
                                    '$skype',
                                    '$mobile',
                                    '$hifztime',
                                    '$hifzdays'
                                    )";
  mysqli_query($link,$sql) or die(mysqli_error($link));
  mysqli_close($link);

  echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Data Submitted successfully.')
    </SCRIPT>");
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Hifz Program</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/index.css">
  </head>
<body>

  <div class="header">
    <h3>Muntasebaat Hifz Registration</h3>
  </div>

  <form class="container-fluid" method="post">

    <div class="row">
      <div class="col-md-4 col-sm-12">
        <div class="form-group">
          <label for="itsid">ITS ID</label>
          <input type="text" class="form-control" name="itsid" pattern="\d{8}" required="true" title="Please enter correct ITS ID">
        </div>
      </div>
       <div class="col-md-4 col-sm-12">
        <div class="form-group">
          <label for="password">Create Password</label>
          <input type="password" class="form-control" name="password" required="true">
        </div>
      </div>
      <div class="col-md-4 col-sm-12">
        <div class="form-group">
          <label for="fullname">Name</label>
          <input type="text" class="form-control" name="fullname" required="true">
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4 col-sm-12">
        <div class="form-group">
          <label for="email">Email address (Gmail if possible)</label>
          <input type="email" class="form-control" name="email" required="true">
        </div>
      </div>
      <div class="col-md-4 col-sm-12">
        <div class="form-group">
          <label for="skype">Skype Id</label>
          <input type="text" class="form-control" name="skype" required="true">
        </div>
      </div>
      <div class="col-md-4 col-sm-12">
        <div class="form-group">
          <label for="mobile">Mobile No.</label>
          <input type="text" class="form-control" name="mobile" required="true" placeholder="+919999999999" pattern="^\+[1-9]{1}\d{10,14}">
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label for="email">Place of Residence</label>
          <input type="text" class="form-control" name="residence" required="true">
        </div>
      </div>

      <div class="col-md-4 col-sm-12">
        <div class="form-group">
          <label for="email">Jamea Farig Year</label>
          <input type="text" class="form-control" name="farigyear" required="true" pattern="\d{4}" title="Please enter correct Year">
        </div>
      </div>
      <div class="col-md-4 col-sm-12">
        <div class="form-group">
          <label for="skype">Khidmat (if any?)</label>
          <input type="text" class="form-control" name="khidmat">
        </div>
      </div>
      <div class="col-md-4 col-sm-12">
        <div class="form-group">
          <label for="mobile">Hifz Done Till</label>
          <input type="number" class="form-control" name="hifzdonetill" value='0' max="30">
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4 col-sm-12">
        <div class="form-group">
          <label for="itsid">Hifz Class Time</label>
          <input type="text" class="form-control" name="hifztime" placeholder="e.g. 18-18:30">
        </div>
      </div>
      <div class="col-md-6 col-sm-12">
        <div class="form-group">
          <label for="fullname">Hifz Days</label>
          <input type="text" class="form-control" name="hifzdays" placeholder="e.g. wed,thurs">
        </div>
      </div>

    </div>

    <input class="btn btn-success" type="submit" value="Submit">
  </form>

  <div class="footer">
    <span>Copyright &copy; 2015-2016 Muntasebaat Hifz. All rights reserved.</span>
  </div>
</body>
</html>

