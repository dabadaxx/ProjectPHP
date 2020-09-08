<?php 
class FlightDAO
{
    private static $db;
    static function initialize() {

        self::$db = new PDOService("flights");
    }
    static function getFlights(): Array{
          //Query
          $sql = "SELECT * FROM flights;";
          self::$db->query($sql);
          
          //Execute
          self::$db->execute();
          
          //Return 
          return self::$db->resultSet();

    }
    static function getFlight(string $des) {
        
        //Query
        $sql = "SELECT * FROM flights WHERE destination = :des;";
        self::$db->query($sql);
        
        //Bind
        self::$db->bind(":des", $des);

        //Execute
        self::$db->execute();

        //Return
        return self::$db->singleResult();
    
        
    }


}