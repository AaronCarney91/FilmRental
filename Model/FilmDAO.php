<?php
require_once('Database.php');

class FilmDAO
{
    private $db;
    
    //DAO constructor calls Database constructor, that connects to the database
    function __construct()
    {
        $this->db = new Database();
    }
    
    //Returns all available films, filtered by shopid and rental status. Excludes Rented out films.
    public function getAvailableFilms($shopid)
    {
        $film = $this->db->runQuery("SELECT * FROM frs_Film f, frs_DVD d WHERE f.filmid = d.filmid AND d.shopid = '$shopid'
                                        AND f.filmid NOT IN (SELECT filmid FROM frs_FilmRental WHERE rstatusid = 1
                                        OR rstatusid = 3 AND shopid = '$shopid') ORDER BY f.filmid");
                
        return $film;
    }
    
    //Returns films that have been rented out or are overdue, oposite of the above query
    public function getReturnableFilms($shopid)
    {
        $film = $this->db->runQuery("SELECT * FROM frs_Film f, frs_DVD d WHERE f.filmid = d.filmid AND d.shopid = '$shopid'
                                        AND f.filmid IN (SELECT filmid FROM frs_FilmRental WHERE rstatusid = 1
                                        OR rstatusid = 3 AND shopid = '$shopid') ORDER BY f.filmid");
        
        return $film;
    }
    
    //Returns the row that belongs to the selected Film, Alowing access to other fields of infomation such as filmid, Edited to also return the correct dvdid by taking in the shopid of the selected employee. 
    public function getRow($shopid, $title)
    {
	$shopid = $this->db->runQuery("SELECT * FROM frs_Film f, frs_DVD d WHERE f.filmid = d.filmid AND d.shopid = '$shopid' AND filmtitle = '$title'");
        
        return $shopid;
    }
    
     
    //Inserts data to FilmRental table
    public function addToFilmRental($f, $e, $c)
    {
        $dvdid = $f[0]['dvdid'];
        $filmid = $f[0]['filmid'];
        $shopid = $f[0]['shopid'];
        $empnin = $e[0]['empnin'];
        $custid = $c[0]['custid'];
        //$rentalrate = $r;
        
        $this->db->addRow("INSERT INTO frs_FilmRental(dvdid, filmid, shopid, retdatetime, duedate, overduecharge, empnin, custid, rentalrate, payid, rstatusid)
                          VALUES('$dvdid','$filmid','$shopid','2016-01-01 12:00:00','2016-02-01','1.00','$empnin','$custid','3.99',NULL,'1')");
        
              
    }
    
    public function returnFilm($f)
    {
        $dvdid = $f[0]['dvdid'];
        
        $this->db->addRow("UPDATE frs_FilmRental SET rstatusid = 2 WHERE dvdid = '$dvdid'");
    }
    
    function closeConnection()
    {
        $this->db = NULL;
    }
}

                                   
?>




