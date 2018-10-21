<form action="Index.php" method="post">
<?php

echo "Film: ".$_SESSION['SelectedFilm'][0]['filmtitle']."<br>";

//if film is over due
if($_SESSION['SelectedFilm'][0]['rstatusid'] = 3)
{
    echo "This Film is Late, 1.00 overdue charge.";
}


echo "<br>"."Are These Details Correct?"."<br>";

?>
<input type="submit" name="action" value="Return Film">
<input type="submit" name="action" value="Cancel">
</form>