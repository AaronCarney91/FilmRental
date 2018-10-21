<form action="Index.php" method="post">

<?php
//Displays drop down box holding all Employee names, Posts back to Index
echo "Select Employee: <select name='Employee'>";
foreach($emp_rows as $emp)
{
	echo "<option value=\"" . htmlentities($emp["empname"]) . "\">" . strval($emp["empname"]) . "</option>"; 
}       
echo "</select><br>";


?>

<label>Renting out or Returning?</label><br>
<input type="radio" name="action" value="Rental"> Rental<br>
<input type="radio" name="action" value="Return"> Return<br>

<input type="submit" value="Submit">
<input type="submit" name="action" value="Back">
</form>



