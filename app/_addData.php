<?php
include('connection.php');

if ($_POST['hifztype'] == 'Murajeat')
  	{
  $sql = "INSERT INTO daily_hifz_report (`its_teacher`,`its_student`,`date`,`attendance`,`murajeat`,`murajeat_marks`,`jadeed`,`jadeed_marks`,`juzhali`,`juzhali_marks`,`jadeed_ayats`,`tasmee`,`tasmee_marks`) VALUES ('0','" . $_POST['studentits'] . "','" . $_POST['sf_amount_date'] . "','','" . $_POST['hifztype'] . "','" . $_POST['Amount'] . "','','','','','','','')";
  mysqli_query($link, $sql) or die(mysqli_error($link));
  echo "success";

}