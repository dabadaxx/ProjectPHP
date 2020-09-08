<?php


$xmlCourse = new SimpleXMLElement("<flight></flight>");
$xmlCourse->addChild('destination', "YOW");
$xmlCourse->addChild('flightNo', "YOW188");
$xmlCourse->addChild('departing', "Croatia");
$xmlCourse->addChild('passengers', "278");
$xmlCourse->Location->addAttribute('arrivalDate','1578655508');
// <Location classroom="lab">N5111</Location>

//Read XML
//Output XML

//Tell the browser XML is comming!
header('Content-Type: text/xml');
echo $xmlCourse->asXML();

?>