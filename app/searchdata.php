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
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
if($_GET)
{
    $student_itsid = $_GET['itsid'];
    $query="SELECT * FROM (SELECT * FROM daily_hifz_report WHERE its_student = '".addslashes($_GET['itsid'])."' ORDER BY id DESC limit 5) sub ORDER BY id ASC;";
    $result = mysqli_query($link,$query);
    $query1="SELECT * FROM students where ITS = '".addslashes($_GET['itsid'])."' ";
    $values = mysqli_fetch_assoc(mysqli_query($link,$query1));
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
<div class="container-fluid">
  <div class="header row">
    <div class="col-md-8">
      <h3><a href="/">Muntasebaat Hifz</a></h3>
    </div>
    <div class="col-md-2 col-md-offset-2">
      <a href="logout.php">Logout</a>
    </div>
  </div>

  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
           <h4 class="modal-title">Enter hifz data</h4>
         </div>
         <div class="modal-body">
           <div id="hisabform">

            <div class="form-group row">
              <label for="date" class="col-xs-2 col-form-label">Date</label>
              <div class="col-xs-10">
                <input class="form-control" type="date" name="sf_amount_date" value="<?php echo date("Y-m-d") ?>" >
              </div>
            </div>

            <legend>Murajeat</legend>

            <div class="form-group row">
              <label for="mr_juz1" class="col-xs-2 col-form-label">Juz 1</label>
              <div class="col-xs-4">
                <input class="form-control" type="number" name="mr_juz1" placeholder="30" min="1" max="30">
              </div>

              <label for="mr_marks1" class="col-xs-2 col-form-label">Marks</label>
              <div class="col-xs-4">
                <input class="form-control" type="number" name="mr_marks1" placeholder="2" min="1" max="10">
              </div>
            </div>

            <div class="form-group row">
              <label for="mr_juz2" class="col-xs-2 col-form-label">Juz 2</label>
              <div class="col-xs-4">
                <input class="form-control" type="number" name="mr_juz2" placeholder="23" min="1" max="30">
              </div>

              <label for="mr_marks2" class="col-xs-2 col-form-label">Marks</label>
              <div class="col-xs-4">
                <input class="form-control" type="number" name="mr_marks2" placeholder="5" min="1" max="10">
              </div>
            </div>

            <div class="form-group row">
              <label for="mr_juz3" class="col-xs-2 col-form-label">Juz 3</label>
              <div class="col-xs-4">
                <input class="form-control" type="number" name="mr_juz3" placeholder="18" min="1" max="30">
              </div>

              <label for="mr_marks3" class="col-xs-2 col-form-label">Marks</label>
              <div class="col-xs-4">
                <input class="form-control" type="number" name="mr_marks3" placeholder="8" min="1" max="10">
              </div>
            </div>

            <legend>Juzhali</legend>

            <div class="form-group row">
              <label for="jh_from" class="col-xs-2 col-form-label">From Page</label>
              <div class="col-xs-2">
                <input class="form-control" type="number" name="jh_from">
              </div>

              <label for="jh_to" class="col-xs-2 col-form-label">To Page</label>
              <div class="col-xs-2">
                <input class="form-control" type="number" name="jh_to">
              </div>

              <label for="jh_marks" class="col-xs-2 col-form-label">Marks</label>
              <div class="col-xs-2">
                <input class="form-control" type="number" name="jh_marks" placeholder="8" min="1" max="10">
              </div>
            </div>

            <legend>Jadeed</legend>

            <div class="form-group row">
              <label for="jd_surat" class="col-xs-2 col-form-label">Surat no.</label>
              <div class="col-xs-2">
                <input class="form-control" type="number" name="jd_surat" min="1"  max="114" placeholder="112">
              </div>

              <label for="jd_to" class="col-xs-2 col-form-label">To Ayaat</label>
              <div class="col-xs-2">
                <input class="form-control" type="number" name="jd_to">
              </div>

              <label for="jd_marks" class="col-xs-2 col-form-label">Marks</label>
              <div class="col-xs-2">
                <input class="form-control" type="number" name="jd_marks" placeholder="8" min="1" max="10">
              </div>
            </div>

             <input type="hidden" name="studentits"/>
             <input type="hidden" name="teacherits"/>
           </div>
         </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" name="cancel">Close</button>
        <button type="button" class="btn btn-primary" name="save">Save changes</button>
      </div>

    </div>
  </div>

  
<!-- This will be displayed only when teacher is logged In -->
<?php
if (!empty($_SESSION['login_teacher'])) {
?>
<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title">Search Hifz Reports</h3>
  </div>

  <div class="panel-body">
    <p>
      Enter Student's ITS ID to view / submit new hifz reports.
    </p>
    <form class="form-horizontal">
      <div class="col-md-8 form-group">
        <input type="number" class="form-control" name="itsid" placeholder="Student's ITS ID"/>
      </div>
      <div class="col-md-2 col-md-offset-2">
        <input class="btn btn-success btn-block" type="submit" value="Search"/>
      </div>
    </form>
  </div>
</div>
<?php
}
if (!empty($values['Fullname']))
{
?>
<div class="page-header"><h3>Hifz Reports</h3></div>
<h4><?php echo $values['Fullname']; ?></h4>

<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th rowspan="2">Date</th>
      <?php
       if (!empty($_SESSION['login_teacher']))
        {
      ?>
      <th rowspan="2">Teacher ITS</th>
      <th rowspan="2">Student ITS</th>
      <?php } ?>
      <th colspan="2">Murajeat 1</th>
      <th colspan="2">Murajeat 2</th>
      <th colspan="2">Murajeat 3</th>
      <th colspan="3">Juzhali</th>
      <th colspan="3">Jadeed</th>
      
      <?php
       if (!empty($_SESSION['login_teacher']))
        {
        ?>
      <th rowspan="2">Action</th>
      <?php } ?>
    </tr>
    <tr>
      <th>Juz no</th>
      <th>Marks</th>
      <th>Juz No</th>
      <th>Marks</th>
      <th>Juz No</th>
      <th>Marks</th>
      <th>From Page</th>
      <th>To Page</th>
      <th>Marks</th>
      <th>Surat</th>
      <th>Ayaat</th>
      <th>Marks</th>
    </tr>
  </thead>

  <tbody>
    <?php
      while($values = mysqli_fetch_assoc($result))
      {
    ?>
    <tr>
      <td><?php echo $values['date']; ?></td>
      <?php
       if (!empty($_SESSION['login_teacher']))
        {
        ?>
      <td><?php echo $values['its_teacher']; ?></td>
      <td><?php echo $values['its_student']; ?></td>
      <?php } ?>
      <td><?php echo $values['murajeat_juz1']; ?></td>
      <td><?php echo $values['murajeat_marks1']; ?></td>
      <td><?php echo $values['murajeat_juz2']; ?></td>
      <td><?php echo $values['murajeat_marks2']; ?></td>
      <td><?php echo $values['murajeat_juz3']; ?></td>
      <td><?php echo $values['murajeat_marks3']; ?></td>
      <td><?php echo $values['juzhali_from']; ?></td>
      <td><?php echo $values['juzhali_to']; ?></td>
      <td><?php echo $values['juzhali_marks']; ?></td>
      <td><?php echo $values['jadeed_surat']; ?></td>
      <td><?php echo $values['jadeed_to_ayat']; ?></td>
      <td><?php echo $values['jadeed_marks']; ?></td>
      <?php
       if (!empty($_SESSION['login_teacher']))
        {
        ?>
      <td></td>
      <?php } ?>
    </tr>
    <?php
       } 
       if (!empty($_SESSION['login_teacher']))
        {
        ?>
    <tr>
        <td colspan='15'></td>
        <td><a href="#" data-key="payhisab" data-teacher-its="<?php echo $_SESSION['login_teacher']; ?>" data-its="<?php echo $student_itsid; ?>"><img src="images/add.png" style="width:20px;height:20px;"></a></td>
    </tr>
    <?php } ?>
  </tbody>
</table>
<?php } ?>
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>

<script>
$(function(){
      $(function(){
      var hisabform = $('#myModal');
      hisabform.hide();
      $('[data-key="payhisab"]').click(function() {
        $('[name="studentits"]', hisabform).val($(this).attr('data-its'));
        $('[name="teacherits"]', hisabform).val($(this).attr('data-teacher-its'));
        hisabform.show();
      });
      $('[name="save"]').click(function() {
        var data = '';
        $('input[type!="button"],select', hisabform).each(function() {
          data = data + $(this).attr('name') + '=' + $(this).val() + '&';
        });
        $.ajax({
          method: 'post',
          url: '_addData.php',
          async: 'false',
          data: data,
          success: function(data) {
            if(data == 'success') {
              alert('Data sucessfully updated.');
              hisabform.hide();
              location.reload();
            // } else if(data == 'DuplicateReceiptNo') {
            //   alert('Receipt number already exists in database');
            }
            else {
              alert('Update failed. Refresh the page and try again.');
            }
          },
          error: function() {
            alert('Try again');
          }
        });
      });
      $('[name="cancel"]').click(function() {
        hisabform.hide();
      });
      
      });
    });
</script>
  <div class="footer">
   <span>Copyright &copy; 2015-2016 Muntasebaat Hifz. All rights reserved.</span>
  </div>
</div>
</body>
</html>