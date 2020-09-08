<?php

class Flight{

    private $flightNo;
    private $destination;
    private $departing;
    private $passengers;
    private $arrivalDate;
   

    //Getters
    public function getFlightNo() : string {
        return $this->flightNo;
    }

    public function getDestination() : string {
        return $this->destination;
    }

    public function getDeparting() : string {
        return $this->departing;
    }

    public function getPassengers() : int {
        return $this->passengers;
    }

    public function getArrivalDate() : string {
        return $this->arrivalDate;
    }

    //Setters
    public function setFlightNo(string $flightNo){
        $this->flightNo = $flightNo;
    }

    public function setDestination(string $destination){
        $this->destination = $destination;
    }
    
    public function setPassengers(int $passengers){
        $this->passengers = $passengers;
    }
    public function setDeparting(string $departing){
        $this->departing = $departing;
    }
    public function setArrivalDate(string $arrivalDate){
        $this->arrivalDate = $arrivalDate;
    }
    
    
    
    //jsonSerialize
    public function jsonSerialize() {
        
        $userObject = new stdClass;
        $userObject->flightNo = $this->flightNo;
        $userObject->destination = $this->destination;
        $userObject->departing = $this->departing;
        $userObject->passengers = $this->passengers;
        $userObject->arrivalDate = $this->arrivalDate;

        return $userObject;
        
    }

}


?>