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

  if ($reportname == 'all_student') {
    $query = "SELECT * FROM students";
  } elseif ($reportname == 'all_teacher') {
    $query = "SELECT * FROM teachers";
  } else ($reportname == 'test_report') {
    $query = "SELECT * FROM daily_hifz_report limit 5";
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

  </body>
</html>
