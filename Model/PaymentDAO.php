<?php

require_once('Database.php');

class PaymentDAO
{
    private $db;
    
    //DAO constructor calls Database constructor, that connects to the database
    function __construct()
    {
        $this->db = new Database();
    }
    
    //Return all fields from the Payment Type Table
    public function getAllData()
    {
	$pt = $this->db->runQuery("SELECT * FROM frs_PaymentType");
                
        return $pt;
    }
    
    //Returns the row that belongs to the selected Payment Type, Alowing access to other fields of infomation such as Payment Type ID.
    public function getRow($pt)
    {
	$shopid = $this->db->runQuery("SELECT * FROM frs_PaymentType WHERE ptdescription = '$pt'");
        
        return $shopid;
    }
    
    //Returns PaymentStatusID depending on method of payment
    //Cash = Accepted, Card = Approved, Cheque = Pending
    public function getPaymentStatusId($pt)
    {
        $ps;
        
        switch($pt)
	{
            case "Cash":
            $ps = 1;
            break;
            case "Cheque":
            $ps = 3;
            break;
            case "Debit Card":
            $ps = 2;
            break;
            case "Credit Card":
            $ps = 2;
            break;
        }
        
        return $ps;
    }
    
    //Inserts data to Payment table
    public function addToPayment($e, $c, $ps, $pt)
    {
        $empnin = $e[0]['empnin'];
        $custid = $c[0]['custid'];
        $ptid = $pt[0]['ptid'];
        $pstatusid = $ps;
        //$rentalrate = $r;
        
        $this->db->addRow("INSERT INTO frs_Payment(payid, amount, paydatetime, empnin, custid, pstatusid, ptid)
                          VALUES(NULL,'3.99','2016-05-01 17:30:00','$empnin','$custid','$pstatusid','$ptid')");
    }
    
    //Calculate Sale figure of each indivdual shop
    public function totalSales()
    {
        $sales = $this->db->runQuery("SELECT shopid, SUM(amount) AS 'Total' FROM frs_Payment p, frs_FilmRental fr WHERE p.payid = fr.payid GROUP BY shopid");
        
        return $sales;
    }
    
    function closeConnection()
    {
        $this->db = NULL;
    }
}




?>

