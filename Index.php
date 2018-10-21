<?php
session_start();
require_once("Control/Rental_Control.php");
$rentalCtrl = new Rental_Control();

//Stores posted data into Sessions for access elsewhere in code
if(isset($_POST['Employee']))
{
    $_SESSION['SelectedEmp'] = $_POST['Employee'];
}

if(isset($_POST['Film']))
{
    $_SESSION['SelectedFilm'] = $_POST['Film'];
}

if(isset($_POST['Customer']))
{
    $_SESSION['SelectedCust'] = $_POST['Customer'];
}

if(isset($_POST['PaymentType']))
{
    $_SESSION['SelectedPt'] = $_POST['PaymentType'];
}

//Case statement that interacts with Control functions
if(isset($_POST['action']))
{
        $action=$_POST['action'];
	switch($action)
	{
		case "Employee":
		$rentalCtrl->employee();
		break;
                case "Admin":
		$rentalCtrl->admin();
		break;
                case "Rental":
                $rentalCtrl->rental();
                break;
                case "Return":
                $rentalCtrl->returns();
                break;
                case "RentResult":
                $rentalCtrl->rentResult();
                break;
                case "ReturnResult":
                $rentalCtrl->returnResult();
                break;
                case "Rent Out":
                $rentalCtrl->rentOut();
                break;
                case "Return Film":
                $rentalCtrl->returnfilm();
                break;
		default:
		$rentalCtrl->index();
		break;
	}
	
}
else
{
	$rentalCtrl->index();
}
?>