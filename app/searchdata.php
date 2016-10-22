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

  <div class="header row" style="text-align: left;">
    <div class="col-md-12"><h3><a href="/">Muntasebaat Hifz</a></h3></div>
    <div class="banner col-md-12"><?php echo $_SESSION['login_teacher']; ?> <?php echo $_SESSION['login_user']; ?> | <a href="logout.php">Logout</a></div>
  </div>
  
<!-- This will be displayed only when teacher is logged In -->
<?php
  if (!empty($_SESSION['login_teacher'])) {
?>
<div>
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
          <input class="btn btn-primary btn-block" type="submit" value="Search"/>
        </div>
      </form>
    </div>
  </div>
</div>
<?php } ?>


<?php
  if (!empty($values['Fullname'])) {
?>
<div>
  <div class="page-header"><h3>Hifz Reports</h3></div>
  <h4><?php echo $values['Fullname']; ?></h4>
</div>

<div class="table-responsive">
<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th rowspan="2">Date</th>
      <th colspan="2">Murajeat 1</th>
      <th colspan="2">Murajeat 2</th>
      <th colspan="2">Murajeat 3</th>
      <th colspan="3">Juzhali</th>
      <th colspan="2">Tasmee</th>
      <th colspan="3">Jadeed</th>
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
      <th>Juz No</th>
      <th>Marks</th>
      <th>Surat</th>
      <th>Ayaat</th>
      <th>Marks</th>
    </tr>
  </thead>

  <tbody>
    <?php
      while($values = mysqli_fetch_assoc($result)) {
    ?>
    <tr>
      <td><?php echo $values['date']; ?></td>
      <td><?php echo $values['murajeat_juz1']; ?></td>
      <td><?php echo $values['murajeat_marks1']; ?></td>
      <td><?php echo $values['murajeat_juz2']; ?></td>
      <td><?php echo $values['murajeat_marks2']; ?></td>
      <td><?php echo $values['murajeat_juz3']; ?></td>
      <td><?php echo $values['murajeat_marks3']; ?></td>
      <td><?php echo $values['juzhali_from']; ?></td>
      <td><?php echo $values['juzhali_to']; ?></td>
      <td><?php echo $values['juzhali_marks']; ?></td>
      <td><?php echo $values['tasmee']; ?></td>
      <td><?php echo $values['tasmee_marks']; ?></td>
      <td><?php echo $values['jadeed_surat']; ?></td>
      <td><?php echo $values['jadeed_to_ayat']; ?></td>
      <td><?php echo $values['jadeed_marks']; ?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>
</div>

  <?php
     if (!empty($_SESSION['login_teacher'])) {
  ?>

  <div class="page-header"><h3>Add New Report</h3></div>

  <form class="form ro">
    <input type="hidden" name="studentits" value="12345677">
    <input type="hidden" name="teacherits" value="12345678">

    <div class="form-group">
      <label>Date</label>
      <input class="form-contro" type="date" name="sf_amount_date" value="2016-10-21">
    </div>

    <div class="row">
    <div class="entry-box col-md-6">
      <div class="entry-box-body">
        <p>
          <strong>Murajaat 1 Details:</strong>
        </p>
        <div class="row">
           <div class="col-md-4 col-sm-12">
            <div class="form-group">
              <label>Juz No</label>
              <input class="form-control" type="number" name="mr_juz1" placeholder="1 - 30">
            </div>
          </div>
          <div class="col-md-4 col-sm-12">
            <div class="form-group">
              <label>Marks</label>
              <input class="form-control" type="number" name="mr_marks1" placeholder="? out of 10">
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="entry-box col-md-6">
      <div class="entry-box-body">
        <p>
          <strong>Murajaat 2 Details:</strong>
        </p>
        <div class="row">
           <div class="col-md-4 col-sm-12">
            <div class="form-group">
              <label>Juz No</label>
              <input class="form-control" type="number" name="mr_juz2" placeholder="1 - 30">
            </div>
          </div>
          <div class="col-md-4 col-sm-12">
            <div class="form-group">
              <label>Marks</label>
              <input class="form-control" type="number" name="mr_marks2" placeholder="? out of 10">
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="entry-box col-md-6">
      <div class="entry-box-body">
        <p>
          <strong>Murajaat 3 Details:</strong>
        </p>
        <div class="row">
           <div class="col-md-4 col-sm-12">
            <div class="form-group">
              <label>Juz No</label>
              <input class="form-control" type="number" name="mr_juz3" placeholder="1 - 30">
            </div>
          </div>
          <div class="col-md-4 col-sm-12">
            <div class="form-group">
              <label>Marks</label>
              <input class="form-control" type="number" name="mr_marks3" placeholder="? out of 10">
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="entry-box col-md-6">
      <div class="entry-box-body">
        <p>
          <strong>Juz Hali Details:</strong>
        </p>
        <div class="row">
          <div class="col-md-4 col-sm-12">
            <div class="form-group">
              <label>From Page No</label>
              <input class="form-control" type="number" name="jh_from" placeholder="1 - 20">
            </div>
          </div>
           <div class="col-md-4 col-sm-12">
            <div class="form-group">
              <label>To Page No</label>
              <input class="form-control" type="number" name="jh_to" placeholder="1 to 20">
            </div>
          </div>
          <div class="col-md-4 col-sm-12">
            <div class="form-group">
              <label>Marks</label>
              <input class="form-control" type="number" name="jh_marks" placeholder="? out of 10">
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="entry-box col-md-6">
      <div class="entry-box-body">
        <p>
          <strong>Jadeed Details:</strong>
        </p>
        <div class="row">
          <div class="col-md-4 col-sm-12">
            <div class="form-group">
              <label>Surat</label>
              <input class="form-control" type="text" name="jd_surat" placeholder="surat name">
            </div>
          </div>
           <div class="col-md-4 col-sm-12">
            <div class="form-group">
              <label>To Ayat No</label>
              <input class="form-control" type="number" name="jd_to" placeholder="">
            </div>
          </div>
          <div class="col-md-4 col-sm-12">
            <div class="form-group">
              <label>Marks</label>
              <input class="form-control" type="number" name="jd_marks" placeholder="? out of 10">
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="entry-box col-md-6">.</div>

    <div class="col-md-12">
      <button type="button" class="btn btn-success" name="save">Save changes</button>
    </div>
  </div>
  </form>
  <?php } ?>

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
  <div class="footer row">
   <span>Copyright &copy; 2015-2016 Muntasebaat Hifz. All rights reserved.</span>
  </div>
</div>

</body>
</html>
