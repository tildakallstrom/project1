<?php
//Tilda Källström 2021
class Routes
{
    //properties
    private $db;
    


    //metoder
    function __construct()
    {
        //connect to db
        $this->db = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);
        if ($this->db->connect_errno > 0) {
            die("Fel vid anslutning: " . $this->db->connect_error);
        }
    }

    //plocka fram alla routes, visa den nyaste högst upp
    public function getRoutes(): array
    {
        $sql = "SELECT * FROM routes ORDER BY routeId DESC;";
        $result = $this->db->query($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    
 //sökformulär för att söka efter registreringsnummer och därmed få upp samtlig info
    public function searchCar(): array {
        $searchcriteria=$_POST['searchcriteria'];
         $sql ="Select * from routes where licensePlate like '%$searchcriteria%'";
         $result = $this->db->query($sql);
         return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    
    //hämta samtliga bilar(licenseplate)
    public function getLicenseplates(): array {
        $sql = "SELECT DISTINCT licensePlate from routes;";
        $result = $this->db->query($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    //hämta samtliga rutter från specifik bil
    public function getRoutesFromThisCar(): array
    {
        $licenseplate = $_GET['licenseplate'];
        $sql = "SELECT * FROM routes WHERE licensePlate = '$licenseplate' ORDER BY routeId DESC;";
        $result = $this->db->query($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    
     //funktion för att plocka fram summan av bilens totala distans
     public function getSum(): array {
         $licenseplate = $_GET['licenseplate'];
        $sql = "SELECT SUM(distance) AS total FROM `routes` WHERE licensePlate='$licenseplate';";
        $result = $this->db->query($sql);
         return mysqli_fetch_all($result, MYSQLI_ASSOC);
     }
     
             //funktion för att plocka fram summan av bilens totala restid
     public function getSumTime(): array {
         $licenseplate = $_GET['licenseplate'];
        $sql = "SELECT SUM(travelTime) AS totaltime FROM `routes` WHERE licensePlate='$licenseplate';";
        $result = $this->db->query($sql);
         return mysqli_fetch_all($result, MYSQLI_ASSOC);
  
    }
    
               //funktion för att plocka fram summan av bilens totala bränsleåtgång
     public function getSumLiters(): array {
         $licenseplate = $_GET['licenseplate'];
        $sql = "SELECT SUM(liters) AS totalliters FROM `routes` WHERE licensePlate='$licenseplate';";
        $result = $this->db->query($sql);
         return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    
             //funktion för att plocka fram summan av bilens totala resekostnad
     public function getSumCost(): array {
         $licenseplate = $_GET['licenseplate'];
        $sql = "SELECT SUM(cost) AS totalcost FROM `routes` WHERE licensePlate='$licenseplate';";
        $result = $this->db->query($sql);
         return mysqli_fetch_all($result, MYSQLI_ASSOC);
  
    }
    
    
                 //funktion för att plocka fram antal tjänsteresor
     public function getTjansteresa(): array {
         $licenseplate = $_GET['licenseplate'];
        $sql = "SELECT COUNT(routeType) AS tjansteresa FROM `routes` WHERE routeType='Tjänsteres' AND licensePlate='$licenseplate';";
        $result = $this->db->query($sql);
         return mysqli_fetch_all($result, MYSQLI_ASSOC);
  
    }
    
                //funktion för att plocka fram antal privatresor
     public function getPrivatresa(): array {
         $licenseplate = $_GET['licenseplate'];
        $sql = "SELECT COUNT(routeType) AS privatresa FROM `routes` WHERE routeType='Privatresa' AND licensePlate='$licenseplate';";
        $result = $this->db->query($sql);
         return mysqli_fetch_all($result, MYSQLI_ASSOC);
  
    }
    
}
    
    








