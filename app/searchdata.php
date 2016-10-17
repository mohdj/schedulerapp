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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
 
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
        <select name="hifztype">
                            <option value='Murajeat'>Murajeat</option>
                            <option value='Jadeed'>Jadeed</option>
                            <option value='Juzhali'>Juzhali</option>
                            <option value='Tasmee'>Tasmee</option>
        </select>  
        <input type="number" name="Amount" placeholder="Marks"/>
        <input type="text" name="sf_amount_date" value="<?php echo date("Y-m-d") ?>"/>
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

<form>
  <fieldset>
    <legend>Search Data</legend>
    ITS ID:<br>
    <input type="text" name="itsid" value="">
    <br><br>
    <input type="submit" value="Search">
  </fieldset>
</form>


<table>

                <thead>

                  <tr>
                    <th>Date</th>
                    <th>Teacher ITS</th>
                    <th>Student ITS</th>
                    <th>Murajeat</th>
                    <th>Murajeat Marks</th>
                    <th>Jadeed</th>
                    <th>Jadeed Marks</th>
                    <th>Tasmee</th>
                    <th>Tasmee Marks</th>
                    <th>Juzhali</th>
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
                    <td><?php echo $values['murajeat']; ?></td>
                    <td><?php echo $values['murajeat_marks']; ?></td>
                    <td><?php echo $values['jadeed']; ?></td>
                    <td><?php echo $values['jadeed_marks']; ?></td>
                    <td><?php echo $values['tasmee']; ?></td>
                    <td><?php echo $values['tasmee_marks']; ?></td>
                    <td><?php echo $values['juzhali']; ?></td>
                    <td><?php echo $values['juzhali']; ?></td>
                  </tr>
                  <?php } ?>
                  <tr>
                      <td colspan='9'></td>
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