<?php

//Require configuration
require_once("inc/config.inc.php");

//Require Entities
require_once("inc/classes/flight.class.php");

//Require Utilities
require_once("inc/classes/PDOService.class.php");
require_once("inc/classes/fligihtDAO.class.php");

filghtDAO::initialize();

$requestData = json_decode(file_get_contents('php://input'));

switch ($_SERVER["REQUEST_METHOD"])   {
    
    case "POST":    

    //New Book
    $newFlight = new flight();
    $newFlight->setFlightNo($requestData->flightNo);
    $newFlight->setDestination($requestData->destination);
    $newFlight->setPassengers($requestData->departing);
    $newFlight->setDeparting($requestData->passengers);
    $newFlight->setArrivalDate($requestData->arrivalDate);
   
    $result = filghtDAO::createBook($newFlight);
    
    //Set the header
    header('Content-Type: application/json');
    
    //Return the result
    echo json_encode(array($result));

    break;

    case "GET":

        //Get the specific data by primary key
        if (isset($requestData->destination))    {

            $flightInfo = filghtDAO::getFlight($requestData->destination);

            //Set the header
            header('Content-Type: application/json');
            
            echo json_encode($flightInfo->jsonSerialize());
        
        //if not get all data from a table
        } else {

            $flights = filghtDAO::getFlights();
            
            $serializedflights = array();

            foreach ($flights as $flight) {
                $serializedflights[] = $flight->jsonSerialize();
            }
            
            //Set the header
            header('Content-Type: application/json');
            
            //Return the entire array
            echo json_encode($serializedflights);            
        }
    break;
   
    case "POST":
        

        $updateFlight = new flight();
        $updateFlight->setFlightNo($requestData->flightNo);
        $updateFlight->setDestination($requestData->destination);
        $updateFlight->setPassengers($requestData->departing);
        $updateFlight->setDeparting($requestData->passengers);
        $updateFlight->setArrivalDate($requestData->arrivalDate);
       
        $result = filghtDAO::updateFlight($updateFlight);
        
      
        //Set the header
        header('Content-Type: application/json');
        
        //Return the number of rows affected
        echo json_encode(array($result));

    break;
   

    default:
        
        echo json_encode(array("message"=> "Try it again"));
        
    break;
}


?>