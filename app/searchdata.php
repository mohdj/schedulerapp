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
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
 
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
           <h4 class="modal-title">Enter Hifz Data</h4>
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
              <label for="jd_surat" class="col-xs-1 col-form-label">Surat</label>
              <div class="col-xs-3">
               <select class="form-control" name="jd_surat">
                <option>1-Fatihah</option>
                <option>2-Baqarah</option>
                <option>3-AaleImran</option>
                <option>4-Nisaa</option>
                <option>5-Maaidah</option>
                <option>6-Anaam</option>
                <option>7-Aaraf</option>
                <option>8-Anfaal</option>
                <option>9-Tawbah</option>
                <option>10-Yoonus</option>
                <option>11-Huud</option>
                <option>12-Yuusuf</option>
                <option>13-Raad</option>
                <option>14-Ibraheem</option>
                <option>15-Hijr</option>
                <option>16-Nahl</option>
                <option>17-Isra</option>
                <option>18-Kahf</option>
                <option>19-Maryam</option>
                <option>20-Taha</option>
                <option>21-Anbiyaa</option>
                <option>22-Hajj</option>
                <option>23-Muminoon</option>
                <option>24-Noor</option>
                <option>25-Furqaan</option>
                <option>26-Shoaraa</option>
                <option>27-Naml</option>
                <option>28-Qasas</option>
                <option>29-Ankaboot</option>
                <option>30-Ruum</option>
                <option>31-Luqmaan</option>
                <option>32-Sajdah</option>
                <option>33-Ahzaab</option>
                <option>34-Saba</option>
                <option>35-Faatir</option>
                <option>36-YaSeen</option>
                <option>37-Saaffaat</option>
                <option>38-Saad</option>
                <option>39-Zumar</option>
                <option>40-Ghafir</option>
                <option>41-Fussilat</option>
                <option>42-Shuraa</option>
                <option>43-Zukhruf</option>
                <option>44-Dukhaan</option>
                <option>45-Jaasiyah</option>
                <option>46-Ahqaaf</option>
                <option>47-Mohammed</option>
                <option>48-Fath</option>
                <option>49-Hujuraat</option>
                <option>50-Qaaf</option>
                <option>51-Zaariyat</option>
                <option>52-Toor</option>
                <option>53-Najm</option>
                <option>54-Qamar</option>
                <option>55-Rahmaan</option>
                <option>56-Waaqeah</option>
                <option>57-Hadeed</option>
                <option>58-Mujadilah</option>
                <option>59-Hashr</option>
                <option>60-Mumtahanah</option>
                <option>61-Saff</option>
                <option>62-Jumoah</option>
                <option>63-Munafiqoon</option>
                <option>64-Taghabun</option>
                <option>65-Talaq</option>
                <option>66-Tahreem</option>
                <option>67-Mulk</option>
                <option>68-Qalam</option>
                <option>69-Haaqqah</option>
                <option>70-Maaarij</option>
                <option>71-Nooh</option>
                <option>72-Jinn</option>
                <option>73-Muzzammil</option>
                <option>74-Muddasir</option>
                <option>75-Qiyamah</option>
                <option>76-Insaan</option>
                <option>77-Mursalaat</option>
                <option>78-Naba</option>
                <option>79-Nazeaat</option>
                <option>80-Abasa</option>
                <option>81-Takweer</option>
                <option>82-Infitaar</option>
                <option>83-Mutaffifeen</option>
                <option>84-Inshiqaaq</option>
                <option>85-Burooj</option>
                <option>86-Taariq</option>
                <option>87-Aaala</option>
                <option>88-Ghashiya</option>
                <option>89-Fajr</option>
                <option>90-Balad</option>
                <option>91-Shams</option>
                <option>92-Layl</option>
                <option>93-Duhaa</option>
                <option>94-Insheraah</option>
                <option>95-Teen</option>
                <option>96-Alaq</option>
                <option>97-Qadr</option>
                <option>98-Bayyinah</option>
                <option>99-Zilzaal</option>
                <option>100-Aadiyaat</option>
                <option>101-Qaariah</option>
                <option>102-Takaathur</option>
                <option>103-Asr</option>
                <option>104-Humazah</option>
                <option>105-Feel</option>
                <option>106-Quraish</option>
                <option>107-Maaoon</option>
                <option>108-Kauthar</option>
                <option>109-Kafiroon</option>
                <option>110-Nasr</option>
                <option>111-Masad</option>
                <option>112-Ikhlaas</option>
                <option>113-Falaq</option>
                <option>114-Naas</option>
              </select>

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
    </tr>
    <?php } ?>
  </tbody>
</table>
<?php
}
       if (!empty($_SESSION['login_teacher']))
        {
      ?>

<a href="#" class="btn btn-success btn-md" data-key="payhisab" data-teacher-its="<?php echo $_SESSION['login_teacher']; ?>" data-its="<?php echo $student_itsid; ?>">Add Report</a>

<?php } ?>
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