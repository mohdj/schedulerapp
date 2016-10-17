<?php
include('connection.php');

if ($_POST)
  	{
  $sql = "INSERT INTO daily_hifz_report (`its_teacher`,`its_student`,`date`,`attendance`,`murajeat_juz1`,`murajeat_marks1`,`murajeat_juz2`,`murajeat_marks2`,`murajeat_juz3`,`murajeat_marks3`,`jadeed_surat`,`jadeed_to_ayat`,`jadeed_marks`,`juzhali_from`,`juzhali_to`,`juzhali_marks`,`tasmee`,`tasmee_marks`) VALUES ('0','" . $_POST['studentits'] . "','" . $_POST['sf_amount_date'] . "','','" . $_POST['mr_juz1'] . "','" . $_POST['mr_marks1'] . "','" . $_POST['mr_juz2'] . "','" . $_POST['mr_marks2'] . "','" . $_POST['mr_juz3'] . "','" . $_POST['mr_marks3'] . "','" . $_POST['jd_surat'] . "','" . $_POST['jd_to'] . "','" . $_POST['jd_marks'] . "','" . $_POST['jh_from'] . "','" . $_POST['jh_to'] . "','" . $_POST['jh_marks'] . "','','')";
  mysqli_query($link, $sql) or die(mysqli_error($link));
  echo "success";

}