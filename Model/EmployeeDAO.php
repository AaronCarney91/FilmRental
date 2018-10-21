<?php
require_once('Database.php');

class EmployeeDAO
{
    private $db;
    
    //DAO constructor calls Database constructor, that connects to the database
    function __construct()
    {
        $this->db = new Database();
    }
    
    //Return all fields from the Employee Table
    public function getAllData()
    {
        $emp = $this->db->runQuery("SELECT * FROM frs_Employee");
                
        return $emp;
    }
    
    //Returns the row that belongs to the selected Employee, Alowing access to other fields of infomation such as shopid.
    public function getRow($name)
    {
        $row = $this->db->runQuery("SELECT * FROM frs_Employee WHERE empname = '$name'");
        
        return $row;
    }
    
    function closeConnection()
    {
        $this->db = NULL;
    }
	
	
    
	
}
?>