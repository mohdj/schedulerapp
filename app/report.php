<?php
session_start();
include('connection.php');
error_reporting(0);
if (!is_null($_SESSION['login_user'])  || !is_null($_SESSION['login_teacher'])) {
 
}
else {
  header("Location: login.php");
  exit; 
}
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
if ($_POST) {
  $report_name = $_POST['reportname'];

  switch ($report_name) {
      case "all_student":
          $query = "SELECT `ITS`, `Fullname`, `Farigyear`, `HifzSipara`, `hifzsanad`, `Residence`, `Khidmat`, `Email`, `Skype`, `Mobile`, `Classtime`, `Hifzdays` FROM `students`;";
          break;
      case "all_teacher":
          $query = "SELECT `ITS`, `Full_Name`, `Time`, `Residence`, `Hifzyear`, `Farigyear`, `Mobile`, `Whatsapp`, `Email` FROM `teachers`;";
          break;
      case "today_hifz_report":
          $query = "SELECT  `students`.`fullname` as `Student_Name`,  `teachers`.`full_name` as `Teacher_Name` , `daily_hifz_report`.`date`, `daily_hifz_report`.`attendance`, `daily_hifz_report`.`murajeat_juz1`, `daily_hifz_report`.`murajeat_marks1`, `daily_hifz_report`.`murajeat_juz2`, `daily_hifz_report`.`murajeat_marks2`, `daily_hifz_report`.`murajeat_juz3`, `daily_hifz_report`.`murajeat_marks3`, `daily_hifz_report`.`jadeed_surat`, `daily_hifz_report`.`jadeed_to_ayat`, `daily_hifz_report`.`jadeed_marks`, `daily_hifz_report`.`juzhali_from`, `daily_hifz_report`.`juzhali_to`, `daily_hifz_report`.`juzhali_marks`, `daily_hifz_report`.`tasmee`, `daily_hifz_report`.`tasmee_marks` FROM  `daily_hifz_report` JOIN  `students` ON  `daily_hifz_report`.`its_student` =  `students`.`its` JOIN  `teachers` ON  `daily_hifz_report`.`its_teacher` =  `teachers`.`its` WHERE  `daily_hifz_report`.`date` = DATE(NOW());";
          break;
      case "yesterday_hifz_report":
          $query = "SELECT  `students`.`fullname` as `Student_Name`,  `teachers`.`full_name` as `Teacher_Name` , `daily_hifz_report`.`date`, `daily_hifz_report`.`attendance`, `daily_hifz_report`.`murajeat_juz1`, `daily_hifz_report`.`murajeat_marks1`, `daily_hifz_report`.`murajeat_juz2`, `daily_hifz_report`.`murajeat_marks2`, `daily_hifz_report`.`murajeat_juz3`, `daily_hifz_report`.`murajeat_marks3`, `daily_hifz_report`.`jadeed_surat`, `daily_hifz_report`.`jadeed_to_ayat`, `daily_hifz_report`.`jadeed_marks`, `daily_hifz_report`.`juzhali_from`, `daily_hifz_report`.`juzhali_to`, `daily_hifz_report`.`juzhali_marks`, `daily_hifz_report`.`tasmee`, `daily_hifz_report`.`tasmee_marks` FROM  `daily_hifz_report` JOIN  `students` ON  `daily_hifz_report`.`its_student` =  `students`.`its` JOIN  `teachers` ON  `daily_hifz_report`.`its_teacher` =  `teachers`.`its` WHERE  `daily_hifz_report`.`date` = SUBDATE(DATE(NOW()), 1) ;";
          break;
      default:
          $query = "SELECT 'No report name provided.' as `Error`";
          break;
  }
  
  $result = mysqli_query($link, $query);
  $all_property = array();  //declare an array for saving property
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
      <h3><a href="/">Admin Reports</a></h3>
    </div>

   <div class="container-fluid">
      <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title">Search Reports</h3>
        </div>

        <div class="panel-body">
          <p>
            Enter Student's ITS ID to view / submit new hifz reports.
          </p>
          <form class="form-horizontal" method="post">
            <div class="col-md-8 form-group">
              <select class="form-control" name="reportname">
                <option value="test_report">Test Report</option>
                <option value="all_student">All Student Data</option>
                <option value="all_teacher">All Teacher Data</option>
              </select>
            </div>
            <div class="col-md-2 col-md-offset-2">
              <input class="btn btn-success btn-block" type="submit" value="Fetch"/>
            </div>
          </form>
        </div>
      </div>

     <div class="table-responsive">
       <table class="table table-bordered table-hover">
         <thead>
           <tr>
             <?php
               //showing fields as header, and keeping them in all_propert array
               while ($property = mysqli_fetch_field($result)) {
                 array_push($all_property, $property->name);
             ?>
               <td><?php echo $property->name; ?></td>
             <?php } ?>
           </tr>
         </thead>

         <tbody>
           <?php
             //showing all data
             while ($row = mysqli_fetch_array($result)) {
                 echo "<tr>";
                 foreach ($all_property as $item) {
                     echo '<td>' . $row[$item] . '</td>'; //get items using property value
                 }
                 echo '</tr>';
             }
             echo "</table>";  
           ?>
         </tbody>
       </table>
     </div>
    
   </div>

   <div class="footer">
    <span>Copyright &copy; 2015-2016 Muntasebaat Hifz. All rights reserved.</span>
   </div>
  </body>
</html>
