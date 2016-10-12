<?php
include('connection.php');
error_reporting(0);

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
if($_GET)
{
    $query="SELECT * FROM daily_hifz_report WHERE its_student = '".addslashes($_GET['itsid'])."' limit 5";
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
        <select name="salary">
                            <option value='Cash'>Murajeat</option>
                            <option value='Zabihat'>Jadeed</option>
                            <option value='BB Salary'>Juzhali</option>
                            <option value='SF Salary'>Tasmee</option>
        </select>  
        <input type="number" name="Amount" placeholder="Marks"/>
        <input type="hidden" name="Month"/>
        <input type="text" class="gregdate" name="sf_amount_date" value="<?php echo date("Y-m-d") ?>"/>
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
                      <td><a href="#" data-key="payhisab"><img src="images/add.png" style="width:20px;height:20px;"></a></td>
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
        $('[name="Month"]', hisabform).val($(this).attr('data-month'));
        hisabform.show();
      });
      $('[name="save"]').click(function() {
        var data = '';
        $('input[type!="button"],select', hisabform).each(function() {
          data = data + $(this).attr('name') + '=' + $(this).val() + '&';
        });
        $.ajax({
          method: 'post',
          url: '_payhisab.php',
          async: 'false',
          data: data,
          success: function(data) {
            if(data == 'success') {
              hisabform.hide();
              window.location.href = window.location.href; //reload
            // } else if(data == 'DuplicateReceiptNo') {
            //   alert('Receipt number already exists in database');
            }
            else {
              alert('Update failed. Please do not add receipt again unless you check system values properly');
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