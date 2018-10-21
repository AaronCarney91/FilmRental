<?php
session_start();
require_once("Model/EmployeeDAO.php");
require_once("Model/FilmDAO.php");
require_once("Model/CustomerDAO.php");
require_once("Model/PaymentDAO.php");

class Rental_Control
{
    private $emp_dao;
    private $film_dao;
    private $cust_dao;
    private $pt_dao;
    
        
        //Control constructor also creates all DAO objects
        function __construct()
        {
            $this->emp_dao = new EmployeeDAO();
            $this->film_dao = new FilmDAO();
            $this->cust_dao = new CustomerDAO();
            $this->pt_dao = new PaymentDAO();
        }
        
        
        //IntroForm has the user choose between the Employee and Admin interfaces
	public function index()
	{
            $page_title="Welcome";
            include("View/Header.php");
            include("View/IntroForm.php");
	}
	
        //Displays drop down box holding all Employee names.
	public function employee()
	{
            $page_title="Employee Form";
            include("View/Header.php");
            
            $emp_rows = $this->emp_dao->getAllData();
            
            include("View/EmployeeForm.php");
        }
        
        //Display total sales of each shop
        public function admin()
        {
            $page_title="Admin Page";
            include("View/Header.php");
            
            $sales = $this->pt_dao->totalSales();
            
            //UNFINISHED
            include("View/AdminForm.php");
        }
        
        //Displays drop down boxes holding available films(depending on selected employee), Customer names and payment types 
        public function rental()
        {
            $page_title="Rental Form";
            include("View/Header.php");
            
            //Displays selected employee name
            echo "Welcome ".$_SESSION['SelectedEmp'];
            
            //Overwrites Session holding just the employee name with the whole row that the employee name belonged too.
            $_SESSION['SelectedEmp'] = $this->emp_dao->getRow($_SESSION['SelectedEmp']);
            
            $film_rows = $this->film_dao->getAvailableFilms($_SESSION['SelectedEmp'][0]['shopid']);
            $cust_rows = $this->cust_dao->getAllData();
            $pt_rows = $this->pt_dao->getAllData();
            
            include("View/RentalForm.php");
        }
        
        //Displays drop down box holding film titles that are rented out.
        public function returns()
        {
            $page_title="Return Form";
            include("View/Header.php");
            
            //Displays selected employee name
            echo "Welcome ".$_SESSION['SelectedEmp'];
            
            //Overwrites Session holding just the employee name with the whole row that the employee name belonged too.
            $_SESSION['SelectedEmp'] = $this->emp_dao->getRow($_SESSION['SelectedEmp']);
            
            $film_rows = $this->film_dao->getReturnableFilms($_SESSION['SelectedEmp'][0]['shopid']);
            
            include("View/ReturnForm.php");
        }
        
        //Displays the selected results before comiting to add them to the Database
        public function rentResult()
        {
            $page_title="Rental Results";
            include("View/Header.php");
            
            //Overwrites Sessions holding names with all the data belonging to that name, empname|shopid|address etc
            $_SESSION['SelectedFilm'] = $this->film_dao->getRow($_SESSION['SelectedEmp'][0]['shopid'], $_SESSION['SelectedFilm']);
            $_SESSION['SelectedCust'] = $this->cust_dao->getRow($_SESSION['SelectedCust']);
            $_SESSION['SelectedPt'] = $this->pt_dao->getRow($_SESSION['SelectedPt']);
            
            include("View/RentalResult.php");
        }
        
        //Displays the film being returned and Displays any overdue charges
        public function returnResult()
        {
            $page_title="Return Results";
            include("View/Header.php");
            
            //Overwrites Sessions holding names with all the data belonging to that name, empname|shopid|address etc
            $_SESSION['SelectedFilm'] = $this->film_dao->getRow($_SESSION['SelectedEmp'][0]['shopid'], $_SESSION['SelectedFilm']);
                        
            include("View/ReturnResult.php");
        }
        
        //Posts infomation to Database
        public function rentOut()
        {
            $ps = $this->pt_dao->getPaymentStatusId($_SESSION['SelectedPt'][0]['ptdescription']);
            $this->pt_dao->addToPayment($_SESSION['SelectedEmp'], $_SESSION['SelectedCust'], $ps, $_SESSION['SelectedPt']);
            
            $this->film_dao->addToFilmRental($_SESSION['SelectedFilm'], $_SESSION['SelectedEmp'], $_SESSION['SelectedCust']);
            $this->index();
        }
        
        //Edits Database, Returns Film
        public function returnFilm()
        {
            $this->film_dao->returnFilm($_SESSION['SelectedFilm']);
            $this->index();
        }
         
    
}




?>