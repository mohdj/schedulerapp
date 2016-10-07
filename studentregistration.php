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
<body>

<form method="post">
  <fieldset>
    <legend>Muntasebaat Hifz Registration</legend>
    Full name:<br>
    <input type="text" name="fullname" value="">
    <br>
    Jamea Farig Year :<br>
    <input type="text" name="farigyear" value="">
    </br>
	Hifz Done Till:<br>
    <input type="text" name="hifzdonetill" value="">
    <br>
	Place of Residence:<br>
    <input type="text" name="residence" value="">
    <br>
	Khidmat, if any:<br>
    <input type="text" name="khidmat" value="">
    <br>
	Email Id:<br>
    <input type="text" name="email" value="">
    <br>
	Skype ID :<br>
    <input type="text" name="skype" value="">
    <br>
	Mobile No:<br>
    <input type="text" name="mobile" value="">
    <br>
	Hifz Class Time:<br>
    <input type="text" name="hifztime" value="">
    <br>
	Hifz Days:<br>
    <input type="text" name="hifzdays" value="">
    <br>
	ITS ID *:<br>
    <input type="text" name="itsid" value="">
	<br><br>
    <input type="submit" value="Submit">
  </fieldset>
</form>

</body>
</html>

