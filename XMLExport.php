<?php
require_once("config.inc.php");
require_once("inc/classes/flight.class.php");

require_once("inc/classes/RestClient.class.php");
require_once("inc/classes/Page.class.php");
require_once("inc/classes/PDOService.class.php");

if(isset($_POST['buttonExport'])) {
    $service = new PDOService("Flight");

    $names = $_REQUEST['flightno'];
    $xmlRoot = new SimpleXMLElement("<flights></flights>");
    foreach($names as $name) {

        $sql = 'SELECT * FROM flights WHERE destination=:destination';
        $service->query($sql);
        $service->bind('destination', $name);
        $service->execute();
        $flights = $service->resultSet();

        foreach($flights as $flight) {
            $xmlFlight = $xmlRoot->addChild('flight');
            $xmlFlight->addChild('destination', $flight->getDestination());
            $xmlFlight->addChild('flightNo', $flight->getFlightNo());
            $xmlFlight->addChild('departing', $flight->getDeparting());
            $xmlFlight->addChild('passengers', $flight->getPassengers());
            $xmlFlight->addChild('arrivalDate', date('Y-m-d', $flight->getArrivalDate()));
        }
    }


    //Tell the browser XML is comming!
    header('Content-Type: text/xml');
    echo $xmlRoot->asXML();
} else {
    echo "XML data required";
}

?>