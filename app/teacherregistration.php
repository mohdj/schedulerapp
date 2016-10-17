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
    $sql = "INSERT INTO teachers(
                                        `ITS`,
                                        `password`,
                                        `Full_Name`,
                                        `Time`,
                                        `Residence`,
                                        `Hifzyear`,
                                        `Farigyear`,
                                        `Mobile`,
                                        `Email`
                                        )
                            VALUES (
                                    '$itsid',
                                    '$password',
                                    '$fullname',
                                    '$hifztime',
                                    '$residence',
                                    '$hafizyear',
                                    '$farigyear',
                                    '$mobile',
                                    '$email'
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
    <legend>Muntasebaat Huffaz Registration</legend>
    Full name:<br>
    <input type="text" name="fullname" value="">
    <br>
    Hifz Khidmat Time:<br>
    <input type="text" name="hifztime" value="">
    </br>
	ITS ID:<br>
    <input type="text" name="itsid" value="">
    <br>
  Password:<br>
    <input type="password" name="password" value="">
    <br>
	Place of Residence:<br>
    <input type="text" name="residence" value="">
    <br>
	Hafiz Year:<br>
    <input type="text" name="hafizyear" value="">
    <br>
	Jamea Farig Year:<br>
    <input type="text" name="farigyear" value="">
    <br>
	Mobile No:<br>
    <input type="text" name="mobile" value="">
    <br>
	Email ID:<br>
    <input type="email" name="email" value="">
	<br><br>
    <input type="submit" value="Submit">
  </fieldset>
</form>

</body>
</html>

