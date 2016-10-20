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
      <h3>Muntasebaat Hifz</h3>
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
             <input type="date" name="sf_amount_date" value="<?php echo date("Y-m-d") ?>"/>
             <input type="number" name="mr_juz1" placeholder="Murajeat Juz1"/> 
             <input type="number" name="mr_marks1" placeholder="Murajeat Marks1"/>
             <input type="number" name="mr_juz2" placeholder="Murajeat Juz2"/> 
             <input type="number" name="mr_marks2" placeholder="Murajeat Marks2"/>
             <input type="number" name="mr_juz3" placeholder="Murajeat Juz3"/> 
             <input type="number" name="mr_marks3" placeholder="Murajeat Marks3"/>

             <input type="number" name="jh_from" placeholder="Juzhali From Page"/> 
             <input type="number" name="jh_to" placeholder="Juzhali To Page"/>
             <input type="number" name="jh_marks" placeholder="Juzhali Marks"/>

             <input type="text" name="jd_surat" placeholder="Jadeed Surat"/>
             <input type="number" name="jd_to" placeholder="Jadeed To Ayaat"/>
             <input type="number" name="jd_marks" placeholder="Jadeed Marks"/>
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
    <h3 class="panel-title">Search Data</h3>
  </div>

  <div class="panel-body">
    <p>
      Here you can search for student reports. Specify students Its Id to search!
    </p>
    <form class="form-horizontal">
      <div class="col-md-8 form-group">
        <input type="number" class="form-control" name="itsid" placeholder="Specify student Its Id?"/>
      </div>
      <div class="col-md-2 col-md-offset-2">
        <input class="btn btn-success btn-block" type="submit" value="Search"/>
      </div>
    </form>
  </div>
</div>
<?php 
} ?>


<?php
}
if (!empty($values['Fullname']))
{
?>
<div class="page-header"><h3>Student Hifz Reports</h3></div>
<h4>Student: <?php echo $values['Fullname']; ?></h4>
<p>Following is the last five days reports submitted:</p>

<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th rowspan="2">Date</th>
      <th rowspan="2">Teacher ITS</th>
      <th rowspan="2">Student ITS</th>
      <th colspan="2">Murajeat 1</th>
      <th colspan="2">Murajeat 2</th>
      <th colspan="2">Murajeat 3</th>
      <th colspan="3">Jadeed</th>
      <th colspan="2">Tasmee</th>
      <th colspan="3">Juzhali</th>
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
      <th>Surat</th>
      <th>Ayaat</th>
      <th>Marks</th>
      <th>Juz No</th>
      <th>Marks</th>
      <th>From Page</th>
      <th>To Page</th>
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
      <td><?php echo $values['its_teacher']; ?></td>
      <td><?php echo $values['its_student']; ?></td>
      <td><?php echo $values['murajeat_juz1']; ?></td>
      <td><?php echo $values['murajeat_marks1']; ?></td>
      <td><?php echo $values['murajeat_juz2']; ?></td>
      <td><?php echo $values['murajeat_marks2']; ?></td>
      <td><?php echo $values['murajeat_juz3']; ?></td>
      <td><?php echo $values['murajeat_marks3']; ?></td>
      <td><?php echo $values['jadeed_surat']; ?></td>
      <td><?php echo $values['jadeed_to_ayat']; ?></td>
      <td><?php echo $values['jadeed_marks']; ?></td>
      <td><?php echo $values['tasmee']; ?></td>
      <td><?php echo $values['tasmee_marks']; ?></td>
      <td><?php echo $values['juzhali_from']; ?></td>
      <td><?php echo $values['juzhali_to']; ?></td>
      <td><?php echo $values['juzhali_marks']; ?></td>
    </tr>
    <?php
       } 
       if (!empty($_SESSION['login_teacher']))
        {
        ?>
    <tr>
        <td colspan='17'></td>
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
