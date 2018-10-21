<form action="Index.php" method="post">
<input type="hidden" name="action" value="ReturnResult" />
<?php

//Displays drop down box holding Film titles that are rented out, Posts back to Index
echo "Select Film: <select name='Film'>";
foreach($film_rows as $film)
{
    echo "<option value=\"" . htmlentities($film["filmtitle"]) . "\">" . strval($film["filmtitle"]) . "</option>"; 
}
echo "</select><br>";

?>

<input type="submit" value="Submit">
<input type="submit" name="action" value="Back">
</form>