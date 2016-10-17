<?php
include('connection.php');
error_reporting(0);

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
if($_GET)
{
    $student_itsid = $_GET['itsid'];
    $query="SELECT * FROM (SELECT * FROM daily_hifz_report WHERE its_student = '".addslashes($_GET['itsid'])."' ORDER BY id DESC limit 5) sub ORDER BY id ASC;";
    $result = mysqli_query($link,$query);


}
?>
<!DOCTYPE html>
<html>
<head>
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
 
</head>
<body>

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
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" name="cancel">Close</button>
        <button type="button" class="btn btn-primary" name="save">Save changes</button>
      </div>
    </div>
  </div>
</div>
    <br><a href="logout.php">Logout</a><br>

<form>
  <fieldset>
    <legend>Search Data</legend>
    ITS ID:<br>
    <input type="text" name="itsid" value="">
    <br><br>
    <input type="submit" value="Search">
  </fieldset>
</form>


<table border="1">

                <thead>

                  <tr>
                    <th>Date</th>
                    <th>Teacher ITS</th>
                    <th>Student ITS</th>
                    <th>Murajeat Juz 1</th>
                    <th>Murajeat Juz 1 Marks</th>
                    <th>Murajeat Juz 2</th>
                    <th>Murajeat Juz 2 Marks</th>
                    <th>Murajeat Juz 3</th>
                    <th>Murajeat Juz 3 Marks</th>
                    <th>Jadeed Surat</th>
                    <th>Jadeed To Ayaat</th>
                    <th>Jadeed Marks</th>
                    <th>Tasmee</th>
                    <th>Tasmee Marks</th>
                    <th>Juzhali From Page</th>
                    <th>Juzhali To Page</th>
                    <th>Juzhali Marks</th>
                    <th>Action</th>
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
                  <?php } ?>
                  <tr>
                      <td colspan='17'></td>
                      <td><a href="#" data-key="payhisab" data-its="<?php echo $student_itsid; ?>"><img src="images/add.png" style="width:20px;height:20px;"></a></td>
                  </tr>
                </tbody>
              </table>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script>
$(function(){
      $(function(){
      var hisabform = $('#myModal');
      hisabform.hide();
      $('[data-key="payhisab"]').click(function() {
        $('[name="studentits"]', hisabform).val($(this).attr('data-its'));
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
</body>
</html>