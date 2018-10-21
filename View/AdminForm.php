<form action="Index.php" method="post">

<html>
<head></head>
<body>
<table border = 1>
<?php
//Displays total sales of each shop in a table
echo "Total Sales"."<br>";
//print_r($sales);

foreach($sales as $s)
{
    echo '<tr>';
    echo '<td>'.$s['shopid'].'</td>';
    echo '<td>'.$s['Total'].'</td>';
    echo '</tr>';
}       

?>
</table>
</body>
</html>

<input type="submit" value="Back">
</form>