<form action="Index.php" method="post">
<input type="hidden" name="action" value="RentResult" />
<?php

//Displays drop down boxes holding Customer names, Film Titles that are available and Payment Types. Posts back to Index
echo "Select Customer: <select name='Customer'>";
foreach($cust_rows as $cust)
{
    echo "<option value=\"" . htmlentities($cust["custname"]) . "\">" . strval($cust["custname"]) . "</option>"; 
}
echo "</select><br>";

echo "Select Film: <select name='Film'>";
foreach($film_rows as $film)
{
    echo "<option value=\"" . htmlentities($film["filmtitle"]) . "\">" . strval($film["filmtitle"]) . "</option>"; 
}
echo "</select><br>";

echo "Select Payment Type: <select name='PaymentType'>";
foreach($pt_rows as $pt)
{
    echo "<option value=\"" . htmlentities($pt["ptdescription"]) . "\">" . strval($pt["ptdescription"]) . "</option>"; 
}
echo "</select><br>";

?>

<input type="submit" value="Submit">
<input type="submit" name="action" value="Back">
</form>








