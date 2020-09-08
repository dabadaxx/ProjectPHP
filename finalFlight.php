<?php

require_once("config.inc.php");
require_once("inc/classes/flight.class.php");

require_once("inc/classes/RestClient.class.php");
require_once("inc/classes/Page.class.php");
require_once("inc/classes/PDOService.class.php");

Page::header(); 

$service = new PDOService("Flight");

if(isset($_POST['buttonImport'])) {
    copy($_FILES['jsonFile']['tmp_name'], 'jsonFiles/'.$_FILES['jsonFile']['name']);
    $data = file_get_contents('jsonFiles/'.$_FILES['jsonFile']['name']);
    $flights = json_decode($data);

    foreach ($flights as $flight) {
        $sql = 'insert into flights
        (flightNo, destination,departing,passengers,arrivalDate ) 
        values(:flightNo, :destination, :departing, :passengers, :arrivalDate)';
        $service->query($sql);
        $service->bind('flightNo', $flight->flightNo);
        $service->bind('destination', $flight->destination);
        $service->bind('departing', $flight->departing);
        $service->bind('passengers', $flight->passengers);
        $service->bind('arrivalDate', $flight->arrivalDate);
        $service->execute();
    }
  
}

$sql = 'SELECT * FROM flights';
$service->query($sql);
$service->execute();
$flights = $service->resultSet();


Page::displayStats($flights);

/*
//Get all the flight
$jsonFlights = RestClient::call("GET");
$flights = array();

foreach ($jsonFlights as $jsonFlights) {

    //Rebuild the new student
    $ns = new Student();
    $ns->setFlightNo($jsonFlights->flightNo);
    $ns->setDestination($jsonFlights->destination);
    $ns->setDeparting($jsonFlights->departing);
    $ns->setPassengers($jsonFlights->passengers);
    $ns->setArrivalDate($jsonFlights->arrivalDate);


    //Add the new student to the students array
    $flights[] = $ns;

}*/

Page::importForm();
// Page::listFlights($flights);

Page::exportForm($flights);

Page::footer();
?>