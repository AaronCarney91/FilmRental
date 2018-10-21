<?php

define( 'DB_DATA_SOURCE', 'mysql:host=localhost;dbname=u1264377' );
define( 'DB_USERNAME', 'u1264377' );
define( 'DB_PASSWORD', '08jan91' );

class Database
{
	private $connection;
	
	function __construct()
	{
            $this->connectToDB(DB_USERNAME, DB_PASSWORD, DB_DATA_SOURCE);
	}
	
	function connectToDB($user, $password, $database)
	{
            $this->connection = new PDO($database, $user, $password);
	}
        
        function runQuery($q)
        {
            $query = $this->connection->query($q);
            
            while($row = $query->fetchall(PDO::FETCH_ASSOC))
            {
		$rows = $row;
            }
            return $rows;
        }
        
        function addRow($q)
        {
            $this->connection->exec($q);
        }
        
        
	
}

?>