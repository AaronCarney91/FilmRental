<?php
require_once('Database.php');

class CustomerDAO
{
    private $db;
    
    //DAO constructor calls Database constructor, that connects to the database
    function __construct()
    {
        $this->db = new Database();
    }
    
    //Return all fields from the Customer Table
    public function getAllData()
    {
        $cust = $this->db->runQuery("SELECT * FROM frs_Customer");
                
        return $cust;
    }
    
    //Returns the row that belongs to the selected Customer, Alowing access to other fields of infomation such as custid.
    public function getRow($name)
    {
	$shopid = $this->db->runQuery("SELECT * FROM frs_Customer WHERE custname = '$name'");
        
        return $shopid;
    }
    
    function closeConnection()
    {
        $this->db = NULL;
    }
}
?>