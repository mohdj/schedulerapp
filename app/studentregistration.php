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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <style>
      .header {
        min-height: 50px;
        background: #FFEAC3;
        text-transform: uppercase;
        text-align: center;
        border-bottom: 2px solid #704d0e;
        margin-bottom: 20px
      }
      .header h3 {
        margin: auto;
        line-height: 60px;
      }
    </style>
  </head>
<body>

  <div class="header">
    <h3>Muntasebaat Hifz Registration</h3>
  </div>

  <form class="container-fluid" method="post">

    <div class="row">
      <div class="col-md-4 col-sm-12">
        <div class="form-group">
          <label for="itsid">Its Id</label>
          <input type="number" class="form-control" name="itsid" >
        </div>
      </div>
      <div class="col-md-8 col-sm-12">
        <div class="form-group">
          <label for="fullname">Name</label>
          <input type="text" class="form-control" name="fullname" >
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4 col-sm-12">
        <div class="form-group">
          <label for="email">Email address</label>
          <input type="email" class="form-control" name="email" >
        </div>
      </div>
      <div class="col-md-4 col-sm-12">
        <div class="form-group">
          <label for="skype">Skype Id</label>
          <input type="text" class="form-control" name="skype" >
        </div>
      </div>
      <div class="col-md-4 col-sm-12">
        <div class="form-group">
          <label for="mobile">Mobile No.</label>
          <input type="text" class="form-control" name="mobile" >
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label for="email">Place of Residence</label>
          <input type="text" class="form-control" name="residence" >
        </div>
      </div>

      <div class="col-md-4 col-sm-12">
        <div class="form-group">
          <label for="email">Jamea Farig Year</label>
          <input type="text" class="form-control" name="farigyear" >
        </div>
      </div>
      <div class="col-md-4 col-sm-12">
        <div class="form-group">
          <label for="skype">Khidmat (if any?)</label>
          <input type="text" class="form-control" name="khidmat" >
        </div>
      </div>
      <div class="col-md-4 col-sm-12">
        <div class="form-group">
          <label for="mobile">Hifz Done Till</label>
          <input type="text" class="form-control" name="hifzdonetill" >
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4 col-sm-12">
        <div class="form-group">
          <label for="itsid">Hifz Class Time</label>
          <input type="text" class="form-control" name="hifztime" >
        </div>
      </div>
      <div class="col-md-6 col-sm-12">
        <div class="form-group">
          <label for="fullname">Hifz Days</label>
          <input type="text" class="form-control" name="hifzdays" >
        </div>
      </div>

    </div>

    <input class="btn btn-success" type="submit" value="Submit">
  </form>

</body>
</html>
