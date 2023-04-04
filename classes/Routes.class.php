<?php
//Tilda Källström 2021
class Routes
{
    private $db;

    function __construct()
    {
        $this->db = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);
        if ($this->db->connect_errno > 0) {
            die("Fel vid anslutning: " . $this->db->connect_error);
        }
    }

    public function getRoutes(): array
    {
        $sql = "SELECT * FROM routes ORDER BY routeId DESC;";
        $result = $this->db->query($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function searchCar(): array
    {
        $searchcriteria = $_POST['searchcriteria'];
        $sql = "Select * from routes where licensePlate like '%$searchcriteria%'";
        $result = $this->db->query($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function getLicenseplates(): array
    {
        $sql = "SELECT DISTINCT licensePlate from routes;";
        $result = $this->db->query($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function getRoutesFromThisCar(): array
    {
        $licenseplate = $_GET['licenseplate'];
        $sql = "SELECT * FROM routes WHERE licensePlate = '$licenseplate' ORDER BY routeId DESC;";
        $result = $this->db->query($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function getSum(): array
    {
        $licenseplate = $_GET['licenseplate'];
        $sql = "SELECT SUM(distance) AS total FROM `routes` WHERE licensePlate='$licenseplate';";
        $result = $this->db->query($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function getSumTime(): array
    {
        $licenseplate = $_GET['licenseplate'];
        $sql = "SELECT SUM(travelTime) AS totaltime FROM `routes` WHERE licensePlate='$licenseplate';";
        $result = $this->db->query($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function getSumLiters(): array
    {
        $licenseplate = $_GET['licenseplate'];
        $sql = "SELECT SUM(liters) AS totalliters FROM `routes` WHERE licensePlate='$licenseplate';";
        $result = $this->db->query($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function getSumCost(): array
    {
        $licenseplate = $_GET['licenseplate'];
        $sql = "SELECT SUM(cost) AS totalcost FROM `routes` WHERE licensePlate='$licenseplate';";
        $result = $this->db->query($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function getTjansteresa(): array
    {
        $licenseplate = $_GET['licenseplate'];
        $sql = "SELECT COUNT(routeType) AS tjansteresa FROM `routes` WHERE routeType='Tjänsteres' AND licensePlate='$licenseplate';";
        $result = $this->db->query($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function getPrivatresa(): array
    {
        $licenseplate = $_GET['licenseplate'];
        $sql = "SELECT COUNT(routeType) AS privatresa FROM `routes` WHERE routeType='Privatresa' AND licensePlate='$licenseplate';";
        $result = $this->db->query($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}
