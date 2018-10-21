<form action="Index.php" method="post">
<?php

echo "ShopID: ".$_SESSION['SelectedEmp'][0]['shopid']."<br>";
echo "EmployeeNIN: ".$_SESSION['SelectedEmp'][0]['empnin']."<br>";
echo "Employee: ".$_SESSION['SelectedEmp'][0]['empname']."<br>";
echo "FilmID: ".$_SESSION['SelectedFilm'][0]['filmid']."<br>";
echo "DVDID: ".$_SESSION['SelectedFilm'][0]['dvdid']."<br>";
echo "Film: ".$_SESSION['SelectedFilm'][0]['filmtitle']."<br>";
echo "CustomerID: ".$_SESSION['SelectedCust'][0]['custid']."<br>";
echo "Customer: ".$_SESSION['SelectedCust'][0]['custname']."<br>";
echo "Payment Type:  ".$_SESSION['SelectedPt'][0]['ptdescription']."<br>";

echo "<br>"."Are These Details Correct?"."<br>";

?>
<input type="submit" name="action" value="Rent Out">
<input type="submit" name="action" value="Cancel">
</form>