<?php
include('connection.php');

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
if($_GET)
{
    $query="SELECT * FROM daily_hifz_report WHERE its_student = '".addslashes($_GET['itsid'])."' limit 5";
    $query1="SELECT * FROM students WHERE ITS = '".addslashes($_GET['itsid'])."'";
    $result = mysqli_query($link,$query);


}
?>
<!DOCTYPE html>
<html>
<body>
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
                </tbody>
              </table>

</body>
</html>