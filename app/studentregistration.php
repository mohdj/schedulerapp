<?php
include('connection.php');

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
if($_POST)
{
  $_POST['hifzdays'] = implode(', ', $_POST['hifzdays']);
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
                                        `Hifzdays`,
                                        `hifzsanad`
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
                                    '$hifzdays',
                                    '$hifzsanad'
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

  <div class="header" align="center">
    <h3><a href="/">Muntasebaat Hifz Registration</a></h3>
  </div>

  <form class="container-fluid" method="post">
    <div class="panel panel-default"><div class="panel-heading">Account Details</div>
      <div class="panel-body">
      	<p>
          Please provide your details to create an account with Muntasebat Hifz site. Make sure to remember or note down your password for future reference.
        </p>
        <div class="row">
          <div class="col-md-4 col-sm-12">
            <div class="form-group">
              <label>ITS ID</label>
              <input type="text" class="form-control" name="itsid" pattern="\d{8}" required="true" title="Please enter correct ITS ID">
            </div>
          </div>
           <div class="col-md-4 col-sm-12">
            <div class="form-group">
              <label>Create Password</label>
              <input type="password" class="form-control" name="password" required="true">
            </div>
          </div>
        </div>
      </div>
    </div>



    <div class="panel panel-default"><div class="panel-heading">Contact Details</div>
      <div class="panel-body">
        <p>
          Provide your Full name, including First, Last and Middle name. Skype and/or Gmail (hangout) will be used for conducting live session with your teacher. Your mobile no. should be whatsapp no. All important communication will be sent to mobile no and email address provided below.
        </p>
        <div class="row">
          <div class="col-md-8 col-sm-12">
            <div class="form-group">
              <label>Name</label>
              <input type="text" class="form-control" name="fullname" required="true">
            </div>
          </div>
          <div class="col-md-4 col-sm-12">
            <div class="form-group">
              <label for="email">Email address (Gmail Only)</label>
              <input type="email" class="form-control" name="email" required="true" pattern="^[_a-z0-9-]+(\.[_a-z0-9-]+)*@gmail.com$">
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

          <div class="col-md-4">
            <div class="form-group">
              <label for="residence">City of Residence</label>
              <input type="text" class="form-control" name="residence" required="true">
            </div>
          </div>
        </div>

      </div>
    </div>


    <div class="panel panel-default"><div class="panel-heading">Misc Details</div>
      <div class="panel-body">
        <p>
          Your Jamea Farig year in Hijri and any khidmat that you are currently performing. Also specify the Juz no. uptil which you have completed hifz. 
        </p>
        <div class="row">
          <div class="col-md-4 col-sm-12">
            <div class="form-group">
              <label for="farigyear">Jamea Farig Year (Hijri)</label>
              <input type="text" class="form-control" name="farigyear" required="true" pattern="\d{4}" title="Please enter correct Year" required="true">
            </div>
          </div>
          <div class="col-md-4 col-sm-12">
            <div class="form-group">
              <label for="khidmat">Khidmat (if any?)</label>
              <input type="text" class="form-control" name="khidmat" required="true">
            </div>
          </div>
          <div class="col-md-4 col-sm-12">
            <div class="form-group">
              <label for="hifzdonetill">Hifz Done Till</label>
              <input type="number" class="form-control" name="hifzdonetill" value="0" max="30" required="true">
            </div>
          </div>
          <div class="col-md-4 col-sm-12">
            <div class="form-group">
              <label for="hifzsanad">Hifz Sanad</label>
              <select class="form-control" name="hifzsanad">
                <option>None</option>
                <option>Juz Amma</option>
                <option>Sanah Ula</option>
                <option>Sanah Saniyah</option>
                <option>Sanah Salesah</option>
                <option>Hifz Tamam</option>
              </select>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="panel panel-default"><div class="panel-heading">Class Timing</div>
      <div class="panel-body">
        <p>
          On which days and time of the week will you be comfortable for attending classes. Please note you would require active internet connection during this time to attend live session.
        </p>
        <div class="row">
          <div class="col-md-4 col-sm-12">
            <div class="form-group">
              <label for="hifztime">Hifz Class Time (e.g 09:00-09:15)</label>
              <input type="text" class="form-control" name="hifztime" placeholder="e.g. 09:00-09:15,18:00-18:15" pattern="\d\d:\d\d-\d\d:\d\d" required="true">
            </div>
          </div>
          <div class="col-md-6 col-sm-12">
            <div class="form-group">
              <label for="hifzdays">Hifz Days (Select minimum 3 days)</label>
              <select class="form-control" multiple="multiple" name="hifzdays[]" required="true">
                  <option>Monday</option>
                  <option>Tuesday</option>
                  <option>Wednesday</option>
                  <option>Thursday</option>
                  <option>Friday</option>
              </select>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4 col-sm-12">
        <input class="btn btn-success btn-block" type="submit" value="Submit">
      </div>
    </div>
    
  </form>

  <div class="footer">
    <span>Copyright &copy; 2015-2016 Muntasebaat Hifz. All rights reserved.</span>
  </div>

</body>
</html>

